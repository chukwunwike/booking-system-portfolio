<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Car Rental Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex gap-8">
                <!-- Booking Form -->
                <div class="w-1/2 border-r pr-8">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Reserve a Vehicle') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Select your preferred car and choose a pick-up time.") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('bookings.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="service_id" :value="__('Select Car Model')" />
                                    <select id="service_id" name="service_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="updateChoice()">
                                        <option value="">-- Choose --</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" 
                                                    data-duration="{{ $service->duration_minutes }}"
                                                    data-image="{{ asset($service->image_path) }}"
                                                    data-price="{{ $service->price }}"
                                            >{{ $service->name }} - ${{ $service->price }}/day</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="start_time" :value="__('Select Pick-up Date and Time')" />
                                    <input type="datetime-local" id="start_time" name="start_time" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="calculateEndTime()">
                                </div>

                                <div>
                                    <x-input-label for="end_time" :value="__('Return Time (Auto-calculated)')" />
                                    <input type="datetime-local" id="end_time" name="end_time" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm text-gray-500" required readonly>
                                </div>
                            </div>

                            <div id="car_preview_container" class="hidden">
                                <label class="block font-medium text-sm text-gray-700 mb-1">Vehicle Preview</label>
                                <div class="bg-zinc-50 rounded-xl border border-zinc-100 overflow-hidden shadow-inner">
                                    <img id="car_preview_image" src="" alt="Car Preview" class="w-full h-48 object-cover">
                                    <div class="p-4 bg-white/80 backdrop-blur-sm border-t border-zinc-100">
                                        <p id="car_preview_price" class="text-indigo-600 font-bold text-lg"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 border-t pt-6">
                            <x-primary-button>{{ __('Confirm Booking') }}</x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- Booking History -->
                <div class="w-1/2">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Your Rental History') }}
                        </h2>
                    </header>

                    <div class="mt-6 space-y-4">
                        @forelse($bookings as $booking)
                            <div class="p-4 bg-gray-50 border rounded-lg shadow-sm">
                                <div class="flex justify-between">
                                    <h3 class="font-semibold text-gray-800">{{ $booking->service->name ?? 'Unknown Vehicle' }}</h3>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-bold">{{ strtoupper($booking->status) }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">
                                    <strong>Pick-up:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('M d, Y h:i A') }}<br>
                                    <strong>Return:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('M d, Y h:i A') }}
                                </p>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No bookings found in your history.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateChoice() {
            const serviceSelect = document.getElementById('service_id');
            const previewContainer = document.getElementById('car_preview_container');
            const previewImage = document.getElementById('car_preview_image');
            const previewPrice = document.getElementById('car_preview_price');
            
            if (serviceSelect.value) {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const imagePath = selectedOption.getAttribute('data-image');
                const price = selectedOption.getAttribute('data-price');
                
                previewImage.src = imagePath;
                previewPrice.textContent = `$${price}/day`;
                previewContainer.classList.remove('hidden');
            } else {
                previewContainer.classList.add('hidden');
            }
            
            calculateEndTime();
        }

        function calculateEndTime() {
            const serviceSelect = document.getElementById('service_id');
            const startTimeInput = document.getElementById('start_time');
            const endTimeInput = document.getElementById('end_time');

            if (serviceSelect.value && startTimeInput.value) {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const durationMinutes = parseInt(selectedOption.getAttribute('data-duration'));
                
                const startTime = new Date(startTimeInput.value);
                const endTime = new Date(startTime.getTime() + durationMinutes * 60000);
                
                // Format for datetime-local (YYYY-MM-DDThh:mm)
                const tzOffset = (new Date()).getTimezoneOffset() * 60000;
                const localISOTime = (new Date(endTime - tzOffset)).toISOString().slice(0, 16);
                
                endTimeInput.value = localISOTime;
            }
        }
    </script>
</x-app-layout>

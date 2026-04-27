<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-zinc-900">Join the Fleet</h2>
        <p class="mt-2 text-sm text-zinc-600">Start your journey with AutoReserve and unlock exclusive benefits.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-zinc-700 font-medium" />
            <x-text-input id="name" class="block mt-1.5 w-full border-zinc-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-5">
            <x-input-label for="email" :value="__('Email Address')" class="text-zinc-700 font-medium" />
            <x-text-input id="email" class="block mt-1.5 w-full border-zinc-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="john@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="text-zinc-700 font-medium" />

            <x-text-input id="password" class="block mt-1.5 w-full border-zinc-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-5">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-zinc-700 font-medium" />

            <x-text-input id="password_confirmation" class="block mt-1.5 w-full border-zinc-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                {{ __('Create Account') }}
            </button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-zinc-600">
                {{ __('Already have an account?') }}
                <a class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors" href="{{ route('login') }}">
                    {{ __('Log in') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

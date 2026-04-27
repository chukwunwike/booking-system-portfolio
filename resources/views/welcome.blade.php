<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'AutoReserve') }} - Premium Car Rental</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:700|instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Tailwind via CDN for reliability -->
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            .font-serif { font-family: 'Playfair Display', serif; }
            .hero-gradient {
                background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
            }
        </style>
    </head>
    <body class="antialiased bg-white text-zinc-900 selection:bg-indigo-500 selection:text-white">
        
        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-zinc-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <x-application-logo class="h-10 w-auto" />
                        <span class="text-xl font-bold tracking-tight text-zinc-900 border-l border-zinc-200 pl-3">AutoReserve</span>
                    </div>
                    
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#fleet" class="text-sm font-semibold text-zinc-600 hover:text-indigo-600 transition-colors">Our Fleet</a>
                        <a href="#features" class="text-sm font-semibold text-zinc-600 hover:text-indigo-600 transition-colors">Features</a>
                    </div>

                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold transition-all shadow-lg">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-bold text-zinc-700 hover:text-indigo-600 transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-zinc-900 text-white rounded-xl text-sm font-bold hover:bg-zinc-800 transition-all shadow-md">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative min-h-screen hero-gradient flex items-center pt-24 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full line">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-10">
                        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-600 text-xs font-bold uppercase tracking-wider">
                            <span>New Fleet for 2026</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                            <span>Limited Offer</span>
                        </div>
                        <h1 class="text-6xl lg:text-7xl font-extrabold leading-[1.1] font-serif text-zinc-900">
                            Drive Your <span class="text-indigo-600 italic">Dreams</span> with AutoReserve
                        </h1>
                        <p class="text-xl text-zinc-600 max-w-lg leading-relaxed">
                            Experience the ultimate freedom on the road. From luxury sedans to rugged SUVs, we provide the perfect vehicle for every journey.
                        </p>
                        <div class="flex flex-wrap gap-5">
                            <a href="{{ route('login') }}" class="px-10 py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-lg transition-all transform hover:-translate-y-1 shadow-2xl shadow-indigo-100">
                                Book Your Ride
                            </a>
                            <a href="#fleet" class="px-10 py-5 bg-white border-2 border-zinc-100 hover:border-indigo-600 text-zinc-900 rounded-2xl font-bold text-lg transition-all hover:-translate-y-1 shadow-sm">
                                Explore Fleet
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-10 pt-10 border-t border-zinc-200">
                            <div>
                                <div class="text-3xl font-black text-zinc-900">500+</div>
                                <div class="text-sm font-bold text-zinc-400 uppercase tracking-tighter">Premium Cars</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-zinc-900">50k+</div>
                                <div class="text-sm font-bold text-zinc-400 uppercase tracking-tighter">Happy Clients</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-zinc-900">24/7</div>
                                <div class="text-sm font-bold text-zinc-400 uppercase tracking-tighter">Support</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative flex justify-center">
                        <div class="absolute -inset-10 bg-indigo-500/10 rounded-full blur-[100px]"></div>
                        <img src="{{ asset('images/hero-car.png') }}" alt="Premium Car" class="relative z-10 w-full max-w-2xl drop-shadow-2xl transform lg:scale-110">
                        
                        <!-- Floating Badge -->
                        <div class="absolute -bottom-10 -left-10 bg-white p-6 rounded-3xl shadow-2xl z-20 flex items-center gap-5 border border-zinc-50 hidden lg:flex">
                            <div class="w-14 h-14 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-base font-black text-zinc-900 uppercase tracking-tighter">Rapid Booking</div>
                                <div class="text-sm text-zinc-400 italic">Confirmed in < 60s</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-32 bg-white border-y border-zinc-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-24 space-y-5">
                    <h2 class="text-indigo-600 font-black uppercase tracking-[0.2em] text-xs">Why Choose Us</h2>
                    <p class="text-5xl font-black font-serif text-zinc-900">Redefining Your Rental Experience</p>
                    <p class="text-xl text-zinc-400 leading-relaxed font-medium">We combine premium service with high-end technology to make your rental seamless and enjoyable.</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-10">
                    <div class="p-10 rounded-[2.5rem] bg-zinc-50/50 border border-zinc-100/50 hover:bg-white hover:shadow-2xl transition-all group">
                        <div class="w-20 h-20 bg-blue-50 rounded-3xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black mb-5 text-zinc-900">Complete Safety</h3>
                        <p class="text-zinc-500 leading-relaxed font-medium">Every car undergoes a rigorous safety check before each rental to ensure your peace of mind.</p>
                    </div>
                    
                    <div class="p-10 rounded-[2.5rem] bg-zinc-50/50 border border-zinc-100/50 hover:bg-white hover:shadow-2xl transition-all group">
                        <div class="w-20 h-20 bg-indigo-50 rounded-3xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black mb-5 text-zinc-900">24/7 Road Support</h3>
                        <p class="text-zinc-500 leading-relaxed font-medium">Wherever you go, we've got your back. Our support team is always just a call away.</p>
                    </div>
                    
                    <div class="p-10 rounded-[2.5rem] bg-zinc-50/50 border border-zinc-100/50 hover:bg-white hover:shadow-2xl transition-all group">
                        <div class="w-20 h-20 bg-orange-50 rounded-3xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black mb-5 text-zinc-900">Best Rates</h3>
                        <p class="text-zinc-500 leading-relaxed font-medium">We offer competitive pricing with no hidden fees, providing the best value for your rent.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fleet Section -->
        <section id="fleet" class="py-32 bg-zinc-50/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                 <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                    <div class="space-y-5">
                        <h2 class="text-indigo-600 font-black uppercase tracking-[0.2em] text-xs">Our Fleet</h2>
                        <p class="text-5xl font-black font-serif text-zinc-900">A Car for Every <span class="italic text-zinc-400">Occasion</span></p>
                    </div>
                    <a href="{{ route('login') }}" class="font-black text-indigo-600 flex items-center gap-3 hover:gap-5 transition-all text-lg group">
                        View All Vehicles 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
                
                <div class="grid md:grid-cols-3 gap-10">
                    @foreach($services as $service)
                        @php
                            $category = \Illuminate\Support\Str::before($service->name, ':');
                            $model = \Illuminate\Support\Str::after($service->name, ': ');
                            $isPopular = $category === 'SUV'; // Keep Tesla/SUV as most popular for style
                        @endphp
                        <div class="group bg-white rounded-[3rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all border {{ $isPopular ? 'border-2 border-indigo-100 ring-4 ring-indigo-500/5 -translate-y-4' : 'border-zinc-100' }}">
                            <div class="aspect-video relative overflow-hidden {{ $isPopular ? 'bg-indigo-50' : 'bg-zinc-100' }} flex items-center justify-center">
                                @if($service->image_path)
                                    <img src="{{ asset($service->image_path) }}" alt="{{ $model }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <span class="text-zinc-900 font-serif italic text-6xl opacity-5 uppercase select-none font-black tracking-widest">{{ $category }}</span>
                                @endif
                                
                                @if($isPopular)
                                    <div class="absolute top-6 right-6 px-4 py-2 bg-indigo-600 text-white text-[12px] font-black rounded-full uppercase tracking-widest shadow-xl z-20">Most Popular</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
                            </div>
                            <div class="p-10 space-y-6">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-3xl font-black text-zinc-900">{{ $model }}</h4>
                                    <div class="text-right">
                                        <span class="text-3xl font-black text-indigo-600">${{ number_format($service->price, 0) }}</span>
                                        <span class="text-sm font-bold text-zinc-400">/day</span>
                                    </div>
                                </div>
                                <div class="flex gap-5 text-sm font-bold text-zinc-400">
                                    <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> {{ $category }}</span>
                                    <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> Auto</span>
                                    <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> 5 Seats</span>
                                </div>
                                <a href="{{ route('login') }}" class="block w-full py-5 text-center {{ $isPopular ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-200' : 'bg-zinc-50 group-hover:bg-indigo-600 group-hover:text-white text-zinc-900 border border-zinc-100 group-hover:border-indigo-600' }} rounded-2xl font-black transition-all">Rent Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Registration CTA -->
        <section id="cta" class="py-24 bg-indigo-600 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 L100 0 L100 100 Z" fill="white" />
                </svg>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <h2 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl">
                    Ready to start your journey?
                </h2>
                <p class="mt-6 text-xl text-indigo-100 max-w-2xl mx-auto">
                    Join thousands of satisfied drivers who choose AutoReserve for their premium travel needs.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                    @auth
                        <a href="{{ route('bookings.index') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-2xl text-indigo-600 bg-white hover:bg-zinc-50 transition-all duration-300 shadow-xl hover:-translate-y-1">
                            Book Your Next Vehicle
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-2xl text-indigo-600 bg-white hover:bg-zinc-50 transition-all duration-300 shadow-xl hover:-translate-y-1">
                            Create Free Account
                        </a>
                        <a href="#fleet" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-base font-bold rounded-2xl text-white hover:bg-white/10 transition-all duration-300">
                            View Available Fleet
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-20 border-t border-zinc-100 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="flex items-center justify-center gap-3 mb-8">
                    <x-application-logo class="h-8 w-auto opacity-50" />
                    <span class="text-lg font-bold tracking-tight text-zinc-400 uppercase tracking-widest">AutoReserve</span>
                </div>
                <p class="text-zinc-400 text-sm font-medium">
                    &copy; 2026 AutoReserve Car Rental System. All rights reserved.
                </p>
            </div>
        </footer>

    </body>
</html>

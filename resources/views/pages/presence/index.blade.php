@extends('layouts.app')

@section('title', 'Global Presence - Surma Agro Offices Worldwide')
@section('meta_description', 'Surma Agro global offices in Bangladesh, USA, Thailand, and Saudi Arabia. International agriculture trade network spanning 30+ countries.')

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Global Network</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Our Global Presence</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                Strategic offices across four continents, serving importers and distributors worldwide
            </p>
        </div>
    </section>

    <section class="py-24 bg-cream relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-96 h-96 bg-earth-200 rounded-full blur-3xl opacity-30"></div>
            <div class="absolute bottom-20 right-10 w-[32rem] h-[32rem] bg-forest-100 rounded-full blur-3xl opacity-40"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- USA Office --}}
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden" data-gsap="fade-up">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-forest-800 flex items-center gap-3">
                                <img src="https://flagcdn.com/w40/us.png" alt="US" class="w-8 h-6 object-cover rounded shadow-sm"> USA Office
                            </h3>
                            <span class="text-[10px] font-semibold text-forest-600 bg-forest-50 px-2 py-1 rounded-full">Branch</span>
                        </div>
                        <p class="font-bold text-forest-700 text-sm mb-3 tracking-wide">SURMA RIVER WAVES INC</p>
                        <div class="space-y-2 text-sm text-forest-500 border-t border-forest-50 pt-3">
                            <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><span>USA License Filing No: 241203005247</span></p>
                            <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg><span>DOS ID: 7477523</span></p>
                            <p class="flex items-start gap-2 pt-1"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span>7230 Broadway, 2nd Floor<br>Jackson Heights, NY 11372, USA</span></p>
                            <p class="flex items-start gap-2 pt-1"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg><a href="mailto:director@surmaagro.com" class="text-forest-700 hover:text-forest-600 font-medium hover:underline">director@surmaagro.com</a></p>
                        </div>
                    </div>
                </div>

                {{-- Canada Office --}}
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden" data-gsap="fade-up">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-forest-800 flex items-center gap-3">
                                <img src="https://flagcdn.com/w40/ca.png" alt="CA" class="w-8 h-6 object-cover rounded shadow-sm"> Canada Office
                            </h3>
                            <span class="text-[10px] font-semibold text-forest-600 bg-forest-50 px-2 py-1 rounded-full">Branch</span>
                        </div>
                        <p class="font-bold text-forest-700 text-sm mb-3 tracking-wide">SURMA FOOD INC.</p>
                        <div class="space-y-2 text-sm text-forest-500 border-t border-forest-50 pt-3">
                            <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><span>Corporate Number: 1599977-4</span></p>
                            <p class="flex items-start gap-2 pt-1"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span>23 Latham Ave<br>Toronto, ON M1N 1M7, Canada</span></p>
                            <p class="flex items-start gap-2 pt-1"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg><a href="mailto:ceo@surmaagro.com" class="text-forest-700 hover:text-forest-600 font-medium hover:underline">ceo@surmaagro.com</a></p>
                        </div>
                    </div>
                </div>

                {{-- Oman Office --}}
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden" data-gsap="fade-up">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-forest-800 flex items-center gap-3">
                                <img src="https://flagcdn.com/w40/om.png" alt="OM" class="w-8 h-6 object-cover rounded shadow-sm"> Oman Office
                            </h3>
                            <span class="text-[10px] font-semibold text-forest-600 bg-forest-50 px-2 py-1 rounded-full">Branch</span>
                        </div>
                        <p class="font-bold text-forest-700 text-sm mb-3 tracking-wide">LPT Business and Contracting LLC</p>
                        <div class="space-y-2 text-sm text-forest-500 border-t border-forest-50 pt-3">
                            <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><span>Registration No: 1589201</span></p>
                            <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg><span>POA Code: 46357889</span></p>
                            <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg><span>TIN: 2185336</span></p>
                            <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg><span>License No: L3035293</span></p>
                            <p class="flex items-start gap-2 pt-1"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span>Al Billah / Baraka<br>South Al Batinah Governorate, Oman</span></p>
                            <p class="flex items-start gap-2 pt-1"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg><a href="mailto:info@surmaagro.com" class="text-forest-700 hover:text-forest-600 font-medium hover:underline">info@surmaagro.com</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-6">
                {{-- Bangladesh Office (combined card) --}}
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-forest-600 overflow-hidden" data-gsap="fade-up">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-forest-800 flex items-center gap-3">
                                <img src="https://flagcdn.com/w40/bd.png" alt="BD" class="w-8 h-6 object-cover rounded shadow-sm"> Bangladesh Office
                            </h3>
                            <span class="text-[10px] font-semibold text-forest-600 bg-forest-50 px-2 py-1 rounded-full">Branch</span>
                        </div>

                        <div class="bg-forest-50/50 rounded-xl p-4 mb-4">
                            <p class="font-bold text-forest-800 text-sm mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                Surma Agro (Dhaka)
                            </p>
                            <div class="space-y-2 text-sm text-forest-500 ml-6">
                                <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span>House No. 9, Road No. 4, Block -A, Mirpur-2, Dhaka -1216, Bangladesh</span></p>
                                <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg><span>Cell: +8801759115424</span></p>
                            </div>
                        </div>

                        <div class="rounded-xl p-4 border border-forest-100">
                            <p class="font-bold text-forest-800 text-sm mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                Kazi Traders International (Chittagong)
                            </p>
                            <div class="space-y-2 text-sm text-forest-500 ml-6">
                                <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><span>License No: TRAD/CHTG/023208/2024</span></p>
                                <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span>1321 Strand Road (4th Floor), Bank Building, Chittagong, Bangladesh</span></p>
                                <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg><span>E-TIN: 481271312835</span></p>
                                <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg><span>IRC: 260315110495721</span></p>
                                <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg><span>ERC: 260315210194321</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Thailand + Myanmar (stacked right column) --}}
                <div class="flex flex-col gap-6">
                    {{-- Thailand Office --}}
                    <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden" data-gsap="fade-up">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-forest-800 flex items-center gap-3">
                                    <img src="https://flagcdn.com/w40/th.png" alt="TH" class="w-8 h-6 object-cover rounded shadow-sm"> Thailand Office
                                </h3>
                                <span class="text-[10px] font-semibold text-forest-600 bg-forest-50 px-2 py-1 rounded-full">Branch</span>
                            </div>
                            <p class="font-bold text-forest-700 text-sm mb-3 tracking-wide">SURMA RIVER FISH LTD</p>
                            <div class="space-y-2 text-sm text-forest-500 border-t border-forest-50 pt-3">
                                <p class="flex items-start gap-2"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><span>For Surma River Fish Ltd.</span></p>
                                <p class="flex items-start gap-2 pt-1"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span>House No. 682-111, Alley 7, City Park Village, Soi Phatthanakan 38<br>Bangkok, Thailand</span></p>
                            </div>
                        </div>
                    </div>

                    {{-- Myanmar Office --}}
                    <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden" data-gsap="fade-up">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-forest-800 flex items-center gap-3">
                                    <img src="https://flagcdn.com/w40/mm.png" alt="MM" class="w-8 h-6 object-cover rounded shadow-sm"> Myanmar Office
                                </h3>
                                <span class="text-[10px] font-semibold text-white bg-forest-700 px-2 py-1 rounded-full">Head Office</span>
                            </div>
                            <p class="font-bold text-forest-700 text-sm mb-3 tracking-wide">SURMA AGRO</p>
                            <div class="space-y-2 text-sm text-forest-500 border-t border-forest-50 pt-3">
                                <p class="flex items-start gap-2 pt-1"><svg class="w-4 h-4 text-forest-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span>House No. 28-28A, Pyae Son Condo, 55 Street<br>Middle Block, 5th Floor, Pazundaung Township<br>Yangon Region, 11171, Myanmar</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Worldwide Coverage</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Our products reach importers in over 30 countries across Asia, Europe, North America, Middle East, and Africa</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-cream rounded-2xl p-8 text-center border border-warm-gray/50" data-gsap="fade-up">
                    <h3 class="text-xl font-bold text-forest-800 mb-3">Asia Pacific</h3>
                    <p class="text-forest-500 text-sm">Bangladesh, Thailand, China, Japan, South Korea, Singapore, Malaysia, Vietnam, Indonesia, Philippines</p>
                </div>
                <div class="bg-cream rounded-2xl p-8 text-center border border-warm-gray/50" data-gsap="fade-up">
                    <h3 class="text-xl font-bold text-forest-800 mb-3">North America & Europe</h3>
                    <p class="text-forest-500 text-sm">USA, Canada, UK, Germany, France, Netherlands, Italy, Spain, Poland, Switzerland</p>
                </div>
                <div class="bg-cream rounded-2xl p-8 text-center border border-warm-gray/50" data-gsap="fade-up">
                    <h3 class="text-xl font-bold text-forest-800 mb-3">Middle East & Africa</h3>
                    <p class="text-forest-500 text-sm">Saudi Arabia, UAE, Qatar, Kuwait, Oman, Bahrain, Egypt, South Africa, Nigeria, Kenya</p>
                </div>
            </div>
        </div>
    </section>
@endsection

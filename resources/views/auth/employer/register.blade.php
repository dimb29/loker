



<x-guest-layout>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Contact Form Template</title>
        <link rel="stylesheet" href="/build/tailwind.css" type="text/css" media="screen" title="no title" charset="utf-8" />

        
        <style>
            
            .headerm {
            position:relative;
            text-align:center;
            background: linear-gradient(60deg, rgb(177 159 243) 0%, rgba(0,172,193,1) 100%);
            color:white;
            }
            .inner-header {
            height:12vh;
            width:100%;
            margin: 0;
            padding: 0;
            }

            .flex1 { /*Flexbox for containers*/
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            }

            .waves {
            position:relative;
            width: 100%;
            height:15vh;
            margin-bottom:-7px; /*Fix for safari gap*/
            min-height:100px;
            max-height:150px;
            }

            /* Animation */

            .parallax > use {
            animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
            }
            .parallax > use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
            }
            .parallax > use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
            }
            .parallax > use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
            }
            .parallax > use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
            }
            @keyframes move-forever {
            0% {
            transform: translate3d(-90px,0,0);
            }
            100% { 
                transform: translate3d(85px,0,0);
            }
            }
            /*Shrinking for mobile*/
            @media (max-width: 768px) {
            .waves {
                height:40px;
                min-height:40px;
            }

            }
        </style>
    </head>
    <body class>
        @php
            $geturl = url()->current();
            $split = explode('/',$geturl);
            if(count($split) >= 6):
                if($split[4]):
                    $set_referal = $split[5];
                else:
                    $set_referal = null;
                endif;
            else:
                $set_referal = null;
            endif;
        @endphp
        <div class="lg:flex">
            <div class="lg:w-1/2 xl:max-w-screen-sm">
                <!--Hey! This is the original version
                of Simple CSS Waves-->

                <div class="headerm">

                <!--Content before waves-->
                <div class="inner-header flex1">
                    <div style="cursor: pointer;" onclick="window.location='{{ url('') }}';" class="cursor-pointer flex items-center">
                        <div>
                            <img class="h-14 w-14" src="{{url('storage/photos/logokk.png')}}" alt="">
                        </div>
                        <div class="text-2xl text-indigo-800 tracking-wide ml-2 font-semibold">KedaiKerja</div>
                    </div>
                </div>

                <!--Waves Container-->
                <div>
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
                </svg>
                </div>
                <!--Waves end-->

                </div>
                <!--Header ends-->

                <!--Content starts-->
                <!--Content ends-->
                    
                <div class="mt-10 px-12 sm:px-24 md:px-48 lg:px-12 lg:mt-16 xl:px-24 xl:max-w-2xl">
                    <div class="flex flex-row justify-center lg:justify-start">
                    <h2 class="text-center text-4xl text-indigo-700 font-display font-semibold lg:text-left xl:text-5xl
                    xl:text-bold mr-4">Employer</h2>
                    <h2 class="text-center text-4xl text-indigo-900 font-display font-semibold lg:text-left xl:text-5xl
                    xl:text-bold">Register</h2>
                    </div>
                    <x-jet-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mt-12">
                        <form method="POST" action="{{ route('employer.register') }}">
                        @csrf
                            <div>
                                <x-jet-label for="name" value="{{ __('Nama Perusahaan') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                <x-jet-input id="name" type="text" name="name" :value="old('name')" required class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" type="" placeholder="PT Nama Perusahaan"/>
                            </div>
                            <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="email" value="{{ __('Email') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                </div>
                                <x-jet-input id="email" type="email" name="email" :value="old('email')" required class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="namaperusahaan@gmail.com"/>
                            </div>
                            <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="telepon" value="{{ __('Nomor Telepon') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                </div>
                                <x-jet-input id="telepon" type="text" name="telepon" :value="old('telepon')" required class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="024 5678 ...."/>
                            </div>
                            <div class="flex flex-row">
                                <div class="mt-8 w-3/4 mr-2">
                                    <div class="flex justify-between items-center">
                                        <x-jet-label for="alamat" value="{{ __('Alamat') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                    </div>
                                    <x-jet-input id="alamat" type="text" name="alamat" :value="old('alamat')" required class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Jl. alamat lengkap perusahaan"/>
                                </div>
                                <div class="mt-8 w-1/4">
                                    <div class="flex justify-between items-center">
                                        <x-jet-label for="kodepos" value="{{ __('Kode Pos') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                    </div>
                                    <x-jet-input id="kodepos" type="text" name="kodepos" :value="old('kodepos')" required class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="50148"/>
                                </div>
                            </div>
                            <div class="flex flex-row">
                                <div class="mt-8 mr-1">
                                    <div class="flex justify-between items-center">
                                        <x-jet-label for="kota" value="{{ __('Kota') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                    </div>
                                    <x-jet-input id="kota" type="text" name="kota" :value="old('kota')" required class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Semarang"/>
                                </div>
                                <div class="mt-8 ml-1">
                                    <div class="flex justify-between items-center">
                                        <x-jet-label for="provinsi" value="{{ __('Provinsi') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                    </div>
                                    <x-jet-input id="provinsi" type="text" name="provinsi" :value="old('provinsi')" required class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Jawa Tengah"/>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="kode_referal" value="{{ __('Kode Referral') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                </div>
                                <x-jet-input id="kode_referal" type="text" name="kode_referal" value="{{$set_referal}}" class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="df27$g"/>
                            </div>
                            <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="password" value="{{ __('Password') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                </div>
                                <x-jet-input id="password" type="password" name="password" required autocomplete="new-password" class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Masukan password"/>
                            </div>
                            <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                </div>
                                <x-jet-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Konfirmasi password"/>
                            </div>
                            
                            <div class="mt-10">
                                <x-jet-button class="bg-indigo-500 text-gray-100 p-4 w-full rounded-full tracking-wide
                                font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                                shadow-lg justify-center">
                                {{ __('Register') }}
                                </x-jet-button>
                            </div>
                        </form>
                        <div class="mt-8 mb-4 text-sm font-display font-semibold text-gray-700 text-center">
                            {{ __('Already registered ?') }} <a href="{{ url('/employer/login') }}" class="cursor-pointer text-indigo-600 hover:text-indigo-800">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex items-center justify-center bg-indigo-100 flex-1 h-fit">
                <div class="w-5/6 transform duration-200 hover:scale-110 cursor-pointer">
                    <svg class="w-fit mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="illustration" viewBox="0 0 1024 768">
                    <defs>
                    <style>
                        .cls-1,.cls-13,.cls-14,.cls-15,.cls-18,.cls-19,.cls-20,.cls-4,.cls-6{fill:none;}.cls-2{fill:#eaf9f3;}.cls-3{clip-path:url(#clip-path);}.cls-4,.cls-6{stroke:#b8d8c7;}.cls-13,.cls-14,.cls-15,.cls-18,.cls-19,.cls-20,.cls-4,.cls-6{stroke-linecap:round;stroke-linejoin:round;}.cls-13,.cls-14,.cls-15,.cls-18,.cls-19,.cls-20,.cls-4{stroke-width:1.8px;}.cls-5{fill:#b8d8c7;}.cls-6{stroke-width:1.8px;}.cls-7{fill:#6dafa7;}.cls-8{fill:#b0d7c0;}.cls-9{fill:#22272e;}.cls-10{fill:#f8ab5d;}.cls-11{fill:#ffe779;}.cls-12{clip-path:url(#clip-path-2);}.cls-13{stroke:#f8ab5d;}.cls-14{stroke:#6dafa7;}.cls-15{stroke:#22272e;}.cls-16{fill:#63737a;}.cls-17{fill:#b28d93;}.cls-18{stroke:#fff;}.cls-19{stroke:#63737a;}.cls-20{stroke:#896068;}.cls-21{fill:#896068;}
                    </style>
                    <clipPath id="clip-path">
                    <path class="cls-1" d="M766.3,570.1l-520-14.9a48.07,48.07,0,0,1-46.5-43.3l-25.1-248a48.18,48.18,0,0,1,47.2-53l578.8-8A48.21,48.21,0,0,1,849.2,257L815.5,527.9A48.19,48.19,0,0,1,766.3,570.1Z"/>
                    </clipPath>
                    <clipPath id="clip-path-2">
                    <path class="cls-1" d="M690.8,404.2l-89.5-5.5A11.1,11.1,0,0,1,591,385.6l34.1-191.1a15,15,0,0,1,13.2-12.2l89.9-8.7a11.2,11.2,0,0,1,12.1,13l-34,205.2A14.82,14.82,0,0,1,690.8,404.2Z"/>
                    </clipPath>
                    </defs>
                    <path class="cls-2" d="M766.3,570.1l-520-14.9a48.07,48.07,0,0,1-46.5-43.3l-25.1-248a48.18,48.18,0,0,1,47.2-53l578.8-8A48.21,48.21,0,0,1,849.2,257L815.5,527.9A48.19,48.19,0,0,1,766.3,570.1Z"/>
                    <g class="cls-3">
                    <path class="cls-4" d="M691.4,637.4h415.5a15,15,0,0,0,15-15V386.8a15,15,0,0,0-15-15H691.4a15,15,0,0,0-15,15V622.4A15,15,0,0,0,691.4,637.4Z"/>
                    <path class="cls-4" d="M142.3,621.6H561.4a15,15,0,0,0,15-15V262.3a15,15,0,0,0-15-15H142.3a15,15,0,0,0-15,15V606.6A15,15,0,0,0,142.3,621.6Z"/>
                    <path class="cls-4" d="M791.1,301.4H881v-8.9H791.1a1.79,1.79,0,0,0-1.8,1.8v5.2A1.76,1.76,0,0,0,791.1,301.4Z"/>
                    <path class="cls-4" d="M807.4,292.5h20.3a4.32,4.32,0,0,0,4.3-3.8l1.6-14.4a4.33,4.33,0,0,0-4.3-4.8H805.8a4.34,4.34,0,0,0-4.3,4.8l1.6,14.4A4.25,4.25,0,0,0,807.4,292.5Z"/>
                    <path class="cls-5" d="M819.9,269.6s8-.8,9.6-11.6c0,0-7.2,2.1-9.5,7.2,0,0-1-11.4-6.4-12.5,0,0-2.4,8.5,1.4,12.7,0,0-2.9-4.8-10.3-4.7a13.6,13.6,0,0,0,9.2,8.8"/>
                    <path class="cls-4" d="M694.6,421.5h90.2a4.23,4.23,0,0,0,4.2-4.2V389.9a4.23,4.23,0,0,0-4.2-4.2H694.6a4.23,4.23,0,0,0-4.2,4.2v27.4A4.23,4.23,0,0,0,694.6,421.5Z"/>
                    <path class="cls-5" d="M729.3,395.3h20.8a1.54,1.54,0,0,0,1.5-1.5h0a1.54,1.54,0,0,0-1.5-1.5H729.3a1.54,1.54,0,0,0-1.5,1.5h0A1.47,1.47,0,0,0,729.3,395.3Z"/>
                    <path class="cls-4" d="M694.6,467.3h90.2a4.23,4.23,0,0,0,4.2-4.2V435.7a4.23,4.23,0,0,0-4.2-4.2H694.6a4.23,4.23,0,0,0-4.2,4.2V463A4.25,4.25,0,0,0,694.6,467.3Z"/>
                    <path class="cls-5" d="M729.3,441.1h20.8a1.54,1.54,0,0,0,1.5-1.5h0a1.54,1.54,0,0,0-1.5-1.5H729.3a1.54,1.54,0,0,0-1.5,1.5h0A1.47,1.47,0,0,0,729.3,441.1Z"/>
                    <path class="cls-4" d="M231.4,499.6h90.2a4.23,4.23,0,0,0,4.2-4.2V468a4.23,4.23,0,0,0-4.2-4.2H231.4a4.23,4.23,0,0,0-4.2,4.2v27.4A4.23,4.23,0,0,0,231.4,499.6Z"/>
                    <path class="cls-5" d="M266.2,473.5H287a1.54,1.54,0,0,0,1.5-1.5h0a1.54,1.54,0,0,0-1.5-1.5H266.2a1.54,1.54,0,0,0-1.5,1.5h0A1.47,1.47,0,0,0,266.2,473.5Z"/>
                    <path class="cls-4" d="M347.2,499.6h90.2a4.23,4.23,0,0,0,4.2-4.2V468a4.23,4.23,0,0,0-4.2-4.2H347.2A4.23,4.23,0,0,0,343,468v27.4A4.23,4.23,0,0,0,347.2,499.6Z"/>
                    <path class="cls-5" d="M382,473.5h20.8a1.54,1.54,0,0,0,1.5-1.5h0a1.54,1.54,0,0,0-1.5-1.5H382a1.54,1.54,0,0,0-1.5,1.5h0A1.47,1.47,0,0,0,382,473.5Z"/>
                    <path class="cls-4" d="M809.6,421.5h90.2a4.23,4.23,0,0,0,4.2-4.2V389.9a4.23,4.23,0,0,0-4.2-4.2H809.6a4.23,4.23,0,0,0-4.2,4.2v27.4A4.23,4.23,0,0,0,809.6,421.5Z"/>
                    <path class="cls-5" d="M844.3,395.3h20.8a1.54,1.54,0,0,0,1.5-1.5h0a1.54,1.54,0,0,0-1.5-1.5H844.3a1.54,1.54,0,0,0-1.5,1.5h0A1.47,1.47,0,0,0,844.3,395.3Z"/>
                    <path class="cls-4" d="M809.6,467.3h90.2a4.23,4.23,0,0,0,4.2-4.2V435.7a4.23,4.23,0,0,0-4.2-4.2H809.6a4.23,4.23,0,0,0-4.2,4.2V463A4.25,4.25,0,0,0,809.6,467.3Z"/>
                    <path class="cls-5" d="M844.3,441.1h20.8a1.54,1.54,0,0,0,1.5-1.5h0a1.54,1.54,0,0,0-1.5-1.5H844.3a1.54,1.54,0,0,0-1.5,1.5h0A1.47,1.47,0,0,0,844.3,441.1Z"/>
                    <path class="cls-4" d="M100.1,352.1h455a4.65,4.65,0,0,0,4.6-4.6V267.8a4.65,4.65,0,0,0-4.6-4.6h-455a4.65,4.65,0,0,0-4.6,4.6v79.7A4.59,4.59,0,0,0,100.1,352.1Z"/>
                    <path class="cls-4" d="M100.1,451.1h455a4.65,4.65,0,0,0,4.6-4.6V366.8a4.65,4.65,0,0,0-4.6-4.6h-455a4.65,4.65,0,0,0-4.6,4.6v79.7A4.65,4.65,0,0,0,100.1,451.1Z"/>
                    <rect class="cls-4" x="519.23" y="301.82" width="9.9" height="50.3"/>
                    <rect class="cls-4" x="508.89" y="315.54" width="10.3" height="36.6"/>
                    <rect class="cls-4" x="220.85" y="400.66" width="9.9" height="50.3"/>
                    <rect class="cls-4" x="210.51" y="414.38" width="10.3" height="36.6"/>
                    <rect class="cls-4" x="240.94" y="400.66" width="9.9" height="50.3"/>
                    <rect class="cls-6" x="258.03" y="399.83" width="9.9" height="50.3" transform="translate(-115.76 98.9) rotate(-17.52)"/>
                    <rect class="cls-4" x="230.7" y="414.38" width="10.3" height="36.6"/>
                    <path class="cls-5" d="M221,308.4l-1.1-14.9a1.65,1.65,0,0,1,1.7-1.8h8.6a1.71,1.71,0,0,1,1.7,1.8l-1.1,14.9s9,5.8,8.9,10.6c-.1,3.7-2.3,21.4-3.3,29.2a4.32,4.32,0,0,1-4.3,3.8H219.7a4.32,4.32,0,0,1-4.3-3.8c-1-7.8-3.2-25.5-3.3-29.2C212,314.2,221,308.4,221,308.4Z"/>
                    <line class="cls-4" x1="860.1" y1="545.4" x2="-95.7" y2="545.4"/>
                    </g>
                    <path class="cls-4" d="M423.9,451.1H340.7a4.91,4.91,0,0,1-4.9-4.9V433a4.91,4.91,0,0,1,4.9-4.9h83.2a4.91,4.91,0,0,1,4.9,4.9v13.1A4.93,4.93,0,0,1,423.9,451.1Z"/>
                    <rect class="cls-4" x="352.2" y="407.1" width="60" height="21"/>
                    <circle class="cls-5" cx="345.2" cy="435.8" r="1.5"/>
                    <polygon class="cls-7" points="407.8 463 397.5 463 396.4 475.8 406.3 475.8 407.8 463"/>
                    <path class="cls-8" d="M396.4,475.8l-13.1,149a3,3,0,0,0,2.9,3.2,2.92,2.92,0,0,0,2.9-2.6l17.2-149.6Z"/>
                    <polygon class="cls-8" points="497.8 463 487.5 463 489 475.8 498.9 475.8 497.8 463"/>
                    <path class="cls-8" d="M489,475.8l17.2,149.6a2.92,2.92,0,0,0,5.8-.6l-13.1-149Z"/>
                    <rect class="cls-8" x="395.4" y="544" width="106.2" height="5.1"/>
                    <path class="cls-9" d="M508.4,466.7H386.9a3.48,3.48,0,0,1-3.5-3.5v-.3a3.48,3.48,0,0,1,3.5-3.5H508.5a3.48,3.48,0,0,1,3.5,3.5v.3A3.56,3.56,0,0,1,508.4,466.7Z"/>
                    <path class="cls-10" d="M695.7,404.8l-89.5-5.5a11.1,11.1,0,0,1-10.3-13.1L630,195.1a15,15,0,0,1,13.2-12.2l89.9-8.7a11.2,11.2,0,0,1,12.1,13l-34,205.2A14.74,14.74,0,0,1,695.7,404.8Z"/>
                    <path class="cls-11" d="M690.8,404.2l-89.5-5.5A11.1,11.1,0,0,1,591,385.6l34.1-191.1a15,15,0,0,1,13.2-12.2l89.9-8.7a11.2,11.2,0,0,1,12.1,13l-34,205.2A14.82,14.82,0,0,1,690.8,404.2Z"/>
                    <g class="cls-12"><path class="cls-10" d="M781,296.2l-137.8,2.4a5.7,5.7,0,0,1-5.7-6.7l10.1-57.5a7.33,7.33,0,0,1,6.6-6l136-9.1a7.23,7.23,0,0,1,7.6,8.4l-10,62.5A6.75,6.75,0,0,1,781,296.2Z"/>
                    </g>
                    <g class="cls-12">
                        <path class="cls-10" d="M765.8,388.9l-137.8-6a5.78,5.78,0,0,1-5.4-6.7L633,317.3a7.28,7.28,0,0,1,7.1-6l136.2-1.1a7.27,7.27,0,0,1,7.2,8.4l-10.2,64.3A7.26,7.26,0,0,1,765.8,388.9Z"/>
                    </g>
                    <line class="cls-13" x1="623" y1="206" x2="738.6" y2="196.8"/>
                    <path class="cls-9" d="M681.8,192.1l-9.9.9c-.9.1-1.4-.6-1.3-1.6h0a2.34,2.34,0,0,1,1.9-1.9l9.9-.9c.9-.1,1.5.6,1.3,1.6h0A2.46,2.46,0,0,1,681.8,192.1Z"/>
                    <path class="cls-9" d="M688.4,191.5h0c-.9.1-1.5-.6-1.3-1.6h0A2.34,2.34,0,0,1,689,188h0c.9-.1,1.5.6,1.3,1.6h0A2.13,2.13,0,0,1,688.4,191.5Z"/>
                    <path class="cls-14" d="M799.8,198.3l-38.1,2.9a2,2,0,0,1-2.2-2.4l3.8-23.1a3.08,3.08,0,0,1,2.8-2.6l37.7-4a2.46,2.46,0,0,1,2.7,2.8l-3.7,23.8A3.51,3.51,0,0,1,799.8,198.3Z"/>
                    <path class="cls-14" d="M764.3,173.7l16.6,10.7a2.73,2.73,0,0,0,3,0l21.6-14.8"/>
                    <path class="cls-7" d="M627.9,241.5l-31.3,1.7-4.6,3a1.44,1.44,0,0,1-2.2-1.5l4.9-27.2a4.89,4.89,0,0,1,4.4-4l32.6-2.5a3.26,3.26,0,0,1,3.5,3.8L631,238.6A3.39,3.39,0,0,1,627.9,241.5Z"/>
                    <line class="cls-15" x1="600.8" y1="221.5" x2="627.2" y2="219.6"/>
                    <line class="cls-15" x1="599.6" y1="228.2" x2="626" y2="226.4"/>
                    <line class="cls-15" x1="598.4" y1="234.8" x2="612.2" y2="234"/>
                    <path class="cls-9" d="M773.6,290.1l-137.8,2.4a5.7,5.7,0,0,1-5.7-6.7l10.1-57.5a7.33,7.33,0,0,1,6.6-6l136-9.1a7.23,7.23,0,0,1,7.6,8.4l-10,62.5A6.82,6.82,0,0,1,773.6,290.1Z"/>
                    <path class="cls-11" d="M671.5,246.6c-.7,4.1-4.3,7.6-8,7.8s-6.1-3-5.4-7.1,4.3-7.6,8-7.8S672.2,242.5,671.5,246.6Z"/>
                    <path class="cls-11" d="M668.9,272.9l-16.4.5a3.51,3.51,0,0,1-3.6-4.1l.3-1.8c1.3-7.4,7.7-13.7,14.4-13.9h0c6.7-.3,11.2,5.6,9.9,13.1l-.4,2.6A4.48,4.48,0,0,1,668.9,272.9Z"/>
                    <path class="cls-7" d="M758.8,247.3l-65.3,3a2.09,2.09,0,0,1-2.2-2.5l.7-4.4a3.29,3.29,0,0,1,3-2.7l65.4-3.4a2.06,2.06,0,0,1,2.2,2.5l-.8,4.8A3.11,3.11,0,0,1,758.8,247.3Z"/>
                    <polygon class="cls-11" points="692.8 262.1 693.8 265.2 696.9 265.7 694.2 268.4 694 271.9 691.4 270.5 688.2 272.1 689.2 268.6 687.4 266.1 690.7 265.3 692.8 262.1"/>
                    <polygon class="cls-11" points="707.8 261.6 708.9 264.7 712 265.2 709.3 267.9 709.2 271.4 706.4 270 703.2 271.6 704.2 268.1 702.4 265.5 705.7 264.8 707.8 261.6"/>
                    <polygon class="cls-11" points="723.2 261 724.3 264.1 727.5 264.7 724.7 267.4 724.6 271 721.8 269.5 718.5 271.2 719.5 267.6 717.6 265 721.1 264.2 723.2 261"/>
                    <polygon class="cls-11" points="738.9 260.4 740 263.6 743.3 264.1 740.5 266.9 740.4 270.5 737.5 269 734.1 270.7 735.2 267 733.2 264.5 736.7 263.7 738.9 260.4"/>
                    <polygon class="cls-11" points="755 259.8 756.1 263 759.5 263.6 756.6 266.3 756.5 270 753.5 268.5 750.1 270.2 751.2 266.5 749.2 263.9 752.7 263.1 755 259.8"/>
                    <path class="cls-9" d="M758.3,382.8l-137.7-6.1a5.78,5.78,0,0,1-5.4-6.7l10.4-58.9a7.28,7.28,0,0,1,7.1-6L768.9,304a7.27,7.27,0,0,1,7.2,8.4l-10.2,64.3A7.36,7.36,0,0,1,758.3,382.8Z"/>
                    <path class="cls-11" d="M656.8,331.7c-.7,4.2-4.3,7.6-8.1,7.5s-6.1-3.5-5.4-7.7,4.3-7.5,8-7.5S657.6,327.5,656.8,331.7Z"/>
                    <path class="cls-11" d="M653.9,358.7l-16.4-.5a3.61,3.61,0,0,1-3.4-4.1l.4-2.1c1.3-7.6,7.7-13.6,14.4-13.5h0c6.7.1,11.2,6.4,9.8,14.1l-.4,2.5A4.34,4.34,0,0,1,653.9,358.7Z"/>
                    <path class="cls-7" d="M743.9,337.9l-65.3-.9a2.16,2.16,0,0,1-2.1-2.5l.8-4.6a3.22,3.22,0,0,1,3.2-2.7l65.4.5a2.16,2.16,0,0,1,2.1,2.5l-.8,5A3.43,3.43,0,0,1,743.9,337.9Z"/>
                    <polygon class="cls-11" points="678 349.1 679 352.3 682.1 353 679.4 355.6 679.3 359.2 676.6 357.5 673.4 359 674.4 355.4 672.7 352.8 675.9 352.2 678 349.1"/>
                    <polygon class="cls-11" points="693.1 349.4 694.1 352.6 697.3 353.4 694.5 356 694.4 359.6 691.6 358 688.4 359.5 689.4 355.9 687.6 353.1 691 352.6 693.1 349.4"/>
                    <polygon class="cls-11" points="708.5 349.8 709.5 353 712.8 353.8 710 356.4 709.8 360.1 707 358.4 703.7 359.9 704.8 356.3 702.9 353.5 706.3 353 708.5 349.8"/>
                    <polygon class="cls-16" points="724.2 350.1 725.3 353.4 728.6 354.2 725.7 356.9 725.6 360.6 722.7 358.9 719.3 360.4 720.4 356.7 718.5 353.9 722 353.3 724.2 350.1"/>
                    <polygon class="cls-16" points="740.2 350.5 741.4 353.8 744.7 354.6 741.8 357.3 741.7 361.1 738.8 359.3 735.3 360.9 736.4 357.1 734.4 354.4 738 353.8 740.2 350.5"/>
                    <path class="cls-9" d="M755.9,152.3a4,4,0,1,0-.3,5.7A4,4,0,0,0,755.9,152.3Z"/>
                    <path class="cls-7" d="M750.5,142.9l-.7-.8a6.34,6.34,0,0,0-9-.4h0a6.34,6.34,0,0,0-.4,9l.7.8a7.63,7.63,0,0,1,1.7,3.2c.2.9.5,2,.8,3a3,3,0,0,0,4.9,1.5l4.5-4.1,4.5-4.1a3,3,0,0,0-1-5c-1-.4-2-.7-2.9-1A11.29,11.29,0,0,1,750.5,142.9Z"/>
                    <path class="cls-10" d="M374.7,282.4l-119.6,20a7.84,7.84,0,0,1-9-6.6L230.8,186.4a6.61,6.61,0,0,1,7.3-7.5l118.2,14a7.85,7.85,0,0,1,6.8,6.3l15.2,78.1A4.42,4.42,0,0,1,374.7,282.4Z"/>
                    <path class="cls-11" d="M379.7,281,260.1,301a7.84,7.84,0,0,1-9-6.6L235.7,185a6.61,6.61,0,0,1,7.3-7.5l118.2,14a7.85,7.85,0,0,1,6.8,6.3l15.2,78.1A4.28,4.28,0,0,1,379.7,281Z"/>
                    <path class="cls-9" d="M303.3,275.5l-29.5,3.4a4,4,0,0,1-4.5-3.4l-10.8-72.2a3.12,3.12,0,0,1,3.4-3.6l29.5,2.2a4,4,0,0,1,3.7,3.4l11,66.6A3.32,3.32,0,0,1,303.3,275.5Z"/>
                    <path class="cls-7" d="M305.7,274.2l-29.5,3.4a4,4,0,0,1-4.5-3.4L260.9,202a3.12,3.12,0,0,1,3.4-3.6l29.5,2.2a4,4,0,0,1,3.7,3.4l11,66.6A3.24,3.24,0,0,1,305.7,274.2Z"/>
                    <line class="cls-15" x1="276.6" y1="204" x2="281.2" y2="204.3"/>
                    <line class="cls-15" x1="283.6" y1="204.5" x2="283.9" y2="204.5"/>
                    <line class="cls-15" x1="261.8" y1="207.7" x2="298.4" y2="209.6"/>
                    <line class="cls-15" x1="270.9" y1="268.6" x2="307.5" y2="265.2"/>
                    <path class="cls-9" d="M345.4,213c.5,2.8-.8,5-2.9,4.9s-4.4-2.5-4.9-5.3.8-5.1,3-4.9S344.8,210.2,345.4,213Z"/>
                    <path class="cls-9" d="M349.3,230.9h-9a3.22,3.22,0,0,1-3.2-2.7l-.3-1.6c-.9-5.3,1.6-9.4,5.5-9.3h0c3.9.1,7.7,4.3,8.6,9.4l.3,1.8A1.9,1.9,0,0,1,349.3,230.9Z"/>
                    <path class="cls-9" d="M338.8,246.7c.5,3-.9,5.5-3.2,5.7s-4.7-2.2-5.2-5.3.9-5.6,3.3-5.7S338.2,243.7,338.8,246.7Z"/>
                    <path class="cls-9" d="M342.8,265.8l-9.5,1a3.3,3.3,0,0,1-3.6-2.7l-.3-1.6c-1-5.6,1.7-10.4,6-10.7h0c4.1-.3,8.2,3.9,9.2,9.3l.3,1.8A2.38,2.38,0,0,1,342.8,265.8Z"/>
                    <path class="cls-9" d="M363.2,245.5c.5,2.8-.6,5.1-2.6,5.3s-4.1-2.1-4.6-4.9.7-5.2,2.7-5.3S362.7,242.8,363.2,245.5Z"/>
                    <path class="cls-9" d="M366.8,263.3l-7.4.8a3.2,3.2,0,0,1-3.5-2.7l-.2-1.3c-1-5.2,1.3-9.6,4.9-9.9h0c3.6-.2,7.2,3.7,8.1,8.7l.3,1.5A2.58,2.58,0,0,1,366.8,263.3Z"/>
                    <line class="cls-15" x1="311" y1="232.8" x2="320.2" y2="232.7"/>
                    <path class="cls-9" d="M320,236.9l5.2-3.4a.9.9,0,0,0-.1-1.6l-6.4-3.3a.88.88,0,0,0-1.3,1l1.2,6.7A.87.87,0,0,0,320,236.9Z"/>
                    <path class="cls-17" d="M549.6,574.5s1.4,13.7,2.6,20.8c.3,2.1,8.2,4.5,15.4,3,8.9-1.8,9.4-6.9,9.4-6.9s-1.7-24-1.9-25.7S550.9,568.5,549.6,574.5Z"/>
                    <path class="cls-9" d="M574.8,583.4c-6.9,3.5-15.9,3.6-21.2,3.3a5,5,0,0,1-4.7-4.4c-.5-4.4-.9-7.8-.9-7.8,1.4-6.7,28.3-11.7,28.5-9.8.1.9.6,7.4,1.1,13.9A5.12,5.12,0,0,1,574.8,583.4Z"/>
                    <path class="cls-9" d="M552,594.5s-1.3,1.7-.7,5.6-.1,21.4,2.1,23.5,27,.6,38.1-1.9c11.9-2.7,19.4-7.4,20.2-9.9,1.2-3.6.2-4.1-12.1-7.7s-18.5-8.7-21.1-11.6a5.91,5.91,0,0,0-8.5-.5c-1.5,1.3-3.3,6-6.6,6C555.5,597.9,552.8,594.1,552,594.5Z"/>
                    <path class="cls-18" d="M595.1,601.4s-9.2.8-15.9,10.4"/>
                    <path class="cls-18" d="M587.5,597.9a21.07,21.07,0,0,0-14.2,9.4"/>
                    <path class="cls-17" d="M466,574.8s-1.4,19.3-1.6,20.2,1.4,5.6,10.9,6.9,12.7-4.5,12.7-4.5,3.4-17.7,4-20.9S469.1,571.5,466,574.8Z"/>
                    <path class="cls-9" d="M493.8,576.1c-.3,1.3-1,4.9-1.7,8.9a5,5,0,0,1-4.4,4.1,43.5,43.5,0,0,1-20.4-2.6,5.12,5.12,0,0,1-3.3-5.2c.3-4,.5-7.3.5-7.3C467.9,570.3,494.5,572.5,493.8,576.1Z"/>
                    <path class="cls-9" d="M464.4,594.3s-2.4.6-2.6,4.7-4.9,22.8-4.7,24.8,1.3,4.5,16.4,4.3,23.5.6,26.3-1.8-1-7.9-3.8-12.9-7-12.5-7.7-16.6a13.86,13.86,0,0,1-3.3,1.7c-.9.1-1.8-4.2-7.4-4.2-6.5,0-8.8,3.6-9.4,3.5A7.16,7.16,0,0,1,464.4,594.3Z"/>
                    <path class="cls-18" d="M468.5,606.4s11.2-4.2,21.1,0"/>
                    <path class="cls-18" d="M467.7,612.1s13.3-4.2,24.3,0"/>
                    <path class="cls-9" d="M491.4,395.6s21.2,5.8,46.6,14.8c24,8.5,33.4,13.5,36,30.2s-.6,76.2,2.6,91.9,6.9,26.8,3.8,34.9a12.25,12.25,0,0,1-6.4,7.2s-12.9,5.5-24.4,2.9a17.18,17.18,0,0,1-10.2-8.6c-3.8-7.1-.1-30-3-47.1s-6.1-45.3-9.6-64.2-60.5-26.5-67.8-41.4-3.5-28-3.5-28S485,387.6,491.4,395.6Z"/>
                    <path class="cls-19" d="M476.6,414.6a47,47,0,0,0-.7-7.5"/>
                    <path class="cls-19" d="M574.9,451.6a15.83,15.83,0,0,1-3.8.5c-8.8,0-16.3-7.4-16.7-16.4a15.94,15.94,0,0,1,7.8-14.5c6.9,4.6,10.4,10.3,11.8,19.5C574.4,443.3,574.7,447.1,574.9,451.6Z"/>
                    <path class="cls-9" d="M392.7,396.9s-.8,7.4-.1,24.3c.7,16.5,13.3,38.1,40.3,38.4s42.9,0,42.9,0-2.1,9.6-3.1,34.1-8.4,41.3-13.2,56.6c-4.2,13.4-4.2,22.8,5.5,27.3a71.75,71.75,0,0,0,27.6,3.9s7.4-.6,9.6-18.3,11.6-51.9,19.3-73.9,13.8-50.2,1.9-59.8-52.4-15.4-54.5-16.4-1.8-14.5-4.3-22.8C462.2,381.8,400.8,380.2,392.7,396.9Z"/>
                    <path class="cls-19" d="M521.6,489.2c7.7-21.9,13.8-50.2,1.9-59.8S471.1,414,469,413"/>
                    <path class="cls-19" d="M469.1,413s-10.4-2-14.6-1.3"/>
                    <path class="cls-19" d="M394.5,432.1c3.5-1.5,8.7-5.2,11.9-14.3"/>
                    <path class="cls-19" d="M475.8,459.6a25.14,25.14,0,0,1,5.2-8.4"/>
                    <path class="cls-19" d="M530.1,452.4a15.27,15.27,0,0,1-13.7,8.6c-8.8,0-16.3-7.4-16.7-16.4a15.41,15.41,0,0,1,15.4-16.4,16.33,16.33,0,0,1,11.7,5C529.7,437.9,530.6,444.7,530.1,452.4Z"/>
                    <path class="cls-19" d="M469.1,587.2a7.89,7.89,0,0,1,0-3.2"/>
                    <path class="cls-19" d="M477.8,589.1a11.62,11.62,0,0,0,1-3.5"/>
                    <path class="cls-19" d="M487,589.1a11.59,11.59,0,0,0,1.4-3.1"/>
                    <path class="cls-19" d="M555,586.7a17.48,17.48,0,0,1-1.2-4.1"/>
                    <path class="cls-19" d="M566.1,586.1a12.71,12.71,0,0,0-.3-4.5"/>
                    <path class="cls-19" d="M575.9,582.6a9.47,9.47,0,0,0-.1-4.3"/>
                    <path class="cls-11" d="M470.9,281.1s9.9,1.7,25.7,5.4a296.25,296.25,0,0,0,29.6,5.1s16.3-7.3,35.6-15.6a360.71,360.71,0,0,1,33.9-12.9s5,.4,7.9,7.7a19.2,19.2,0,0,1,1.3,8.8,5,5,0,0,1-2.3,3.8c-4.4,2.9-16.5,11-35.5,24.1-24.2,16.7-34.3,17.9-46.3,17.4-13.3-.6-46.3-6-46.3-6s-8.9-1.7-12-17.6C459.6,285.4,467.8,280.5,470.9,281.1Z"/>
                    <path class="cls-13" d="M526,324.9s-3.9-1.1-1.3-5.5,12.8-7.9,19.1-5.3c5.3,2.2,2.1,5.9,2.1,5.9"/>
                    <path class="cls-13" d="M589.5,265.2a19.42,19.42,0,0,0,1.8,11.1c3.3,6.5,7.3,8.6,8.5,9"/>
                    <path class="cls-17" d="M595.7,263.1s-.8,6.1,1.7,11.2a17.31,17.31,0,0,0,3.9,5.5,3.57,3.57,0,0,0,3.7.7,13,13,0,0,1,3.7-1.1c2.2-.2,8.2,1.1,11.7-1.4s4.3-2.8,4.8-2.9,5.8-.1,6.7-.5c1.8-.8,2.2-3.8,1.3-5-.8-1-6-1.1-7-2.6s-.1-3.1,5.5-4.5,15.5-4.5,15.2-6.9-5.6-.6-12.4.1-10,.9-12.8-.2-6.6-1-10.9,1.1c-2.8,1.4-5.8,2.6-11.1,4.9A24,24,0,0,1,595.7,263.1Z"/>
                    <path class="cls-17" d="M632.6,262.3a18.16,18.16,0,0,1,1,5c.1,2.2-3.1,8.2-5.4,9.3s-3.8-.1-4.8-1.7-3.6-11.1,1.4-12.2S631.6,261.4,632.6,262.3Z"/>
                    <path class="cls-20" d="M633.1,269.6c-.8-1-6-1.1-7-2.6s-.1-3.1,5.5-4.5,15.5-4.5,15.2-6.9"/>
                    <path class="cls-20" d="M624,256.2a19.86,19.86,0,0,0-5.6.5"/>
                    <path class="cls-20" d="M620.3,278c3.5-2.6,4.3-2.8,4.8-2.9s5.8-.1,6.7-.5"/>
                    <path class="cls-9" d="M434.1,270.5s1.1-4.1,8.6-3.7,18.4,4.3,19.1,9.9S437.6,285.4,434.1,270.5Z"/>
                    <path class="cls-11" d="M487.6,315.8c-1-31.6-16.6-34.7-16.6-34.7a237,237,0,0,0-38.7-2.5c-21.2.4-37.8,4-46.4,16.2-7.6,10.8-24.2,58.7-19.9,72,3.6,11.2,14.2,13.9,33.2,10.6-1.2,7-2.6,12.5-2.6,12.5,8,5.8,25.7,11.5,52.2,11.5,23.6,0,35.5-7.7,35.5-7.7C483.4,386.6,488.5,347.4,487.6,315.8Z"/>
                    <path class="cls-7" d="M462,288.5c1.1,6.7,1.6,21.3,3.4,35.1s2.1,34.1,2.2,53.5a180.32,180.32,0,0,0,3.5,34.6c13.5-4.5,23.1-15.1,23.1-15.1s1.3-1.6-2.2-14.5-4.4-58.5-4.4-58.5a92.67,92.67,0,0,0-1.2-22.7c-2.2-10.9-9.6-18.6-15.3-20.4a29.18,29.18,0,0,0-9.6-1.4s.2,5.1.5,9.4"/>
                    <path class="cls-17" d="M435.7,259.1s-.6,11.4-.6,17c0,9.8,13.4,19.9,18.4,19.9,8.1,0,9.5-9.5,9.1-13.7s-.5-16.4-.4-16.7S440.7,253.7,435.7,259.1Z"/>
                    <path class="cls-21" d="M440.5,265.1c1.5,12.4,11.4,18.9,22.1,18.5a4.48,4.48,0,0,0-.1-1.2c-.2-1.7-.3-4.7-.3-7.6C454.5,278.8,445,272.3,440.5,265.1Z"/>
                    <path class="cls-7" d="M447.6,293.8c-.7,11.9,3.7,41.5,3.7,75.1s-4.9,47.4-4.9,47.4c-41.3,4.9-62.3-12.5-62.3-12.5s1.6-3.5,5.1-13.2,3.5-21.6,3.5-21.6,4.8-43.9,3.1-53.7-8-22.8-8-22.8,5-7.3,18.4-11c10.4-2.9,21.7-3.2,26.2-3.2l-.1.5C436.9,289.1,447.6,293.8,447.6,293.8Z"/>
                    <path class="cls-2" d="M411.9,383.6a67.11,67.11,0,0,0,20.7,2.5c1.3-.1,2.3.7,2.2,1.7v.1a2.17,2.17,0,0,1-2,1.6c-4.5.3-16.1-.4-22.1-2.8a1.87,1.87,0,0,1-1.3-2.1h0C409.6,383.7,410.8,383.3,411.9,383.6Z"/>
                    <path class="cls-2" d="M477.4,383.3c2-.5,6.5-1.5,11.4-3.2.7-.2,1.5.4,1.7,1.4v.1a1.4,1.4,0,0,1-.6,1.7c-2.3.9-8.1,3-11.8,3.2a1.77,1.77,0,0,1-1.5-1.3h0C476.4,384.3,476.7,383.5,477.4,383.3Z"/>
                    <path class="cls-17" d="M478.4,333.8h-.5c-7.6,4.1-12,3.9-12.5.1.8-.5,1.5-1,2.2-1.5a14.26,14.26,0,0,1,5.5-2.1,41.7,41.7,0,0,1,4.4-.5s2.2-.5,2.6.3C480.5,330.7,480.4,332.2,478.4,333.8Z"/>
                    <path class="cls-9" d="M528.8,368.9l-56.8-.1a3,3,0,0,1-3-3.3l4.3-44a3.66,3.66,0,0,1,3.9-3.3l57,3.8a2.44,2.44,0,0,1,2.2,2.6l-4.6,41.6A3,3,0,0,1,528.8,368.9Z"/>
                    <path class="cls-16" d="M509.4,326.9a1,1,0,0,0-1-1.2,1.5,1.5,0,0,0-1.4,1.2,1,1,0,0,0,1,1.2A1.6,1.6,0,0,0,509.4,326.9Z"/>
                    <path class="cls-11" d="M458.1,358a2.69,2.69,0,0,1-1.7,1.9A288.87,288.87,0,0,1,410.9,375c-4.2,1-8.2,1.9-11.8,2.5-19.1,3.2-29.6.6-33.2-10.6-4.3-13.3,12.3-61.1,19.9-72a24.33,24.33,0,0,1,2-2.5h0c10.5-8.2,21.4-.2,23.8,13.2,1.2,7.1-1.8,14.9-4.3,23.8-1.8,6.4-6.4,16.7-6.4,16.7l52.4-5.4a2.64,2.64,0,0,1,2.5,1C460.6,347,459,354.9,458.1,358Z"/>
                    <path class="cls-13" d="M400.9,346s-10.2,1.2-14.1,3.8"/>
                    <path class="cls-13" d="M446.2,341.3s-2.8,3.2-1.7,9.9c1.2,7.3,4.4,9.3,6.6,10.8"/>
                    <path class="cls-13" d="M365.9,367.8s-1.1-6,7.6-6.1,18.5,11.9,12.4,17.1"/>
                    <path class="cls-17" d="M498,348.8c-.6,1.9-5.2.1-8.7-.9-4.5-1.3-7.5-2.3-7.8-2.4a59.88,59.88,0,0,1,8.3,5.4c3.6,2.7,6.3,5.6,5.1,7s-8.4-2.8-8.4-2.8,2.6,1.8,3.2,3.9-2.9,1.4-9.5-2.6c0,0-2.5.1-7.2,2.2s-11.7,1.1-13.9.4a9.79,9.79,0,0,0-2.7-.4,3.32,3.32,0,0,1-2.6-1.3,15.34,15.34,0,0,1-3.4-7.9c-.4-3.7.5-5.8,1.2-6.8a2.59,2.59,0,0,1,1.4-1.1,24.49,24.49,0,0,0,3.5-1.5c.9-.5,4.2-2.9,7.5-5.1a17,17,0,0,0,1.4-1,105.48,105.48,0,0,0,12.5-.1h.5c4.3-.3,15.8.7,17,2s-.5,3-5.9,2.9a61.27,61.27,0,0,0-8.7.6,53.29,53.29,0,0,1,8.7,3C493.7,344.2,498.7,346.9,498,348.8Z"/>
                    <path class="cls-20" d="M481.6,345.5s-1.6-.6-2.8-.9a10.1,10.1,0,0,0-2.2-.3"/>
                    <path class="cls-20" d="M486.5,355.1s-3.3-3.4-7.1-4.2c-1.7-.3-2.8-.4-2.8-.4"/>
                    <path class="cls-20" d="M480.9,339.3a16.42,16.42,0,0,0-4.3.4"/>
                    <path class="cls-20" d="M472.2,334a12.49,12.49,0,0,1-2.4-.2"/>
                    <path class="cls-9" d="M461.7,283.5a26.69,26.69,0,0,1,0-4,13.78,13.78,0,0,0,.1-2.8v-2.3s.6,1.3,1.8,3.4-.6,11.3-1.5,12.4Z"/>
                    <path class="cls-17" d="M472.6,239a144.9,144.9,0,0,0,0,18.3,20.72,20.72,0,0,1-14.3,20.9c-6.7,2.1-19.3-3.1-22.3-18s-9.5-31.7,7.9-37.8S472.8,224.8,472.6,239Z"/>
                    <path class="cls-9" d="M435,249.5s2.1-1.3,2.8-5.7a3.09,3.09,0,0,1,1.5-2.4,6.68,6.68,0,0,0,3.9-4.9c.2-1.9,1-3.3,3-2.2,15.7,9.1,26.1.8,26.1.8l.1,5.7c6.1-1.7,9.8-9.7,8.6-15.6-1.5-7.4-4.3-6-7.8-11.6s-9.9-9.5-18.1-6.6-11.2,4.2-17.6,4.1-12.5,2.6-13,8.6-6,7.8-7,13.4,1.2,8.4,3.3,10.6-1.9,8.4,3.4,13.6,8.8,6.8,11,10.2C435.5,267.5,436.3,258.3,435,249.5Z"/>
                    <path class="cls-17" d="M436.8,251.2s-3.8-6.4-8.9-3.5.3,12.9,8.2,12.4"/>
                    <path class="cls-9" d="M464.1,246.3a10.62,10.62,0,0,0,1.5,2.8,9,9,0,0,0,.9,1,4.46,4.46,0,0,1,1.3,1.4,4.25,4.25,0,0,1,.1,3.8,4,4,0,0,1-1,1.5,2.9,2.9,0,0,1-1.5.9,5.49,5.49,0,0,0,1.1-2.8,4.94,4.94,0,0,0-.3-2.5c-.2-.4-.4-.5-.9-1a5.37,5.37,0,0,1-1-1.6A6,6,0,0,1,464.1,246.3Z"/>
                    <path class="cls-15" d="M458.7,266a7.15,7.15,0,0,1-6.7-3.4"/>
                    <path class="cls-9" d="M453,250.5h0a1.37,1.37,0,0,1-1.4-1.4v-1.4a1.37,1.37,0,0,1,1.4-1.4h0a1.37,1.37,0,0,1,1.4,1.4v1.4A1.43,1.43,0,0,1,453,250.5Z"/>
                    <path class="cls-9" d="M468.5,250.5h0a1.37,1.37,0,0,1-1.4-1.4v-1.4a1.37,1.37,0,0,1,1.4-1.4h0a1.37,1.37,0,0,1,1.4,1.4v1.4A1.43,1.43,0,0,1,468.5,250.5Z"/>
                    <path class="cls-9" d="M455,243.2c-1,.4-1.7-.8-3.2-.4-2.3.7-3.4,1.5-3.8.5-.3-.7,1.1-2.5,3.3-3.1C454.5,239.5,456.8,242.5,455,243.2Z"/>
                    <path class="cls-9" d="M466.6,243.2c.8.3,1.4-.8,2.5-.5,1.5.5,2.3,1.1,2.5.3.2-.6-.6-2.2-2.1-2.7C467.1,239.5,465,242.6,466.6,243.2Z"/>
                    <path class="cls-9" d="M428.7,251.9a1.59,1.59,0,0,1,.8-1,1.91,1.91,0,0,1,1.5-.4,2.3,2.3,0,0,1,1.4.9,7.46,7.46,0,0,1,.7,1.2,12.3,12.3,0,0,1,.6,2.2c.1.3.1.5.3.7a2.34,2.34,0,0,0,1,.5,1.94,1.94,0,0,1-1.3.3,2.38,2.38,0,0,1-1.3-.9,9.69,9.69,0,0,1-1-2.1,7.93,7.93,0,0,0-.4-.9,1,1,0,0,0-.4-.5C430.3,251.5,429.5,251.6,428.7,251.9Z"/>
                    <path class="cls-11" d="M437.7,313.6c.4,3.8-2.1,7.9-5.7,8.2a6.9,6.9,0,0,1-1.4-13.7C434.3,307.7,437.4,309.8,437.7,313.6Z"/>
                    <path class="cls-9" d="M447.6,293.8s-10.7-4.7-15.4-15.1l1.9-8.2a23.71,23.71,0,0,0,9.8,9.9,7.19,7.19,0,0,1,3.9,6.1A61.47,61.47,0,0,1,447.6,293.8Z"/>
                    <path class="cls-9" d="M316.5,352.3a5.48,5.48,0,0,1-5.5,5.5,5.55,5.55,0,0,1-5.5-5.5,5.5,5.5,0,1,1,11,0Z"/>
                    <path class="cls-9" d="M316.5,371.6h-11a4.48,4.48,0,0,1-4.5-4.5h0a10,10,0,0,1,10-10h0a10,10,0,0,1,10,10h0A4.48,4.48,0,0,1,316.5,371.6Z"/>
                    <path class="cls-14" d="M283,359.2a28,28,0,0,0,50.5,16.7"/>
                    <polygon class="cls-7" points="336.5 379.2 336.7 370.2 328.8 374.5 336.5 379.2"/>
                    <path class="cls-14" d="M338.9,359.2a28,28,0,0,0-51.1-15.8"/>
                    <polygon class="cls-7" points="284.7 340.2 284.9 349.1 292.6 344.5 284.7 340.2"/>
                    </svg>
                </div>
            </div>
        </div>
    </body>
</html>
</x-guest-layout>
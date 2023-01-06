




<x-guest-layout>
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
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
                    xl:text-bold">Login</h2>
                    </div>
                    <div class="mt-12">
                        <form method="POST" action="{{ route('employer.logins') }}">
                        @csrf
                            <div>
                                <x-jet-label for="email" value="{{ __('Email Address') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                <x-jet-input id="email" type="email" name="email" :value="old('email')" required autofocus class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" type="" placeholder="liam.h@gmail.com"/>
                            </div>
                            <div class="mt-8">
                                <div class="flex justify-between items-center">
                                    <x-jet-label for="password" value="{{ __('Password') }}" class="text-sm font-bold text-gray-700 tracking-wide"/>
                                     
                                    <div>
                                    @if (Route::has('password.request'))
                                        <a class="text-xs font-display font-semibold text-indigo-600 hover:text-indigo-800
                                        cursor-pointer" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                    </div>
                                </div>
                                <x-jet-input id="password" type="password" name="password" required autocomplete="current-password" class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500" placeholder="Enter your password"/>
                            </div>
                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="mt-10">
                                <x-jet-button class="bg-indigo-500 text-gray-100 p-4 w-full rounded-full tracking-wide
                                font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                                shadow-lg justify-center">
                                {{ __('Login') }}
                                </x-jet-button>
                            </div>
                        </form>
                        <div class="mt-12 text-sm font-display font-semibold text-gray-700 text-center">
                            Don't have an account ? <a href="{{ url('employer/register') }}" class="cursor-pointer text-indigo-600 hover:text-indigo-800">Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex items-center justify-center bg-indigo-100 flex-1 h-screen">
                <div class="w-5/6 transform duration-200 hover:scale-110 cursor-pointer">
                    <svg class="w-full mx-auto" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="illustration" viewBox="0 0 1024 768">
                    <defs>
                    <style>
                    .cls-1,.cls-13,.cls-16,.cls-17,.cls-19,.cls-21,.cls-4,.cls-6{fill:none;}.cls-2{fill:#eaf9f3;}.cls-3{clip-path:url(#clip-path);}.cls-4,.cls-6{stroke:#b8d8c7;}.cls-13,.cls-16,.cls-17,.cls-19,.cls-21,.cls-4,.cls-6{stroke-linecap:round;stroke-linejoin:round;}.cls-13,.cls-16,.cls-17,.cls-19,.cls-21,.cls-4{stroke-width:1.8px;}.cls-5{fill:#b8d8c7;}.cls-6{stroke-width:1.8px;}.cls-7{fill:#22272e;}.cls-8{fill:#63737a;}.cls-9{fill:#fff;}.cls-10{fill:#f4c2c9;}.cls-11{fill:#b0d7c0;}.cls-12{fill:#ffe779;}.cls-13{stroke:#63737a;}.cls-14{fill:#f8ab5d;}.cls-15{fill:#6dafa7;}.cls-16{stroke:#22272e;}.cls-17{stroke:#000;}.cls-18{fill:#e26e85;}.cls-19{stroke:#e26e85;}.cls-20{clip-path:url(#clip-path-2);}.cls-21{stroke:#f8ab5d;}
                    </style>
                    <clipPath id="clip-path">
                    <path class="cls-1" d="M766.3,584.5l-520-14.9a48.07,48.07,0,0,1-46.5-43.3l-25.1-248a48.18,48.18,0,0,1,47.2-53l578.8-8a48.21,48.21,0,0,1,48.5,54.1L815.5,542.3A48.19,48.19,0,0,1,766.3,584.5Z"/>
                    </clipPath>
                    <clipPath id="clip-path-2">
                    <path class="cls-1" d="M418.1,273.5c1.7-9.6,5.3-24.5,40-24.6,29.6-.1,43.3,4.3,50.5,9.8s8,20,5.7,42.7-2.7,36.2-1.4,50.3,7,20.2-.6,27.8a176.93,176.93,0,0,1-49.9,7.2c-28,0-41.9-7.8-42.5-10s-3.3-2.9-.8-8.6,4.2-25.8,2.6-37.9c-.9-7.1-3.5-17.1-4.6-29A109.62,109.62,0,0,1,418.1,273.5Z"/>
                    </clipPath>
                    </defs>
                    <path class="cls-2" d="M766.3,584.5l-520-14.9a48.07,48.07,0,0,1-46.5-43.3l-25.1-248a48.18,48.18,0,0,1,47.2-53l578.8-8a48.21,48.21,0,0,1,48.5,54.1L815.5,542.3A48.19,48.19,0,0,1,766.3,584.5Z"/>
                    <g class="cls-3">
                    <path class="cls-4" d="M341.9,629.5H-73.6a15,15,0,0,1-15-15V378.9a15,15,0,0,1,15-15H341.9a15,15,0,0,1,15,15V614.5A15,15,0,0,1,341.9,629.5Z"/>
                    <path class="cls-4" d="M891,613.7H471.9a15,15,0,0,1-15-15V254.4a15,15,0,0,1,15-15H891a15,15,0,0,1,15,15V598.7A15,15,0,0,1,891,613.7Z"/>
                    <path class="cls-4" d="M242.3,293.5H152.4v-8.9h89.9a1.79,1.79,0,0,1,1.8,1.8v5.2A1.82,1.82,0,0,1,242.3,293.5Z"/>
                    <path class="cls-4" d="M226,284.6H205.7a4.32,4.32,0,0,1-4.3-3.8l-1.6-14.4a4.33,4.33,0,0,1,4.3-4.8h23.5a4.34,4.34,0,0,1,4.3,4.8l-1.6,14.4A4.32,4.32,0,0,1,226,284.6Z"/>
                    <path class="cls-5" d="M213.4,261.7s-8-.8-9.6-11.6c0,0,7.2,2.1,9.5,7.2,0,0,1-11.4,6.4-12.5,0,0,2.4,8.5-1.4,12.7,0,0,2.9-4.8,10.3-4.7a13.6,13.6,0,0,1-9.2,8.8"/>
                    <path class="cls-4" d="M761.7,344.3H741.4a4.32,4.32,0,0,1-4.3-3.8l-1.6-14.4a4.33,4.33,0,0,1,4.3-4.8h23.5a4.34,4.34,0,0,1,4.3,4.8L766,340.5A4.41,4.41,0,0,1,761.7,344.3Z"/>
                    <path class="cls-5" d="M749.2,321.3s-8-.8-9.6-11.6c0,0,7.2,2.1,9.5,7.2,0,0,1-11.4,6.4-12.5,0,0,2.4,8.5-1.4,12.7,0,0,2.9-4.8,10.3-4.7a13.6,13.6,0,0,1-9.2,8.8"/>
                    <path class="cls-4" d="M338.7,413.6H248.5a4.23,4.23,0,0,1-4.2-4.2V382a4.23,4.23,0,0,1,4.2-4.2h90.2a4.23,4.23,0,0,1,4.2,4.2v27.4A4.1,4.1,0,0,1,338.7,413.6Z"/>
                    <path class="cls-5" d="M304,387.5H283.2a1.54,1.54,0,0,1-1.5-1.5h0a1.54,1.54,0,0,1,1.5-1.5H304a1.54,1.54,0,0,1,1.5,1.5h0A1.54,1.54,0,0,1,304,387.5Z"/>
                    <path class="cls-4" d="M338.7,459.4H248.5a4.23,4.23,0,0,1-4.2-4.2V427.8a4.23,4.23,0,0,1,4.2-4.2h90.2a4.23,4.23,0,0,1,4.2,4.2v27.4A4.1,4.1,0,0,1,338.7,459.4Z"/>
                    <path class="cls-5" d="M304,433.3H283.2a1.54,1.54,0,0,1-1.5-1.5h0a1.54,1.54,0,0,1,1.5-1.5H304a1.54,1.54,0,0,1,1.5,1.5h0A1.54,1.54,0,0,1,304,433.3Z"/>
                    <path class="cls-4" d="M801.9,491.8H711.7a4.23,4.23,0,0,1-4.2-4.2V460.2a4.23,4.23,0,0,1,4.2-4.2h90.2a4.23,4.23,0,0,1,4.2,4.2v27.4A4.1,4.1,0,0,1,801.9,491.8Z"/>
                    <path class="cls-5" d="M767.2,465.6H746.4a1.54,1.54,0,0,1-1.5-1.5h0a1.54,1.54,0,0,1,1.5-1.5h20.8a1.54,1.54,0,0,1,1.5,1.5h0A1.47,1.47,0,0,1,767.2,465.6Z"/>
                    <path class="cls-4" d="M686.1,491.8H595.9a4.23,4.23,0,0,1-4.2-4.2V460.2a4.23,4.23,0,0,1,4.2-4.2h90.2a4.23,4.23,0,0,1,4.2,4.2v27.4A4.23,4.23,0,0,1,686.1,491.8Z"/>
                    <path class="cls-5" d="M651.4,465.6H630.6a1.54,1.54,0,0,1-1.5-1.5h0a1.54,1.54,0,0,1,1.5-1.5h20.8a1.54,1.54,0,0,1,1.5,1.5h0A1.47,1.47,0,0,1,651.4,465.6Z"/>
                    <path class="cls-4" d="M569.5,491.8H479.3a4.23,4.23,0,0,1-4.2-4.2V460.2a4.23,4.23,0,0,1,4.2-4.2h90.2a4.23,4.23,0,0,1,4.2,4.2v27.4A4.1,4.1,0,0,1,569.5,491.8Z"/>
                    <path class="cls-5" d="M534.8,465.6H514a1.54,1.54,0,0,1-1.5-1.5h0a1.54,1.54,0,0,1,1.5-1.5h20.8a1.54,1.54,0,0,1,1.5,1.5h0A1.47,1.47,0,0,1,534.8,465.6Z"/>
                    <path class="cls-4" d="M223.7,413.6H133.5a4.23,4.23,0,0,1-4.2-4.2V382a4.23,4.23,0,0,1,4.2-4.2h90.2a4.23,4.23,0,0,1,4.2,4.2v27.4A4.1,4.1,0,0,1,223.7,413.6Z"/>
                    <path class="cls-5" d="M189,387.5H168.2a1.54,1.54,0,0,1-1.5-1.5h0a1.54,1.54,0,0,1,1.5-1.5H189a1.54,1.54,0,0,1,1.5,1.5h0A1.47,1.47,0,0,1,189,387.5Z"/>
                    <path class="cls-4" d="M223.7,459.4H133.5a4.23,4.23,0,0,1-4.2-4.2V427.8a4.23,4.23,0,0,1,4.2-4.2h90.2a4.23,4.23,0,0,1,4.2,4.2v27.4A4.1,4.1,0,0,1,223.7,459.4Z"/>
                    <path class="cls-5" d="M189,433.3H168.2a1.54,1.54,0,0,1-1.5-1.5h0a1.54,1.54,0,0,1,1.5-1.5H189a1.54,1.54,0,0,1,1.5,1.5h0A1.47,1.47,0,0,1,189,433.3Z"/>
                    <path class="cls-4" d="M933.2,344.3h-455a4.65,4.65,0,0,1-4.6-4.6V260a4.65,4.65,0,0,1,4.6-4.6h455a4.65,4.65,0,0,1,4.6,4.6v79.7A4.59,4.59,0,0,1,933.2,344.3Z"/>
                    <path class="cls-4" d="M933.2,443.2h-455a4.65,4.65,0,0,1-4.6-4.6V358.9a4.65,4.65,0,0,1,4.6-4.6h455a4.65,4.65,0,0,1,4.6,4.6v79.7A4.59,4.59,0,0,1,933.2,443.2Z"/>
                    <rect class="cls-4" x="504.3" y="293.9" width="9.9" height="50.3"/>
                    <rect class="cls-4" x="514.1" y="307.7" width="10.3" height="36.6"/>
                    <rect class="cls-4" x="802.6" y="392.8" width="9.9" height="50.3"/>
                    <rect class="cls-4" x="812.5" y="406.5" width="10.3" height="36.6"/>
                    <rect class="cls-4" x="782.5" y="392.8" width="9.9" height="50.3"/>
                    <rect class="cls-6" x="745.21" y="412.12" width="50.3" height="9.9" transform="translate(140.69 1026.1) rotate(-72.48)"/>
                    <rect class="cls-4" x="792.4" y="406.5" width="10.3" height="36.6"/>
                    <rect class="cls-4" x="669.1" y="293.9" width="9.9" height="50.3"/>
                    <rect class="cls-4" x="679" y="307.7" width="10.3" height="36.6"/>
                    <rect class="cls-4" x="571.3" y="293.9" width="9.9" height="50.3"/>
                    <rect class="cls-6" x="534.01" y="313.3" width="50.3" height="9.9" transform="translate(87.31 755.64) rotate(-72.48)"/>
                    <rect class="cls-4" x="581.2" y="307.7" width="10.3" height="36.6"/>
                    <path class="cls-5" d="M812.4,300.5l1.1-14.9a1.65,1.65,0,0,0-1.7-1.8h-8.6a1.71,1.71,0,0,0-1.7,1.8l1.1,14.9s-9,5.8-8.9,10.6c.1,3.7,2.3,21.4,3.3,29.2a4.32,4.32,0,0,0,4.3,3.8h12.4a4.32,4.32,0,0,0,4.3-3.8c1-7.8,3.2-25.5,3.3-29.2C821.4,306.3,812.4,300.5,812.4,300.5Z"/>
                    <path class="cls-5" d="M712.2,399.6l1.1-14.9a1.65,1.65,0,0,0-1.7-1.8H703a1.71,1.71,0,0,0-1.7,1.8l1.1,14.9s-9,5.8-8.9,10.6c.1,3.7,2.3,21.4,3.3,29.2a4.32,4.32,0,0,0,4.3,3.8h12.4a4.32,4.32,0,0,0,4.3-3.8c1-7.8,3.2-25.5,3.3-29.2C721.2,405.4,712.2,399.6,712.2,399.6Z"/>
                    <line class="cls-4" x1="173.2" y1="547.6" x2="1129" y2="547.6"/>
                    <path class="cls-4" d="M281.3,363.9H205.8a6.12,6.12,0,0,1-6.1-6.1V342a6.12,6.12,0,0,1,6.1-6.1h75.5a6.12,6.12,0,0,1,6.1,6.1v15.8A6.06,6.06,0,0,1,281.3,363.9Z"/>
                    <line class="cls-4" x1="207.2" y1="340.5" x2="208.1" y2="340.5"/>
                    <path class="cls-4" d="M273.2,356.3H214a5,5,0,0,1,5-5h49.1a5,5,0,0,1,5.1,5Z"/>
                    <rect class="cls-4" x="222.3" y="314.5" width="42.6" height="21.5"/>
                    </g>
                    <path class="cls-7" d="M587.4,408.5l-39.4-15a2.84,2.84,0,0,1-1.8-2.7h0l63.2-9.2s7.8,13.1,7,13.4S587.4,408.5,587.4,408.5Z"/>
                    <path class="cls-8" d="M546.2,390.9l42.2,14.8L612.6,394s-5.3-11.9-5.9-11.8S546.2,390.9,546.2,390.9Z"/>
                    <path class="cls-7" d="M586.6,406l13.8-58.6a6.61,6.61,0,0,1,6.1-5l63.3-1.7a2.44,2.44,0,0,1,2.4,3.1l-12.9,45a6.49,6.49,0,0,1-4.7,4.5l-65,15.6A2.39,2.39,0,0,1,586.6,406Z"/>
                    <ellipse class="cls-8" cx="636.72" cy="371.08" rx="6" ry="3.8" transform="matrix(0.28, -0.96, 0.96, 0.28, 101.14, 877.32)"/>
                    <path class="cls-8" d="M687.2,311.1,542.4,303a6.49,6.49,0,0,1-6.1-7.1l12.4-126.5a8.74,8.74,0,0,1,7.9-7.8L708.4,150a6.43,6.43,0,0,1,6.9,7.3l-19,146.3A8.75,8.75,0,0,1,687.2,311.1Z"/>
                    <path class="cls-7" d="M683.2,311.1,537.7,303a6.43,6.43,0,0,1-6.1-7.1L544,168.8a8.66,8.66,0,0,1,8-7.8l152.5-11.7a6.55,6.55,0,0,1,7,7.3l-19.1,147A9,9,0,0,1,683.2,311.1Z"/>
                    <polygon class="cls-9" points="680.5 248.4 678.4 264.9 657.8 264.5 659.7 248.3 680.5 248.4"/>
                    <polygon class="cls-10" points="639.1 248.2 637.2 264.1 616.2 263.8 617.9 248.2 639.1 248.2"/>
                    <polygon class="cls-11" points="657.8 264.5 655.8 280.6 635.3 279.9 637.2 264.1 657.8 264.5"/>
                    <path class="cls-8" d="M575.1,176.7l-17.1,1a1.11,1.11,0,0,1-1.1-1.1l.3-2.9a1.91,1.91,0,0,1,1.6-1.6L576,171a1,1,0,0,1,1.1,1.1l-.3,3A1.91,1.91,0,0,1,575.1,176.7Z"/>
                    <path class="cls-11" d="M585.9,211.2l-30.2.9a2.1,2.1,0,0,1-2.1-2.3l1.6-15.8a2.78,2.78,0,0,1,2.6-2.5l30.4-1.5a2,2,0,0,1,2.1,2.3l-1.8,16.4A2.7,2.7,0,0,1,585.9,211.2Z"/>
                    <path class="cls-12" d="M632.5,209.8l-33.1,1a2.1,2.1,0,0,1-2.1-2.3l1.8-16.7a2.78,2.78,0,0,1,2.6-2.5l33.4-1.6a2,2,0,0,1,2.1,2.3l-2,17.3A2.88,2.88,0,0,1,632.5,209.8Z"/>
                    <path class="cls-10" d="M683.2,208.3l-36.5,1.1a2.05,2.05,0,0,1-2.1-2.3l2.1-17.6a2.87,2.87,0,0,1,2.6-2.5l36.7-1.8a2,2,0,0,1,2.1,2.3l-2.3,18.3A2.78,2.78,0,0,1,683.2,208.3Z"/>
                    <path class="cls-13" d="M593.6,294.4l75.8,3.4a5.41,5.41,0,0,0,5.5-4.6l8.4-66.2a5.21,5.21,0,0,0-5.3-5.9l-77.5,1.5a5.38,5.38,0,0,0-5.2,4.7l-6.7,61.3A5.25,5.25,0,0,0,593.6,294.4Z"/>
                    <line class="cls-13" x1="594.6" y1="232.7" x2="682.6" y2="231.8"/>
                    <line class="cls-13" x1="619.7" y1="233.1" x2="612.6" y2="295.2"/>
                    <line class="cls-13" x1="640.9" y1="232.9" x2="633.4" y2="296.2"/>
                    <line class="cls-13" x1="661.6" y1="232.8" x2="653.8" y2="297.1"/>
                    <line class="cls-13" x1="618" y1="248.2" x2="680.5" y2="248.4"/>
                    <line class="cls-13" x1="616.2" y1="263.8" x2="678.4" y2="264.9"/>
                    <line class="cls-13" x1="614.4" y1="279.3" x2="676.3" y2="281.2"/>
                    <path class="cls-8" d="M683.8,166.9a3.11,3.11,0,0,1-2.4,2.7c-1.2.1-2-1-1.8-2.4a3.11,3.11,0,0,1,2.4-2.7A1.89,1.89,0,0,1,683.8,166.9Z"/>
                    <path class="cls-8" d="M674,167.6a2.78,2.78,0,0,1-2.4,2.6c-1.2.1-2-1-1.8-2.4a2.78,2.78,0,0,1,2.4-2.6C673.4,165.1,674.2,166.2,674,167.6Z"/>
                    <path class="cls-8" d="M664.4,168.2a2.88,2.88,0,0,1-2.4,2.6c-1.1.1-1.9-1-1.8-2.3a2.88,2.88,0,0,1,2.4-2.6C663.8,165.7,664.5,166.8,664.4,168.2Z"/>
                    <path class="cls-14" d="M376.2,290.9l-93.3,7.4c-2.9.2-5.5-2.4-5.7-5.8l-5.5-86.4c-.2-3.4,2.3-6.5,5.2-6.2l89.9,9a6.2,6.2,0,0,1,5.5,5.7l7.3,72.1A3.63,3.63,0,0,1,376.2,290.9Z"/>
                    <path class="cls-12" d="M380.7,290.1l-94.4,7.5c-3,.2-5.6-2.4-5.8-5.8l-5.4-86.9c-.2-3.5,2.4-6.6,5.3-6.3l91,8.9a6.29,6.29,0,0,1,5.6,5.7l7.4,72.5A4.19,4.19,0,0,1,380.7,290.1Z"/>
                    <path class="cls-7" d="M318.4,280l-21.6,1a3.07,3.07,0,0,1-3-3l-4-58.7c-.1-1.6,1.1-3.1,2.5-3l21.3,1.5a2.93,2.93,0,0,1,2.6,2.9l4.5,56.4A2.69,2.69,0,0,1,318.4,280Z"/>
                    <path class="cls-15" d="M320.3,279.1l-21.7,1.1a3.07,3.07,0,0,1-3-3l-4-58.9c-.1-1.6,1.1-3.1,2.5-3l21.4,1.5a2.93,2.93,0,0,1,2.6,2.9l4.5,56.6A2.65,2.65,0,0,1,320.3,279.1Z"/>
                    <line class="cls-16" x1="302.6" y1="219.8" x2="305.9" y2="220"/>
                    <line class="cls-16" x1="307.7" y1="220.1" x2="308" y2="220.1"/>
                    <line class="cls-16" x1="291.9" y1="222.9" x2="318.5" y2="224.4"/>
                    <line class="cls-16" x1="295.3" y1="272.6" x2="322.2" y2="271.7"/>
                    <path class="cls-15" d="M363.8,220.8l-21-1.6a2,2,0,0,0-2.2,2.2l.7,8.2a2.06,2.06,0,0,0,2,1.9l21,.8a2.08,2.08,0,0,0,2.2-2.3l-.7-7.4A2.35,2.35,0,0,0,363.8,220.8Z"/>
                    <path class="cls-15" d="M347.8,241.8a2.36,2.36,0,0,1-2.5,2.5,3,3,0,0,1-3-2.6,2.39,2.39,0,0,1,2.6-2.5A3,3,0,0,1,347.8,241.8Z"/>
                    <line class="cls-13" x1="352.4" y1="241.9" x2="366.7" y2="242.1"/>
                    <path class="cls-15" d="M348.6,250.6a2.49,2.49,0,0,1-2.5,2.6,3,3,0,0,1-3-2.5,2.46,2.46,0,0,1,2.6-2.6A2.92,2.92,0,0,1,348.6,250.6Z"/>
                    <line class="cls-13" x1="353.2" y1="250.5" x2="367.4" y2="250.3"/>
                    <path class="cls-15" d="M349.4,259.3a2.49,2.49,0,0,1-2.5,2.6,2.79,2.79,0,0,1-3-2.4,2.46,2.46,0,0,1,2.6-2.6A2.82,2.82,0,0,1,349.4,259.3Z"/>
                    <line class="cls-13" x1="353.9" y1="259.1" x2="368.1" y2="258.5"/>
                    <path class="cls-15" d="M333.4,354.6c-1.3,0,4.5-13.8,10.5-11.9S341,354.7,333.4,354.6Z"/>
                    <path class="cls-15" d="M334.1,356.5s-6.5-8.2-13-6.3S322.7,361.3,334.1,356.5Z"/>
                    <path class="cls-15" d="M332.2,348.3s9.7-16.7,5.6-20.7C330.5,320.5,321.3,341.5,332.2,348.3Z"/>
                    <path class="cls-7" d="M348.4,386.3l-14.2,3.2a8.39,8.39,0,0,1-9.6-5l-6.5-15.6a5.27,5.27,0,0,1,3.7-7.2l25.8-5.8a5.23,5.23,0,0,1,6.4,4.9l.8,16.8A8.1,8.1,0,0,1,348.4,386.3Z"/>
                    <path class="cls-17" d="M335,360s-4.5-13.7-2.8-20.1"/>
                    <path class="cls-10" d="M385.6,416.6s-.6,6.9-2.2,11-4.4,9.1-3.5,16,7.5,17,10.1,16.7,1.2-4.7,1.2-4.7,2.6,3.7,5.1,2.6-.9-9.1-.9-9.1,3.1,5,5.9,4.4-2.8-8.5-2.8-8.5,3.7,4.1,4.7,3.5,1.9-.3,0-5,1.2-20,1.1-23.5S390.6,413.4,385.6,416.6Z"/>
                    <path class="cls-12" d="M422.7,430.5l19.5,40.8a3.21,3.21,0,0,1-1.5,4.3l-57.9,29.2a3.22,3.22,0,0,1-4.5-1.7l-21.7-55.8a3.24,3.24,0,0,1,2.3-4.3L419,428.8A3.12,3.12,0,0,1,422.7,430.5Z"/>
                    <path class="cls-15" d="M395.2,476l3.2,7.7a1.87,1.87,0,0,1-1,2.5l-8.2,3.7a1.9,1.9,0,0,1-2.6-1l-3.3-8.1a1.92,1.92,0,0,1,1.1-2.5l8.2-3.3A2.12,2.12,0,0,1,395.2,476Z"/>
                    <line class="cls-13" x1="378.9" y1="469.9" x2="370.7" y2="449.6"/>
                    <line class="cls-13" x1="385" y1="467.7" x2="376.8" y2="447.9"/>
                    <path class="cls-10" d="M413.5,468.6l3,6.8a1.87,1.87,0,0,1-1,2.5l-6.4,2.9a2,2,0,0,1-2.6-1l-3.1-7.1a2,2,0,0,1,1-2.6l6.5-2.6A2.18,2.18,0,0,1,413.5,468.6Z"/>
                    <line class="cls-13" x1="399.1" y1="462.6" x2="391.1" y2="444"/>
                    <line class="cls-13" x1="404.3" y1="460.7" x2="396.3" y2="442.6"/>
                    <polygon class="cls-17" points="428.5 460.6 432.9 470 424.4 473.9 419.9 464.1 428.5 460.6"/>
                    <line class="cls-13" x1="416.4" y1="456.4" x2="408.6" y2="439.3"/>
                    <line class="cls-13" x1="420.8" y1="454.8" x2="413.1" y2="438.1"/>
                    <path class="cls-10" d="M405.1,418.9a47.43,47.43,0,0,0,1.6,9.1,86,86,0,0,1,2.2,15.6c.1,2.7-4,1.8-6.3-2.4s-3.4-5.4-5.4-6.5a9.17,9.17,0,0,1-5-6C391,425,401.7,414.8,405.1,418.9Z"/>
                    <path class="cls-15" d="M437.8,253.1c-5.7,0-21.1,2.2-34.3,31.7-11,24.5-17.4,38.2-19,49.3s-2.9,37.6-1.8,57,2,27.6,2,27.6,9,5.9,20.9,0c0,0,3.1-23.8,5.5-37.8s3.3-28.1,2.7-34.4c0,0,15.7-27.6,22.7-38.6C443.7,296.9,470,253.1,437.8,253.1Z"/>
                    <path class="cls-17" d="M384.1,411.2a26.32,26.32,0,0,0,22.5,0"/>
                    <path class="cls-17" d="M384.9,331.4a8.62,8.62,0,0,1,7-5.4c6.8-1,10.6,5.9,9,14.1s-7.8,12.3-12.8,11.4a5.88,5.88,0,0,1-4.5-3.7"/>
                    <path class="cls-13" d="M514.5,645.3a14.54,14.54,0,0,1,5.8-10c5.4-3.8,11.6,3.2-2.5,8.9"/>
                    <path class="cls-13" d="M519.8,643.4s5.8-2.7,8.8.7-5.5,5.7-10,2.7"/>
                    <path class="cls-13" d="M427.7,645.3s8.5-9.9,15.9-10-1,8.2-10.3,11.1"/>
                    <path class="cls-13" d="M434.1,645.3s10.4-4,11.7,0-11,2.9-11,2.9"/>
                    <path class="cls-10" d="M489.5,619.3s-.4,17.8,0,22.7,9.4,8,16.6,5.7,7.4-7,7.4-7,1.6-21.5,1.6-25.6S489.6,611.2,489.5,619.3Z"/>
                    <path class="cls-7" d="M489.5,619.3s-.1,4.3-.1,9.3c8.1,3.1,18,2.1,25,.9.4-6,.8-12.5.8-14.6C515.1,610.9,489.6,611.2,489.5,619.3Z"/>
                    <path class="cls-7" d="M489.3,639s-1.4-.2-2.8,10.4-2.5,17,1.7,17.8,44.1,0,48.4,0,7.2-2.3,7-5.1-11-7.2-16-11.2-12.3-8.8-13.1-11.5c-1.4-4.5-4.2-6.2-6.6-.4-1.9,4.5-6.9,5-13.1,4.2A6.42,6.42,0,0,1,489.3,639Z"/>
                    <path class="cls-13" d="M529.1,652s-8.3,1.8-7.1,12.1"/>
                    <path class="cls-10" d="M408,615.9s-2.2,22.1-2,25.1,9.8,3.9,16,3.1,7-2.7,7-2.7,4.9-20.7,4.9-25.4S410,610.1,408,615.9Z"/>
                    <path class="cls-7" d="M408,615.9s-.4,3.9-.8,8.7c8.1,3.8,16.4,4.1,24.9,3.4,1-5,1.9-10,1.9-12C434.1,611.2,410,610.1,408,615.9Z"/>
                    <path class="cls-7" d="M406.1,635.3a66.09,66.09,0,0,0-2.3,10c-.6,4.7-4.9,20.1-2,22.3s44.4,0,48,0,8.1-2.2,7.6-6.1-8.2-5.5-13.8-9.4A120.66,120.66,0,0,1,430.8,641s1.2-6,.2-7.7-4.1,5.1-6.3,5.9-6.9,1.5-14.4,0A5.34,5.34,0,0,1,406.1,635.3Z"/>
                    <path class="cls-13" d="M443.6,652s-7,2.4-7.9,12.1"/>
                    <path class="cls-7" d="M512.6,372.5s3.5,12.1,5.5,37.2,4.7,70.9,5.5,79.9.8,32.9-1.6,61.8-1.2,52.8-.4,58.3-3.1,10.2-7,11.7-21.5,1.6-25.1,0c0,0-8.6-4.7-7.4-12.9s1.6-24.7-2.3-55.2,0-52.5,0-52.5-4.5-13.8-9.6-28.1c-1.8-5.1-3.7-10.3-5.4-15a116.89,116.89,0,0,0-6.2-14.5c-5.1-8.6-9-46.2-3.1-65.8C461.3,358,502.8,358,512.6,372.5Z"/>
                    <path class="cls-7" d="M421,371.3s-10.2,27.4-7.4,58.7,8.6,67.7,7.4,70.5-5.5,16.8-9.8,48.1-13.7,55.2-11.4,61.1,8.8,9,10.5,9.4,19.7,2.3,24,1.6,11-7.8,11-16,.8-25.8,9-54,11.1-36.5,14-49.4,5.6-81.3,5.6-81.3,7.3-34.1-15.9-41.1C434.8,371.7,421,371.3,421,371.3Z"/>
                    <path class="cls-13" d="M443.3,442s16.3-2.6,22.2,1.6"/>
                    <path class="cls-13" d="M420.4,396s9.9,3.5,26.9,5.2c0,0-1.8,17.6-2.9,21.3s-8.6,6.9-14.2,6.9c-5.2,0-10.9-5.7-12.1-9.9C416.6,413.8,420.4,396,420.4,396Z"/>
                    <path class="cls-13" d="M466.5,401.4s16.8,1.8,29.3-2.8c0,0,1.9,18.9,1.6,22s-7.3,8.9-12.5,10.1c-4.4,1-11.6-2.3-15-5.3S466.5,401.4,466.5,401.4Z"/>
                    <path class="cls-13" d="M519.1,424.5s-7.9-4.8-8.7-26"/>
                    <path class="cls-13" d="M470.1,472.8c-1.8-5.1-3.7-10.3-5.4-15a116.89,116.89,0,0,0-6.2-14.5"/>
                    <path class="cls-13" d="M429.9,499.4s12.1-2.7,19.4,0"/>
                    <path class="cls-13" d="M479.7,500.9a26,26,0,0,1,12.2-1.4"/>
                    <path class="cls-13" d="M411.6,622.6s-.4,3.5-.4,4.3"/>
                    <path class="cls-13" d="M419.3,624.3s-.2,3.7-.4,4.4"/>
                    <path class="cls-13" d="M429.1,624.7s-.5,3.5-.6,4"/>
                    <path class="cls-13" d="M493.2,625.8v4.7"/>
                    <path class="cls-13" d="M502.2,626.1a42.3,42.3,0,0,1-.6,4.9"/>
                    <path class="cls-13" d="M511.3,626.1s-.2,3-.3,4.3"/>
                    <ellipse class="cls-17" cx="490.1" cy="211.9" rx="7.2" ry="8.7"/>
                    <path class="cls-10" d="M490,192.3s2.6,4.6,1.8,14.5,1.4,18.1.2,24.6a13.94,13.94,0,0,1-9.3,10.6c-2.7.8-16.7,2.7-23.6-6.5s-13.2-36.3-2-41.5S485.3,187,490,192.3Z"/>
                    <path class="cls-10" d="M491.9,231.4c1.3-6.6-1.1-14.6-.2-24.6s-1.8-14.5-1.8-14.5c-4.7-5.3-21.6-3.4-32.9,1.8-8.5,3.9-6.9,20.4-2.7,32.1,8.1,9,19.7,14.7,32.1,12.8a7.17,7.17,0,0,0,1.3-.1A12.84,12.84,0,0,0,491.9,231.4Z"/>
                    <path class="cls-18" d="M454.4,226.2a39.09,39.09,0,0,0,4.7,9.4c6.9,9.2,20.8,7.2,23.6,6.5a14.84,14.84,0,0,0,5.1-3C487.2,239,476.6,245.7,454.4,226.2Z"/>
                    <line class="cls-17" x1="485.3" y1="211.8" x2="497.3" y2="211.4"/>
                    <path class="cls-10" d="M471,236.2s5.2,1.9,8.3,5.3c0,0-1,5.8-.6,8.7s-3.8,9.1-12.9,8.6-16.9-7.4-16.9-7.4,1.1-12.6,2.6-16.3S471,236.2,471,236.2Z"/>
                    <path class="cls-19" d="M476.6,239.1h0a5.61,5.61,0,0,1,2.3,5.2,29.08,29.08,0,0,0-.2,5.8"/>
                    <path class="cls-7" d="M484.6,212.4a8.52,8.52,0,0,0,2.9-4.2c.7-2.6,1.1-4.6,1.1-4.6a11.39,11.39,0,0,0,3.2,2c1.9.7,6.8-4.5,7.5-11.6s-2.6-14.5-10.7-17.6c-3.1-1.2-7.8-1.4-12.5-1.1a39.44,39.44,0,0,0-18.5,6.1,11.5,11.5,0,0,1-4.4,1.6c-5.8.8-9.4,3.1-12.8,11.2s-3.8,14.3.8,24,6,10.3,6.7,14.3-.2,8.5,3,7.8c8.8-2,17.8.5,19.9-.8s9.1-13.7,9.9-19.7S483.3,211.7,484.6,212.4Z"/>
                    <path class="cls-10" d="M485.9,213s-2.1-5.6-6.1-3.9c-5.4,2.3-2.1,11.8,3.1,13.4"/>
                    <path d="M480,214a2.23,2.23,0,0,1,0-1.4,1.53,1.53,0,0,1,.5-.7,1.39,1.39,0,0,1,1.5-.3,1,1,0,0,1,.5.4c.1.1.2.3.3.4s.1.3.2.4a3.18,3.18,0,0,1,.2,1.3c.1.8,0,1.6.1,2.1s.5.9,1.4,1.1a1.48,1.48,0,0,1-1.3.4,2.16,2.16,0,0,1-1.4-.9,6.9,6.9,0,0,1-.6-2.6c0-.4-.1-.8-.1-1v-.3h.1c-.1-.1-.3-.1-.6.1A2.54,2.54,0,0,0,480,214Z"/>
                    <path class="cls-15" d="M448,250.2s.9-6.4,1.5-7.5,15.6-2.2,24.2,0,7.8,9.5,7.8,9.5S466,250.4,448,250.2Z"/>
                    <path class="cls-12" d="M418.1,273.5c1.7-9.6,5.3-24.5,40-24.6,29.6-.1,43.3,4.3,50.5,9.8s8,20,5.7,42.7-2.7,36.2-1.4,50.3,7,20.2-.6,27.8a176.93,176.93,0,0,1-49.9,7.2c-28,0-41.9-7.8-42.5-10s-3.3-2.9-.8-8.6,4.2-25.8,2.6-37.9S413.9,297.6,418.1,273.5Z"/>
                    <g class="cls-20">
                        <rect class="cls-14" x="423.4" y="386.44" width="5.1" height="5.1" transform="translate(-150.01 420.87) rotate(-45.57)"/>
                        <rect class="cls-14" x="423.22" y="369.86" width="5.1" height="5.1" transform="translate(-138.22 415.77) rotate(-45.57)"/>
                        <rect class="cls-14" x="422.97" y="353.21" width="5.1" height="5.1" transform="translate(-126.41 410.59) rotate(-45.57)"/>
                        <rect class="cls-14" x="422.86" y="336.56" width="5.1" height="5.1" transform="translate(-114.55 405.52) rotate(-45.57)"/>
                        <rect class="cls-14" x="422.68" y="319.98" width="5.1" height="5.1" transform="translate(-102.77 400.42) rotate(-45.57)"/>
                        <rect class="cls-14" x="438.28" y="386.29" width="5.1" height="5.1" transform="translate(-145.44 431.45) rotate(-45.57)"/>
                        <rect class="cls-14" x="438.17" y="369.64" width="5.1" height="5.1" transform="translate(-133.59 426.38) rotate(-45.57)"/>
                        <rect class="cls-14" x="437.99" y="353.07" width="5.1" height="5.1" transform="translate(-121.8 421.28) rotate(-45.57)"/>
                        <rect class="cls-14" x="437.81" y="336.49" width="5.1" height="5.1" transform="translate(-110.01 416.18) rotate(-45.57)"/>
                        <rect class="cls-14" x="437.7" y="319.84" width="5.1" height="5.1" transform="translate(-98.16 411.1) rotate(-45.57)"/>
                        <rect class="cls-14" x="453.3" y="386.15" width="5.1" height="5.1" transform="translate(-140.83 442.14) rotate(-45.57)"/>
                        <rect class="cls-14" x="453.12" y="369.57" width="5.1" height="5.1" transform="translate(-129.05 437.04) rotate(-45.57)"/>
                        <rect class="cls-14" x="452.94" y="352.85" width="5.1" height="5.1" transform="translate(-117.16 431.89) rotate(-45.57)"/>
                        <rect class="cls-14" x="452.76" y="336.27" width="5.1" height="5.1" transform="translate(-105.38 426.79) rotate(-45.57)"/>
                        <rect class="cls-14" x="452.58" y="319.7" width="5.1" height="5.1" transform="translate(-93.59 421.69) rotate(-45.57)"/>
                        <rect class="cls-14" x="468.18" y="386.01" width="5.1" height="5.1" transform="translate(-136.27 452.72) rotate(-45.57)"/>
                        <rect class="cls-14" x="468.07" y="369.36" width="5.1" height="5.1" transform="translate(-124.41 447.65) rotate(-45.57)"/>
                        <rect class="cls-14" x="467.89" y="352.78" width="5.1" height="5.1" transform="translate(-112.63 442.55) rotate(-45.57)"/>
                        <rect class="cls-14" x="467.71" y="336.2" width="5.1" height="5.1" transform="translate(-100.84 437.44) rotate(-45.57)"/>
                        <rect class="cls-14" x="467.6" y="319.55" width="5.1" height="5.1" transform="translate(-88.98 432.37) rotate(-45.57)"/>
                        <rect class="cls-14" x="483.21" y="385.87" width="5.1" height="5.1" transform="translate(-131.66 463.41) rotate(-45.57)"/>
                        <rect class="cls-14" x="483.03" y="369.29" width="5.1" height="5.1" transform="translate(-119.87 458.3) rotate(-45.57)"/>
                        <rect class="cls-14" x="482.85" y="352.57" width="5.1" height="5.1" transform="translate(-107.99 453.16) rotate(-45.57)"/>
                        <rect class="cls-14" x="482.67" y="335.99" width="5.1" height="5.1" transform="translate(-96.2 448.06) rotate(-45.57)"/>
                        <rect class="cls-14" x="482.49" y="319.41" width="5.1" height="5.1" transform="translate(-84.42 442.96) rotate(-45.57)"/>
                        <rect class="cls-14" x="498.16" y="385.65" width="5.1" height="5.1" transform="translate(-127.02 474.02) rotate(-45.57)"/>
                        <rect class="cls-14" x="497.98" y="369.07" width="5.1" height="5.1" transform="translate(-115.24 468.92) rotate(-45.57)"/>
                        <rect class="cls-14" x="497.8" y="352.5" width="5.1" height="5.1" transform="translate(-103.45 463.82) rotate(-45.57)"/>
                        <rect class="cls-14" x="497.69" y="335.85" width="5.1" height="5.1" transform="translate(-91.6 458.74) rotate(-45.57)"/>
                        <rect class="cls-14" x="497.51" y="319.27" width="5.1" height="5.1" transform="translate(-79.81 453.64) rotate(-45.57)"/>
                        <rect class="cls-14" x="513.11" y="385.58" width="5.1" height="5.1" transform="translate(-122.49 484.68) rotate(-45.57)"/>
                        <rect class="cls-14" x="513" y="368.93" width="5.1" height="5.1" transform="translate(-110.63 479.6) rotate(-45.57)"/>
                        <rect class="cls-14" x="512.75" y="352.28" width="5.1" height="5.1" transform="translate(-98.82 474.43) rotate(-45.57)"/>
                        <rect class="cls-14" x="512.57" y="335.7" width="5.1" height="5.1" transform="translate(-87.03 469.33) rotate(-45.57)"/>
                        <rect class="cls-14" x="512.46" y="319.05" width="5.1" height="5.1" transform="translate(-75.17 464.25) rotate(-45.57)"/>
                        <rect class="cls-14" x="422.5" y="303.4" width="5.1" height="5.1" transform="translate(-90.98 395.32) rotate(-45.57)"/>
                        <rect class="cls-14" x="422.39" y="286.75" width="5.1" height="5.1" transform="translate(-79.12 390.24) rotate(-45.57)"/>
                        <rect class="cls-14" x="422.21" y="270.17" width="5.1" height="5.1" transform="translate(-67.34 385.14) rotate(-45.57)"/>
                        <rect class="cls-14" x="422.03" y="253.59" width="5.1" height="5.1" transform="translate(-55.55 380.04) rotate(-45.57)"/>
                        <rect class="cls-14" x="437.45" y="303.19" width="5.1" height="5.1" transform="translate(-86.34 405.93) rotate(-45.57)"/>
                        <rect class="cls-14" x="437.27" y="286.61" width="5.1" height="5.1" transform="translate(-74.56 400.83) rotate(-45.57)"/>
                        <rect class="cls-14" x="437.16" y="269.96" width="5.1" height="5.1" transform="translate(-62.7 395.75) rotate(-45.57)"/>
                        <rect class="cls-14" x="436.98" y="253.38" width="5.1" height="5.1" transform="translate(-50.92 390.65) rotate(-45.57)"/>
                        <rect class="cls-14" x="452.47" y="303.05" width="5.1" height="5.1" transform="translate(-81.74 416.61) rotate(-45.57)"/>
                        <rect class="cls-14" x="452.29" y="286.47" width="5.1" height="5.1" transform="translate(-69.95 411.51) rotate(-45.57)"/>
                        <rect class="cls-14" x="452.11" y="269.89" width="5.1" height="5.1" transform="translate(-58.16 406.41) rotate(-45.57)"/>
                        <rect class="cls-14" x="452" y="253.24" width="5.1" height="5.1" transform="translate(-46.31 401.34) rotate(-45.57)"/>
                        <rect class="cls-14" x="467.43" y="302.97" width="5.1" height="5.1" transform="translate(-77.2 427.27) rotate(-45.57)"/>
                        <rect class="cls-14" x="467.24" y="286.25" width="5.1" height="5.1" transform="translate(-65.31 422.13) rotate(-45.57)"/>
                        <rect class="cls-14" x="467.06" y="269.68" width="5.1" height="5.1" transform="translate(-53.53 417.02) rotate(-45.57)"/>
                        <rect class="cls-14" x="466.88" y="253.1" width="5.1" height="5.1" transform="translate(-41.74 411.92) rotate(-45.57)"/>
                        <rect class="cls-14" x="482.38" y="302.76" width="5.1" height="5.1" transform="translate(-72.56 437.88) rotate(-45.57)"/>
                        <rect class="cls-14" x="482.2" y="286.18" width="5.1" height="5.1" transform="translate(-60.78 432.78) rotate(-45.57)"/>
                        <rect class="cls-14" x="482.02" y="269.6" width="5.1" height="5.1" transform="translate(-48.99 427.68) rotate(-45.57)"/>
                        <rect class="cls-14" x="481.91" y="252.95" width="5.1" height="5.1" transform="translate(-37.13 422.61) rotate(-45.57)"/>
                        <rect class="cls-14" x="497.33" y="302.69" width="5.1" height="5.1" transform="translate(-68.03 448.54) rotate(-45.57)"/>
                        <rect class="cls-14" x="497.15" y="285.97" width="5.1" height="5.1" transform="translate(-56.14 443.39) rotate(-45.57)"/>
                        <rect class="cls-14" x="496.97" y="269.39" width="5.1" height="5.1" transform="translate(-44.35 438.29) rotate(-45.57)"/>
                        <rect class="cls-14" x="496.79" y="252.81" width="5.1" height="5.1" transform="translate(-32.57 433.19) rotate(-45.57)"/>
                        <rect class="cls-14" x="512.28" y="302.48" width="5.1" height="5.1" transform="translate(-63.39 459.15) rotate(-45.57)"/>
                        <rect class="cls-14" x="512.1" y="285.9" width="5.1" height="5.1" transform="translate(-51.6 454.05) rotate(-45.57)"/>
                        <rect class="cls-14" x="511.99" y="269.25" width="5.1" height="5.1" transform="translate(-39.75 448.98) rotate(-45.57)"/>
                        <rect class="cls-14" x="511.81" y="252.67" width="5.1" height="5.1" transform="translate(-27.96 443.88) rotate(-45.57)"/>
                    </g>
                    <path class="cls-10" d="M553.8,249s2.3-7.5,2-10.2-2.5-8.7-3.5-10.9-.2-8.4-.4-11.5,3.4-2.3,4.4.8a14,14,0,0,0,2.2,4.5s3.9-9,4.5-11.5,2.2-10.5,4.6-12.4,3.3.1,2,5.5a23.08,23.08,0,0,0-.8,6.1c0,.3,2.9.8,4.1,2.5a12.73,12.73,0,0,1,.9,3.3,5.4,5.4,0,0,1,2.4.6c.7.4,1.5,1.7,2.2,2.3a13,13,0,0,1,1.9,2.2c.9,1.3,1.6,3.9-1.1,14.9-1.5,6-4.2,8.1-6.2,22.1C570.7,271.3,551.8,257.9,553.8,249Z"/>
                    <path class="cls-8" d="M555.4,242.3c-.6,3.1-1.6,6.6-1.6,6.6-2,8.9,16.9,22.3,19,8.3.5-3.6,1.1-6.5,1.6-8.8C569.5,243.3,563,240.4,555.4,242.3Z"/>
                    <ellipse class="cls-9" cx="567.8" cy="246.62" rx="4.5" ry="4.9" transform="translate(-50.92 266.83) rotate(-25.35)"/>
                    <path class="cls-15" d="M505.6,256.8s7.9,0,19.1,15.1,13.5,19,13.5,19a211.8,211.8,0,0,1,7-20.2,168.08,168.08,0,0,0,6.4-20.1,5,5,0,0,1,3.7-3.7c4.1-.9,11.5-1,17.8,8.2a5.2,5.2,0,0,1,.8,3.6c-1,5.8-3.9,23.7-6.3,41.1-2.9,21.1-4.5,38.9-18.8,40.7-10.3,1.3-25.3-12.2-35.8-22.7-4.1-4.1-7.5-7.8-9.6-10-5.3-5.4-13.6-15.9-13.6-31C489.8,260.2,502.1,255.8,505.6,256.8Z"/>
                    <path class="cls-21" d="M513,317.9c-4.1-4.1-7.5-7.8-9.6-10-5.3-5.4-13.6-15.9-13.6-31"/>
                    <path class="cls-17" d="M538.2,290.8s12.9,16.8,16,24.9"/>
                    <path class="cls-17" d="M542.4,339.6c-.7-.5-1.5-1.5-1.4-3.6.2-3.8,4-9.9,11.2-11.4,6.1-1.3,9.2.6,9.8,2.6"/>
                    <path class="cls-17" d="M550.8,253.6s12.8-5.6,22.3,9.7"/>
                    <path class="cls-19" d="M568.6,209.3s-.2,3.4-.3,4-1,4.3-1.1,5.7"/>
                    <path class="cls-19" d="M573.6,215.1V218a25.83,25.83,0,0,1-.5,3.4"/>
                    <path class="cls-19" d="M577.9,218.2a16.58,16.58,0,0,1,.3,2.7,32.06,32.06,0,0,1-.5,3.9"/>
                    <path class="cls-19" d="M558.4,221.6a9.89,9.89,0,0,1-1.3,2.3"/>
                    <path class="cls-15" d="M507.8,111.9s-6.1,24.3,2.9,40.7a2.65,2.65,0,0,0,3.6,1.1l12.2-6.8-4.9-36.8Z"/>
                    <path class="cls-12" d="M510.5,112.4s-5.8,24.1,8.2,41.7a2.74,2.74,0,0,0,3.5.6l15.3-9.2-12.6-36.8C524.8,108.8,512.5,109.4,510.5,112.4Z"/>
                    <polygon class="cls-11" points="507.8 111.9 513.6 113.1 546.3 100.5 540.1 99.5 507.8 111.9"/>
                    <path class="cls-15" d="M546.3,100.5s.5,16,19.7,28.1a2.62,2.62,0,0,1,0,4.5l-30.6,18.1a2.68,2.68,0,0,1-2.6.1C513.3,141,513.6,113,513.6,113Z"/>
                    <path class="cls-12" d="M537.9,120.7a3.63,3.63,0,0,0-.9-.8,3,3,0,0,0-4.2,3.1,12.08,12.08,0,0,0,1.1,3.5,4.36,4.36,0,0,1,1.2-1.9,8.53,8.53,0,0,1,2.1-1.4,8.91,8.91,0,0,1,5.5-.7,7.2,7.2,0,0,1,4.4,2.8,6.56,6.56,0,0,1,1.2,5.1c-.3,1.9-1.7,3.6-4.4,5a8.52,8.52,0,0,1-8.2,0,12.38,12.38,0,0,1-4.9-5.4,17.42,17.42,0,0,1-1.6-3.6,8.91,8.91,0,0,1-.5-4.4,5.92,5.92,0,0,1,1.3-2.9,7.66,7.66,0,0,1,3-2.1,8.67,8.67,0,0,1,5.1-.7,5.86,5.86,0,0,1,3.8,2.3C540.3,119.5,539.5,119.9,537.9,120.7ZM539,133a4.74,4.74,0,0,0,3.1-.2,3,3,0,0,0,1.7-2,3.36,3.36,0,0,0-.7-2.6,4.07,4.07,0,0,0-2.4-1.8,4.15,4.15,0,0,0-2.7.2,3.17,3.17,0,0,0-1.6,1.4,3,3,0,0,0,.3,3.1A4.35,4.35,0,0,0,539,133Z"/>
                    <path class="cls-10" d="M407.2,172.8h33l3.4,2.2a1.63,1.63,0,0,0,2.5-1.4V150.3a4.27,4.27,0,0,0-4.3-4.3H407.2a4.27,4.27,0,0,0-4.3,4.3v18.2A4.27,4.27,0,0,0,407.2,172.8Z"/>
                    <polyline class="cls-16" points="412.7 155.3 414.4 157 417.7 153.7"/>
                    <line class="cls-16" x1="422.8" y1="155.8" x2="434.4" y2="155.8"/>
                    <polyline class="cls-16" points="412.7 163.4 414.4 165.1 417.7 161.8"/>
                    <line class="cls-16" x1="422.8" y1="163.9" x2="434.4" y2="163.9"/>
                    <path class="cls-7" d="M561.8,462.4l-3,3.2a1.27,1.27,0,0,0,0,1.8h0a1.24,1.24,0,0,0,1.7.2l3.5-2.1Z"/>
                    <path class="cls-7" d="M588.5,470.2l.8,4.3a1.33,1.33,0,0,1-1,1.5h0a1.23,1.23,0,0,1-1.5-.7l-1.8-3.7Z"/>
                    <circle class="cls-15" cx="578.7" cy="454" r="19.9"/>
                    <circle class="cls-12" cx="578.7" cy="454" r="12.8"/>
                    <polyline class="cls-13" points="582.3 458.6 578.7 454 580.6 447.6"/>
                    <path class="cls-15" d="M566,434.8a1,1,0,0,1-1.3-.7,5.8,5.8,0,0,1,3.6-6.3,5.68,5.68,0,0,1,6.9,2.3,1,1,0,0,1-.5,1.4Z"/>
                    <path class="cls-15" d="M599.7,444.6a.94.94,0,0,0,1.5.1,5.75,5.75,0,0,0-6.8-9,1,1,0,0,0-.3,1.5Z"/>
                    <path class="cls-15" d="M587.7,432.6l-5.2-1.5a1.58,1.58,0,0,1-1.1-2h0a1.58,1.58,0,0,1,2-1.1l5.2,1.5a1.58,1.58,0,0,1,1.1,2h0A1.51,1.51,0,0,1,587.7,432.6Z"/>
                    <rect class="cls-15" x="582.1" y="431.5" width="5.1" height="3.9" transform="translate(5.29 873.96) rotate(-73.8)"/>
                </svg>
                </div>
            </div>
        </div>
    </body>
</html>
</x-guest-layout>
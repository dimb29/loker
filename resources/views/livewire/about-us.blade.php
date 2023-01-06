<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">



        <title>Saya Rajin</title>



        <!-- Fonts -->

        <link rel="stylesheet" href="{{ asset('css/font-googleapis.css') }}">



        <!-- Styles -->

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="stylesheet" href="{{ asset('css/myapp.css') }}">

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- CSS only -->

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.0/slick.min.css" />	

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.0/slick-theme.min.css"/>

        @livewireStyles





        <!-- Scripts -->

        <script src="{{ asset('js/cdn-jsdelivr.js') }}" defer></script>

        <script src="{{ asset('js/ckeditor.js') }}"></script>

        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <script src="https://kit.fontawesome.com/c787e2e75a.js" crossorigin="anonymous"></script>

        <script src="{{ asset('js/script.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.0/slick.js"></script>

        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>



    <style>

        figure{

            width:101%;

        }

    </style>

    </head>


    <body class="font-sans antialiased">

    <!-- Side Bar-->


    <aside class="sidebar fixed w-full h-full z-40 inset-0">

                    <div class="h-full bg-cyan-50 py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">

                        <ul class="space-y-2 mt-12" style="list-style: none" >

                            <li>

                                <x-jet-responsive-nav-link :active="request()->routeIs('profile.show')" 

                                href="{{ route('profile.show') }}"

                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

                                    <i class="fa-solid fa-user-gear w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>

                                    {{ __('Profile') }}

                                </x-jet-responsive-nav-link>

                            </li>

                            <li>

                                <x-jet-responsive-nav-link :active="request()->routeIs('saveloker')" 

                                href="{{ route('saveloker') }}"

                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

                                    <i class="fa-solid fa-file-circle-plus w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>

                                    {{ __('Lowongan Tersimpan') }}

                                </x-jet-responsive-nav-link>

                            </li>

                            <li>

                                <x-jet-responsive-nav-link class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" href="{{ route('profile.show') }}">

                                    <i class="fa-solid fa-briefcase w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>

                                    {{ __('Pengalaman') }}

                                </x-jet-responsive-nav-link>

                            </li>

                            <li>

                                <x-jet-responsive-nav-link class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" href="{{ route('profile.show') }}">

                                    <i class="fa-solid fa-user-graduate w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>

                                    {{ __('Pendidikan') }}

                                </x-jet-responsive-nav-link>

                            </li>

                            <li>

                                <x-jet-responsive-nav-link class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" href="{{ route('profile.show') }}">

                                    <i class="fa-solid fa-compass-drafting w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>

                                    {{ __('Keterampilan') }}

                                </x-jet-responsive-nav-link>

                            </li>

                            <li>

                                <x-jet-responsive-nav-link class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"

                                    href="{{ route('logout') }}"

                                    onclick="event.preventDefault();

                                        this.closest('form').submit();">

                                    <i class="fa-solid fa-arrow-right-from-bracket w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>

                                    {{ __('Logout') }}

                                </x-jet-responsive-nav-link>

                            </li>

                        </ul>

                        <div class="fixed bottom-0 right-0 mr-4 mb-2">

                        <img class="object-cover h-72 w-full" src="http://sayarajin.com/storage/photos/chara20.svg">

                        </div>

                    </div>

                </aside>

                <!--/ Side Bar -->

                </body>

</html>


<script>

    $(document).ready(function(){

        $(".close-side").click(function(){

            $(".sidebar").animate({

            opacity: '0.5',

            width: '0px'

            });

            $(".sidebar").fadeOut();

        });

        $(".open-side").click(function(){

            $(".sidebar").fadeIn();

            $(".sidebar").animate({

            opacity: '100',

            width: '100%'

            });

        })

    (function(){

            var width = screen.width,

            height = screen.height;

            

            setInterval(function () {

                if (screen.width !== width || screen.height !== height) {

                    width = screen.width;

                    height = screen.height;

                    // $(window).trigger('resolutionchange');

                    $(".sidebar").hide();

                }

            }, 50);

        }());

    });

</script>
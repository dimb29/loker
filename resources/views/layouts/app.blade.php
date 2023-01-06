<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">



        <title>Kedai Kerja</title>



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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/themes/airbnb.min.css">

        @livewireStyles
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>





        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>

        <script src="{{ asset('js/cdn-jsdelivr.js') }}" defer></script>

        <!-- <script src="{{ asset('js/ckeditor.js') }}"></script> -->
        
        <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
        
        <!-- <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script> -->

        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        
        <script src="https://kit.fontawesome.com/c787e2e75a.js" crossorigin="anonymous"></script>

        <script src="{{ asset('js/script.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.0/slick.js"></script>

        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/62d7c0ed7b967b11799a71da/1g8dcj8or';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->



    <style>

        figure{

            width:101%;

        }


  /* common styles !!! YOU DON'T NEED THEM */

.effect:nth-child(2n+1) h2 {
  color: #fff;
}
.effect:nth-child(2n) a {
  color: #fff;
}
.effect .buttons {
  display: flex;
  justify-content: center;
}
/* styles for a common effect !!!YOU NEED THEM */
.effect {
  /*display: flex; !!!uncomment this line !!!*/
}
.effect a {
  text-decoration: none !important;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  margin-right: 10px;
  font-size: 25px;
  overflow: hidden;
  position: relative;
  color: #fff;
  border: 2px solid #fff;
}
.effect a i {
  position: relative;
  z-index: 3;
}
.effect a:last-child {
  margin-right: 0px;
}
.effect a:before {
  content: "";
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}
.effect a i {
  display: inline-block;
  vertical-align: middle;
}
/* varrius effect */
.effect.varrius a {
  transition: all 0.2s linear 0s;
}
.effect.varrius a:after {
  content: "";
  display: block;
  width: 90%;
  height: 90%;
  top: -110%;
  left: 0;
  right: 0;
  margin: auto;
  position: absolute;
  background-color: #212121;
  border-radius: 50%;
}
.effect.varrius a:hover {
  color: #fff;
}
.effect.varrius a:hover:after {
  top: 5%;
  transition: all 0.2s linear 0s;
}

    </style>

    </head>

    <body class="font-sans antialiased">

        <div class="min-h-screen bg-gray-100">

        @if(isset($header))
            @livewire('navigation-dropdown')
        @endif



            <!-- Side Bar-->

            <aside class="sidebar fixed w-full h-full zind1500 inset-0 sm:hidden" hidden aria-label="Sidebar">

                <div class="bodyy2">

                    <div class="bodyy1 main">
                        <div class="bar"> 
                            <img class="close-side  bar__icon" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAw%0D%0AL3N2ZyI+CgogPGc+CiAgPHRpdGxlPmJhY2tncm91bmQ8L3RpdGxlPgogIDxyZWN0IGZpbGw9Im5v%0D%0AbmUiIGlkPSJjYW52YXNfYmFja2dyb3VuZCIgaGVpZ2h0PSI0MDIiIHdpZHRoPSI1ODIiIHk9Ii0x%0D%0AIiB4PSItMSIvPgogPC9nPgogPGc+CiAgPHRpdGxlPkxheWVyIDE8L3RpdGxlPgogIDxwYXRoIGlk%0D%0APSJzdmdfMSIgZmlsbD0ibm9uZSIgZD0ibTAsMGw0OCwwbDAsNDhsLTQ4LDBsMCwtNDh6Ii8+CiAg%0D%0APHBhdGggZmlsbD0iI2ZmZmZmZiIgaWQ9InN2Z18yIiBkPSJtMzgsMTRsMCw4bC0yNi4zNCwwbDcu%0D%0AMTcsLTcuMTdsLTIuODMsLTIuODNsLTEyLDEybDEyLDEybDIuODMsLTIuODNsLTcuMTcsLTcuMTds%0D%0AMzAuMzQsMGwwLC0xMmwtNCwweiIvPgogPC9nPgo8L3N2Zz4=" />
                        </div>
                        <div class="flex justify-center">
                            @if(Auth::user() != null || Auth::guard('employer')->user() != null)
                                @if(Auth::guard('employer')->user() != null)
                                    <div class="flex flex-row my-2">
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                            @if(Auth::guard('employer')->user()->profile_photo_path != null)    
                                            <img class="h-32 w-32 rounded-full object-cover shadow-lg" src="{{url(Auth::guard('employer')->user()->profile_photo_path)}}" alt="{{Auth::guard('employer')->user()->name}}" />
                                            @else
                                            <img class="h-32 w-32 rounded-full object-cover shadow-lg" src="{{url('storage/photos/default-logo.jpg')}}" alt="{{Auth::guard('employer')->user()->name}}" />
                                            @endif
                                        </button>
                                    </div>
                                @else
                                    <div class="flex flex-row my-2">
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                            @if(Auth::user()->profile_photo_path != null)
                                            <img class="h-32 w-32 rounded-full object-cover shadow-lg" src="{{ url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}" />
                                            @else
                                            <img class="h-32 w-32 rounded-full object-cover shadow-lg" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}" />
                                            @endif
                                        </button>
                                    </div>
                                @endif
                            @else
                                <div class="">
                                    @auth
                                        @if(Auth::guard('employer')->user() != null)
                                            <a href="{{ url('employer/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                                        @else
                                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                                        @endif
                                    @else
                                    <div class="buttonss">
                                                <a href="{{ url('choice') }}">
                                                    <button class="btn-hoverr color-9">LOGIN</button>
                                                </a>
                                            </div>
                                        @if (Route::has('register'))
                                            <div class="buttonss">
                                                <a href="{{ url('registerchoice') }}">
                                                    <button class="btn-hoverr color-9">REGISTER</button>
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            
                            @endif
                        </div>
                        <div class="menu mt-12">
                            @if(Auth::guard('employer')->user() != null)
                            <a :active="request()->routeIs('employer.profil')" href="{{ route('employer.profil') }}" class="menu__item" id="0-0"> <img class="menu__icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1NzYgNTEyIj48IS0tISBGb250IEF3ZXNvbWUgUHJvIDYuMS4yIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlIChDb21tZXJjaWFsIExpY2Vuc2UpIENvcHlyaWdodCAyMDIyIEZvbnRpY29ucywgSW5jLiAtLT48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNNTEyIDMySDY0QzI4LjY1IDMyIDAgNjAuNjUgMCA5NnYzMjBjMCAzNS4zNSAyOC42NSA2NCA2NCA2NGg0NDhjMzUuMzUgMCA2NC0yOC42NSA2NC02NFY5NkM1NzYgNjAuNjUgNTQ3LjMgMzIgNTEyIDMyek0xNzYgMTI4YzM1LjM1IDAgNjQgMjguNjUgNjQgNjRzLTI4LjY1IDY0LTY0IDY0cy02NC0yOC42NS02NC02NFMxNDAuNyAxMjggMTc2IDEyOHpNMjcyIDM4NGgtMTkyQzcxLjE2IDM4NCA2NCAzNzYuOCA2NCAzNjhDNjQgMzIzLjggOTkuODIgMjg4IDE0NCAyODhoNjRjNDQuMTggMCA4MCAzNS44MiA4MCA4MEMyODggMzc2LjggMjgwLjggMzg0IDI3MiAzODR6TTQ5NiAzMjBoLTEyOEMzNTkuMiAzMjAgMzUyIDMxMi44IDM1MiAzMDRTMzU5LjIgMjg4IDM2OCAyODhoMTI4QzUwNC44IDI4OCA1MTIgMjk1LjIgNTEyIDMwNFM1MDQuOCAzMjAgNDk2IDMyMHpNNDk2IDI1NmgtMTI4QzM1OS4yIDI1NiAzNTIgMjQ4LjggMzUyIDI0MFMzNTkuMiAyMjQgMzY4IDIyNGgxMjhDNTA0LjggMjI0IDUxMiAyMzEuMiA1MTIgMjQwUzUwNC44IDI1NiA0OTYgMjU2ek00OTYgMTkyaC0xMjhDMzU5LjIgMTkyIDM1MiAxODQuOCAzNTIgMTc2UzM1OS4yIDE2MCAzNjggMTYwaDEyOEM1MDQuOCAxNjAgNTEyIDE2Ny4yIDUxMiAxNzZTNTA0LjggMTkyIDQ5NiAxOTJ6Ii8+PC9zdmc+" />
                                <div class="menu__content"><span class="menu__span">PROFILE</span><span class="menu__span">PROFILE</span></div>
                            </a>
                            @else
                            <a :active="request()->routeIs('profile.show')" href="{{ route('profile.show') }}" class="menu__item" id="0-0"> <img class="menu__icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1NzYgNTEyIj48IS0tISBGb250IEF3ZXNvbWUgUHJvIDYuMS4yIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlIChDb21tZXJjaWFsIExpY2Vuc2UpIENvcHlyaWdodCAyMDIyIEZvbnRpY29ucywgSW5jLiAtLT48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNNTEyIDMySDY0QzI4LjY1IDMyIDAgNjAuNjUgMCA5NnYzMjBjMCAzNS4zNSAyOC42NSA2NCA2NCA2NGg0NDhjMzUuMzUgMCA2NC0yOC42NSA2NC02NFY5NkM1NzYgNjAuNjUgNTQ3LjMgMzIgNTEyIDMyek0xNzYgMTI4YzM1LjM1IDAgNjQgMjguNjUgNjQgNjRzLTI4LjY1IDY0LTY0IDY0cy02NC0yOC42NS02NC02NFMxNDAuNyAxMjggMTc2IDEyOHpNMjcyIDM4NGgtMTkyQzcxLjE2IDM4NCA2NCAzNzYuOCA2NCAzNjhDNjQgMzIzLjggOTkuODIgMjg4IDE0NCAyODhoNjRjNDQuMTggMCA4MCAzNS44MiA4MCA4MEMyODggMzc2LjggMjgwLjggMzg0IDI3MiAzODR6TTQ5NiAzMjBoLTEyOEMzNTkuMiAzMjAgMzUyIDMxMi44IDM1MiAzMDRTMzU5LjIgMjg4IDM2OCAyODhoMTI4QzUwNC44IDI4OCA1MTIgMjk1LjIgNTEyIDMwNFM1MDQuOCAzMjAgNDk2IDMyMHpNNDk2IDI1NmgtMTI4QzM1OS4yIDI1NiAzNTIgMjQ4LjggMzUyIDI0MFMzNTkuMiAyMjQgMzY4IDIyNGgxMjhDNTA0LjggMjI0IDUxMiAyMzEuMiA1MTIgMjQwUzUwNC44IDI1NiA0OTYgMjU2ek00OTYgMTkyaC0xMjhDMzU5LjIgMTkyIDM1MiAxODQuOCAzNTIgMTc2UzM1OS4yIDE2MCAzNjggMTYwaDEyOEM1MDQuOCAxNjAgNTEyIDE2Ny4yIDUxMiAxNzZTNTA0LjggMTkyIDQ5NiAxOTJ6Ii8+PC9zdmc+" />
                                <div class="menu__content"><span class="menu__span">PROFILE</span><span class="menu__span">PROFILE</span></div>
                            </a>
                            <a :active="request()->routeIs('saveloker')" href="{{ route('saveloker') }}" class="menu__item" id="1-0"><img class="menu__icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGNsYXNzPSJpb25pY29uIiB2aWV3Qm94PSIwIDAgNTEyIDUxMiI+PHRpdGxlPkJvb2ttYXJrczwvdGl0bGU+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZD0iTTQwMCAwSDE3NmE2NC4xMSA2NC4xMSAwIDAwLTYyIDQ4aDIyOGE3NCA3NCAwIDAxNzQgNzR2MzA0Ljg5bDIyIDE3LjZhMTYgMTYgMCAwMDE5LjM0LjUgMTYuNDEgMTYuNDEgMCAwMDYuNjYtMTMuNDJWNjRhNjQgNjQgMCAwMC02NC02NHoiLz48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNMzIwIDgwSDExMmE2NCA2NCAwIDAwLTY0IDY0djM1MS42MkExNi4zNiAxNi4zNiAwIDAwNTQuNiA1MDlhMTYgMTYgMCAwMDE5LjcxLS43MUwyMTYgMzg4LjkybDE0MS42OSAxMTkuMzJhMTYgMTYgMCAwMDE5LjYuNzkgMTYuNCAxNi40IDAgMDA2LjcxLTEzLjQ0VjE0NGE2NCA2NCAwIDAwLTY0LTY0eiIvPjwvc3ZnPg==" />
                                <div class="menu__content"><span class="menu__span">BOOKMARKS</span><span class="menu__span">BOOKMARKS</span></div>
                            </a>
                            <a :active="request()->routeIs('pengalaman')" href="{{ route('pengalaman') }}" class="menu__item" id="0-1"><img class="menu__icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NDAgNTEyIj48IS0tISBGb250IEF3ZXNvbWUgUHJvIDYuMS4yIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlIChDb21tZXJjaWFsIExpY2Vuc2UpIENvcHlyaWdodCAyMDIyIEZvbnRpY29ucywgSW5jLiAtLT48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNNDk2IDIyNEM0MTYuNCAyMjQgMzUyIDI4OC40IDM1MiAzNjhzNjQuMzggMTQ0IDE0NCAxNDRzMTQ0LTY0LjM4IDE0NC0xNDRTNTc1LjYgMjI0IDQ5NiAyMjR6TTU0NCAzODRoLTU0LjI1QzQ4NC40IDM4NCA0ODAgMzc5LjYgNDgwIDM3NC4zVjMwNEM0ODAgMjk1LjIgNDg3LjIgMjg4IDQ5NiAyODhDNTA0LjggMjg4IDUxMiAyOTUuMiA1MTIgMzA0VjM1MmgzMmM4LjgzOCAwIDE2IDcuMTYyIDE2IDE2QzU2MCAzNzYuOCA1NTIuOCAzODQgNTQ0IDM4NHpNMzIwLjEgMzUySDIwOEMxOTkuMiAzNTIgMTkyIDM0NC44IDE5MiAzMzZWMjg4SDB2MTQ0QzAgNDU3LjYgMjIuNDEgNDgwIDQ4IDQ4MGgzMTIuMkMzMzUuMSA0NDkuNiAzMjAgNDEwLjUgMzIwIDM2OEMzMjAgMzYyLjYgMzIwLjUgMzU3LjMgMzIwLjEgMzUyek00OTYgMTkyYzUuNDAyIDAgMTAuNzIgLjMzMDEgMTYgLjgwNjZWMTQ0QzUxMiAxMTguNCA0ODkuNiA5NiA0NjQgOTZIMzg0VjQ4QzM4NCAyMi40MSAzNjEuNiAwIDMzNiAwaC0xNjBDMTUwLjQgMCAxMjggMjIuNDEgMTI4IDQ4Vjk2SDQ4QzIyLjQxIDk2IDAgMTE4LjQgMCAxNDRWMjU2aDM2MC4yQzM5Mi41IDIxNi45IDQ0MS4zIDE5MiA0OTYgMTkyek0zMzYgOTZoLTE2MFY0OGgxNjBWOTZ6Ii8+PC9zdmc+" />
                                <div class="menu__content"><span class="menu__span">PENGALAMAN</span><span class="menu__span">PENGALAMAN</span></div>
                            </a>
                            <a :active="request()->routeIs('pendidikan')" href="{{ route('pendidikan') }}" class="menu__item" id="1-1"><img class="menu__icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MTIgNTEyIj48IS0tISBGb250IEF3ZXNvbWUgUHJvIDYuMS4yIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlIChDb21tZXJjaWFsIExpY2Vuc2UpIENvcHlyaWdodCAyMDIyIEZvbnRpY29ucywgSW5jLiAtLT48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNNDUuNjMgNzkuNzVMNTIgODEuMjV2NTguNUM0NSAxNDMuOSA0MCAxNTEuMyA0MCAxNjBjMCA4LjM3NSA0LjYyNSAxNS4zOCAxMS4xMiAxOS43NUwzNS41IDI0MkMzMy43NSAyNDguOSAzNy42MyAyNTYgNDMuMTMgMjU2aDQxLjc1YzUuNSAwIDkuMzc1LTcuMTI1IDcuNjI1LTEzLjFMNzYuODggMTc5LjhDODMuMzggMTc1LjQgODggMTY4LjQgODggMTYwYzAtOC43NS01LTE2LjEyLTEyLTIwLjI1Vjg3LjEzTDEyOCA5OS42M2wuMDAxIDYwLjM3YzAgNzAuNzUgNTcuMjUgMTI4IDEyOCAxMjhzMTI3LjEtNTcuMjUgMTI3LjEtMTI4TDM4NCA5OS42Mmw4Mi4yNS0xOS44N2MxOC4yNS00LjM3NSAxOC4yNS0yNyAwLTMxLjVsLTE5MC40LTQ2Yy0xMy0zLTI2LjYyLTMtMzkuNjMgMGwtMTkwLjYgNDZDMjcuNSA1Mi42MyAyNy41IDc1LjM4IDQ1LjYzIDc5Ljc1ek0zNTkuMiAzMTIuOGwtMTAzLjIgMTAzLjJsLTEwMy4yLTEwMy4yYy02OS45MyAyMi4zLTEyMC44IDg3LjItMTIwLjggMTY0LjVDMzIgNDk2LjUgNDcuNTMgNTEyIDY2LjY3IDUxMmgzNzguN0M0NjQuNSA1MTIgNDgwIDQ5Ni41IDQ4MCA0NzcuM0M0ODAgNDAwIDQyOS4xIDMzNS4xIDM1OS4yIDMxMi44eiIvPjwvc3ZnPg==" />
                                <div class="menu__content"><span class="menu__span">PENDIDIKAN</span><span class="menu__span">PENDIDIKAN</span></div>
                            </a>
                            <a :active="request()->routeIs('keterampilan')" href="{{ route('keterampilan') }}" class="menu__item" id="0-2"><img class="menu__icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MTIgNTEyIj48IS0tISBGb250IEF3ZXNvbWUgUHJvIDYuMS4yIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlIChDb21tZXJjaWFsIExpY2Vuc2UpIENvcHlyaWdodCAyMDIyIEZvbnRpY29ucywgSW5jLiAtLT48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNMzUyIDk2QzM1MiAxMTAuMyAzNDguOSAxMjMuOSAzNDMuMiAxMzYuMkwzOTYgMjI3LjRDMzcyLjMgMjUyLjcgMzQxLjkgMjcxLjUgMzA3LjYgMjgxTDI1NiAxOTJIMjU1LjFMMTg3LjkgMzA5LjVDMjA5LjQgMzE2LjMgMjMyLjMgMzIwIDI1NiAzMjBDMzI2LjcgMzIwIDM4OS44IDI4Ny4zIDQzMC45IDIzNS4xQzQ0MS45IDIyMi4yIDQ2Mi4xIDIxOS4xIDQ3NS45IDIzMUM0ODkuNyAyNDIuMSA0OTEuOSAyNjIuMiA0ODAuOCAyNzZDNDI4LjEgMzQxLjggMzQ2LjEgMzg0IDI1NiAzODRDMjIwLjYgMzg0IDE4Ni42IDM3Ny42IDE1NS4zIDM2NS45TDk4LjY1IDQ2My43QzkzLjk1IDQ3MS44IDg2Ljk3IDQ3OC40IDc4LjU4IDQ4Mi42TDIzLjE2IDUxMC4zQzE4LjIgNTEyLjggMTIuMzEgNTEyLjUgNy41ODggNTA5LjZDMi44NzEgNTA2LjcgMCA1MDEuNSAwIDQ5NlY0NDAuNkMwIDQzMi4yIDIuMjI4IDQyMy45IDYuNDYgNDE2LjVMNjYuNDkgMzEyLjlDNTMuNjYgMzAxLjYgNDEuODQgMjg5LjMgMzEuMTggMjc2QzIwLjEzIDI2Mi4yIDIyLjM0IDI0Mi4xIDM2LjEzIDIzMUM0OS45MiAyMTkuMSA3MC4wNiAyMjIuMiA4MS4xMiAyMzUuMUM4Ni43OSAyNDMuMSA5Mi44NyAyNDkuOCA5OS4zNCAyNTYuMUwxNjguOCAxMzYuMkMxNjMuMSAxMjMuOSAxNjAgMTEwLjMgMTYwIDk2QzE2MCA0Mi45OCAyMDIuMSAwIDI1NiAwQzMwOSAwIDM1MiA0Mi45OCAzNTIgOTZMMzUyIDk2ek0yNTYgMTI4QzI3My43IDEyOCAyODggMTEzLjcgMjg4IDk2QzI4OCA3OC4zMyAyNzMuNyA2NCAyNTYgNjRDMjM4LjMgNjQgMjI0IDc4LjMzIDIyNCA5NkMyMjQgMTEzLjcgMjM4LjMgMTI4IDI1NiAxMjh6TTM3Mi4xIDM5My45QzQwNS41IDM4MS4xIDQzNS41IDM2My4yIDQ2MS44IDM0MUw1MDUuNSA0MTYuNUM1MDkuOCA0MjMuOSA1MTIgNDMyLjIgNTEyIDQ0MC42VjQ5NkM1MTIgNTAxLjUgNTA5LjEgNTA2LjcgNTA0LjQgNTA5LjZDNDk5LjcgNTEyLjUgNDkzLjggNTEyLjggNDg4LjggNTEwLjNMNDMzLjQgNDgyLjZDNDI1IDQ3OC40IDQxOC4xIDQ3MS44IDQxMy4zIDQ2My43TDM3Mi4xIDM5My45eiIvPjwvc3ZnPg==" />
                                <div class="menu__content"><span class="menu__span">KETERAMPILAN</span><span class="menu__span">KETERAMPILAN</span></div>
                            </a>
                            @endif
                            @if(Auth::guard('employer')->user() != null)
                            <form method="POST" action="{{ route('employer.logout') }}">
                            @csrf
                                <a href="{{ route('employer.logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="menu__item" id="1-2"><img class="menu__icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MTIgNTEyIj48IS0tISBGb250IEF3ZXNvbWUgUHJvIDYuMS4yIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlIChDb21tZXJjaWFsIExpY2Vuc2UpIENvcHlyaWdodCAyMDIyIEZvbnRpY29ucywgSW5jLiAtLT48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNOTYgNDgwaDY0QzE3Ny43IDQ4MCAxOTIgNDY1LjcgMTkyIDQ0OFMxNzcuNyA0MTYgMTYwIDQxNkg5NmMtMTcuNjcgMC0zMi0xNC4zMy0zMi0zMlYxMjhjMC0xNy42NyAxNC4zMy0zMiAzMi0zMmg2NEMxNzcuNyA5NiAxOTIgODEuNjcgMTkyIDY0UzE3Ny43IDMyIDE2MCAzMkg5NkM0Mi45OCAzMiAwIDc0Ljk4IDAgMTI4djI1NkMwIDQzNyA0Mi45OCA0ODAgOTYgNDgwek01MDQuOCAyMzguNWwtMTQ0LjEtMTM2Yy02Ljk3NS02LjU3OC0xNy4yLTguMzc1LTI2LTQuNTk0Yy04LjgwMyAzLjc5Ny0xNC41MSAxMi40Ny0xNC41MSAyMi4wNWwtLjA5MTggNzJsLTEyOC0uMDAxYy0xNy42OSAwLTMyLjAyIDE0LjMzLTMyLjAyIDMydjY0YzAgMTcuNjcgMTQuMzQgMzIgMzIuMDIgMzJsMTI4IC4wMDFsLjA5MTggNzEuMWMwIDkuNTc4IDUuNzA3IDE4LjI1IDE0LjUxIDIyLjA1YzguODAzIDMuNzgxIDE5LjAzIDEuOTg0IDI2LTQuNTk0bDE0NC4xLTEzNkM1MTQuNCAyNjQuNCA1MTQuNCAyNDcuNiA1MDQuOCAyMzguNXoiLz48L3N2Zz4=" />
                                    <div class="menu__content"><span class="menu__span">LOG OUT</span><span class="menu__span">LOG OUT</span></div>
                                </a>
                            </form>
                            @else
                                @auth
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();" class="menu__item" id="1-2"><img class="menu__icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MTIgNTEyIj48IS0tISBGb250IEF3ZXNvbWUgUHJvIDYuMS4yIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlIChDb21tZXJjaWFsIExpY2Vuc2UpIENvcHlyaWdodCAyMDIyIEZvbnRpY29ucywgSW5jLiAtLT48cGF0aCBmaWxsPSIjZmZmZmZmIiBkPSJNOTYgNDgwaDY0QzE3Ny43IDQ4MCAxOTIgNDY1LjcgMTkyIDQ0OFMxNzcuNyA0MTYgMTYwIDQxNkg5NmMtMTcuNjcgMC0zMi0xNC4zMy0zMi0zMlYxMjhjMC0xNy42NyAxNC4zMy0zMiAzMi0zMmg2NEMxNzcuNyA5NiAxOTIgODEuNjcgMTkyIDY0UzE3Ny43IDMyIDE2MCAzMkg5NkM0Mi45OCAzMiAwIDc0Ljk4IDAgMTI4djI1NkMwIDQzNyA0Mi45OCA0ODAgOTYgNDgwek01MDQuOCAyMzguNWwtMTQ0LjEtMTM2Yy02Ljk3NS02LjU3OC0xNy4yLTguMzc1LTI2LTQuNTk0Yy04LjgwMyAzLjc5Ny0xNC41MSAxMi40Ny0xNC41MSAyMi4wNWwtLjA5MTggNzJsLTEyOC0uMDAxYy0xNy42OSAwLTMyLjAyIDE0LjMzLTMyLjAyIDMydjY0YzAgMTcuNjcgMTQuMzQgMzIgMzIuMDIgMzJsMTI4IC4wMDFsLjA5MTggNzEuMWMwIDkuNTc4IDUuNzA3IDE4LjI1IDE0LjUxIDIyLjA1YzguODAzIDMuNzgxIDE5LjAzIDEuOTg0IDI2LTQuNTk0bDE0NC4xLTEzNkM1MTQuNCAyNjQuNCA1MTQuNCAyNDcuNiA1MDQuOCAyMzguNXoiLz48L3N2Zz4=" />
                                        <div class="menu__content"><span class="menu__span">LOG OUT</span><span class="menu__span">LOG OUT</span></div>
                                    </a>
                                </form>
                                @endif
                            @endif
                            <div class="is-active" id="current"></div>
                        </div>
                    </div>

                </div>

            </aside>

                <!--/ Side Bar -->


            @if(isset($header))
            <!-- Page Heading -->

            <header class="bg-white shadow">

                <div id="header-wrap">

                    {{ $header }}

                </div>

            </header>
            @endif



            <!-- Page Content -->

            <main>

                {{ $slot }}

            </main>

            @if(isset($footer))
            <!-- Page footer -->
            <footer class="text-center bg-blue-800 text-white">
                <div class="justify-center">
                    <h5 class="text-white text-xl font-medium h-16 pt-6">Temukan Kami</h5>
                    <div>
                        <div class="mb-4 mt-4">
                            <div class="effect varrius">
                                <div class="buttons">
                                <a href="https://www.facebook.com/Lokerindo-Kedkercom-102650155938734" class="fb" title="Join us on Facebook"><i class="text-sm fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://twitter.com/lokerindokedker" class="tw" title="Join us on Twitter"><i class="text-sm fa fa-twitter" aria-hidden="true"></i></a>
                                <a class="g-plus" title="Join us on Google+"><i class="text-lg fa-brands fa-whatsapp"></i></a>
                                <a href="https://www.instagram.com/lokerindokedker/" class="insta" title="Join us on Instagram"><i class="text-sm fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="https://www.linkedin.com/in/saya-rajin-22a129247/" class="in" title="Join us on Linked In"><i class="text-sm fa fa-linkedin" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center p-4 bg-blue-900">
                        © 2022 Copyright:
                        <a class="text-whitehite" href="">PT Technoverse Indonesia</a>
                    </div>
            </footer>
            @endif
        </div>
        @stack('modals')
        @livewireScripts

        @if($agent->isDesktop())
        @if(Auth::user() || Auth::guard('employer')->user())
            @if(Auth::user())
                @if(request()->routeIs('chat') || request()->routeIs('chat.open') || request()->routeIs('complete.data'))
                @else
                <div class="fixed w-full sm:w-96 h-auto bottom-0 left-0">
                    @livewire('chat.chat-pop')
                </div>
                @endif
            @else
            @endif
        @endif
        @endif

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

/* Const */
const menuItem = document.querySelectorAll(".menu__item");
const currentItem = document.querySelector("#current");
const mov = 165;
/* Func */
let getItem = (event) => {
    let x = event.currentTarget.id.slice("-")[0];
    let y = event.currentTarget.id.slice("-")[2];

    currentItem.style.left = `${ x * mov }px`;
    setTimeout( () =>  currentItem.style.top = `${ y * mov }px`, 200 ) ;

}
/* Main */
let mainFunction = (event) => {
    for (var i = 0; i < menuItem.length; i++) {
        menuItem[i].addEventListener("click", getItem);
    }
}

window.addEventListener("load", mainFunction);

</script>
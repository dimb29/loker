<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="hfont flex">
                @if(Auth::guard('employer')->user() != null)
                <!-- Logo -->
                <div class="space-x-8 my-auto flex-shrink-0 items-center">
                    <a href="{{ route('employer.dashboard') }}">
                        <img class="h-14 w-14" src="{{url('storage/photos/logokk.png')}}" alt="">
                    </a>
                </div>

                <!-- Navigation Links -->
                <!-- <div class="hidden text-2xl space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('employer.dashboard') }}" :active="request()->routeIs('employer.dashboard')" class="text-base tracking-wide">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                </div> -->

                <div class="hidden space-x-8 sm:ml-10 lg:flex">
                    <x-jet-nav-link href="{{ url('employer/lowongan/sj_send=') }}" :active="request()->routeIs('employer.lowongan/{id}')" class="text-base tracking-wide">
                        {{ __('Lowongan') }}
                    </x-jet-nav-link>
                </div>

                <div class="hidden space-x-8 sm:ml-10 lg:flex">
                    <x-jet-nav-link href="{{ route('employer.posts') }}" :active="request()->routeIs('employer.posts')" class="text-base tracking-wide">
                        {{ __('Tambah Loker') }}
                    </x-jet-nav-link>
                </div>
                @else
                <!-- Logo -->
                <div class="space-x-8 my-auto flex-shrink-0 items-center">
                    <a href="{{ route('dashboard') }}">
                        <img class="h-14 w-14" src="{{url('storage/photos/logokk.png')}}" alt="">
                    </a>
                </div>

                <!-- Navigation Links -->
                <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-base tracking-wide">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                </div> -->

                <div class="hidden space-x-8 sm:ml-10 lg:flex">
                    <x-jet-nav-link href="{{ route('lowongan/{id}', 'sj_send=') }}" :active="request()->routeIs('lowongan/{id}')" class="text-base tracking-wide">
                        {{ __('Lowongan') }}
                    </x-jet-nav-link>
                </div>

                <div class="hidden space-x-8 sm:ml-10 lg:flex">
                    <x-jet-nav-link href="{{ route('class.data', 'sc_send=') }}" :active="request()->routeIs('class.data')" class="text-base tracking-wide">
                        {{ __('Kelas Belajar') }}
                    </x-jet-nav-link>
                </div>

                @endif
                @if(Auth::user() != null)
                @if(Auth::user()->user_type == 'administr')
                <div class="hidden space-x-8 sm:ml-10 lg:flex">
                    <x-jet-nav-link href="{{ route('posts') }}" :active="request()->routeIs('posts')" class="text-base tracking-wide">
                        {{ __('Tambah Loker') }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:ml-10 lg:flex">
                    <x-jet-nav-link href="{{ route('tags') }}" :active="request()->routeIs('tags')" class="text-base tracking-wide">
                        {{ __('Filter') }}
                    </x-jet-nav-link>
                </div>
                @endif
                @endif
            </div>
                    <livewire:search.nav-search/>

            <!-- Settings Dropdown -->
            <div class="hidden lg:flex sm:items-center mr-6 lg:mr-0">
            @if(Auth::user() != null || Auth::guard('employer')->user() != null)
                <div wire:poll.750ms class="flex flex-row">
                    @if(Auth::guard('employer')->user() != null)
                        @php
                            $myempid = Auth::guard('employer')->user()->id;
                            $this->myempid = $myempid;
                            $myemp = Auth::guard('employer')->user()->with('notif_to_employer')->whereHas('notif_to_employer', function($que){
                                $que->where('to', $this->myempid);
                            })->first();
                            $myempchat = Auth::guard('employer')->user()->with('chat_to_employer')->whereHas('chat_to_employer', function($que){
                                $que->where('to', $this->myempid);
                            })->first();
                            if($myemp != null){
                                $notifemployers = $myemp->notif_to_employer()->sum('read');
                            }else{
                                $notifemployers = null;
                            }
                            if($myempchat != null){
                                $chatemployers = $myempchat->chat_to_employer()->sum('read');
                            }else{
                                $chatemployers = null;
                            }
                        @endphp
                        <div class="mr-3 flex flex-row">
                            <a href="{{ url('employer/chat/all') }}">
                                <i class="fa-solid fa-envelope text-xl mt-1 my-auto"></i>
                            </a>
                            @if($chatemployers != 0)
                            <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2">
                            @endif
                        </div>
                        <div class="mr-4 flex flex-row">
                            <a href="{{ route('employer.notif') }}">
                                <img src="{{url('storage/photos/bellicon.gif')}}" alt="notifications" class="w-6 h-6 my-auto">
                            </a>
                            @if($notifemployers != 0)
                            <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2 -ml-2">
                            @endif
                        </div>
                    @else
                        @php
                            $mysid = Auth::user()->id;
                            $this->mysid = $mysid;
                            $myuser = Auth::user()->with('notif_to_user')->whereHas('notif_to_user', function($que){
                                $que->where('to', $this->mysid);
                            })->first();
                            //dd($myuser);
                            if($myuser != null){
                                $notifusers = $myuser->notif_to_user()->sum('read');
                            }else{
                                $notifusers = null;
                            }
                            $myuserchat = Auth::user()->with('chat_to_user')->whereHas('chat_to_user', function($que){
                                $que->where('to', $this->mysid);
                            })->first();
                            if($myuserchat != null){
                                $chatusers = $myuserchat->chat_to_user()->sum('read');
                            }else{
                                $chatusers = null;
                            }
                        @endphp
                        <div class="mr-3 flex flex-row">
                            <a href="{{ url('user/chat/all') }}">
                                <i class="fa-solid fa-envelope text-xl mt-1 my-auto"></i>
                            </a>
                            @if($chatusers != 0)
                            <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2">
                            @endif
                        </div>
                        <div class="mr-4 flex flex-row">
                            <a href="{{ route('notif') }}">
                                <img src="{{url('storage/photos/bellicon.gif')}}" alt="notifications" class="w-6 h-6 my-auto">
                            </a>
                            @if($notifusers != 0)
                            <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2 -ml-2">
                            @endif
                        </div>
                    @endif
                </div>
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if(Auth::guard('employer')->user() != null)
                            <div class="flex flex-row">
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    @if(Auth::guard('employer')->user()->profile_photo_path != null)    
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{url(Auth::guard('employer')->user()->profile_photo_path)}}" alt="{{Auth::guard('employer')->user()->name}}" />
                                    @else
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{url('storage/photos/default-logo.jpg')}}" alt="{{Auth::guard('employer')->user()->name}}" />
                                    @endif
                                </button>&nbsp
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div class="textll">{{Auth::guard('employer')->user()->name}}</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        @else
                            <div class="flex flex-row">
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    @if(Auth::user()->profile_photo_path != null)
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}" />
                                    @else
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}" />
                                    @endif
                                </button>&nbsp
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div class="textll">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>
                        @if(Auth::guard('employer')->user() != null)
                        <x-jet-dropdown-link href="{{ url('employers/'.Auth::guard('employer')->user()->profile_url) }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>
                        @else
                        <x-jet-dropdown-link href="{{ url('users/'.Auth::user()->profile_url) }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{url('user/myclass')}}">
                            {{ __('Kelas Saya') }}
                        </x-jet-dropdown-link>
                        @endif

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                            @endforeach

                            <div class="border-t border-gray-100"></div>
                        @endif
                        @if(Auth::guard('employer')->user() != null)
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('employer.logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('employer.logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                        @else
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                        @endif
                    </x-slot>
                </x-jet-dropdown>
            @else
                <div class="hidden flex-row my-auto sm:flex">
                    @auth
                        @if(Auth::guard('employer')->user() != null)
                            <a href="{{ url('employer/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ url('choice') }}" class="text-sm text-gray-700">
                            <button data-mdb-ripple="true" data-mdb-ripple-color="light" class="w-24 inline-block py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 ripple-surface-light" style="">

                            Login

                            </button>
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ url('registerchoice') }}" class="ml-4 text-sm text-gray-700">
                                <button data-mdb-ripple="true" data-mdb-ripple-color="light" class="w-24 inline-block py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 ripple-surface-light" style="">

                                Register

                                </button>
                            </a>
                        @endif
                    @endif
                </div>
                <div class="hidden lg:flex border-l border-grey-600 mx-4 h-full"></div>
                <div class="hidden body1 my-4 top-0 right-0 lg:flex">
                            <a class="a1" href="{{ url('account') }}"> For Employers
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                </div>
            @endif
            </div>

            <!-- Hamburger -->
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 bg-blue-500 hover:bg-blue-100 focus:outline-none focus:bg-blue-100 focus:text-blue-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        
         @if(Auth::guard('employer')->user() != null)
        <div class="ml-2">
            <x-jet-responsive-nav-link href="{{ route('employer.dashboard') }}" :active="request()->routeIs('employer.dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="ml-2">
            <x-jet-responsive-nav-link href="{{ url('employer/lowongan/sj_send=') }}" :active="request()->routeIs('employer.lowongan/{id}')">
                {{ __('Lowongan') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="ml-2">
            <x-jet-responsive-nav-link href="{{ route('employer.posts') }}" :active="request()->routeIs('employer.posts')">
                {{ __('Tambah Loker') }}
            </x-jet-responsive-nav-link>
        </div>
        @php
            $myempid = Auth::guard('employer')->user()->id;
            $this->myempid = $myempid;
            $myemp = Auth::guard('employer')->user()->with('notif_to_employer')->whereHas('notif_to_employer', function($que){
                $que->where('to', $this->myempid);
            })->first();
            $myempchat = Auth::guard('employer')->user()->with('chat_to_employer')->whereHas('chat_to_employer', function($que){
                $que->where('to', $this->myempid);
            })->first();
            if($myemp != null){
                $notifemployers = $myemp->notif_to_employer()->sum('read');
            }else{
                $notifemployers = null;
            }
            if($myempchat != null){
                $chatemployers = $myempchat->chat_to_employer()->sum('read');
            }else{
                $chatemployers = null;
            }
        @endphp
        <div class="ml-2">
            <x-jet-responsive-nav-link href="{{ route('employer.notif') }}" :active="request()->routeIs('employer.notif')">
                <div class="flex flex-row">
                    <p>Notifikasi</p>
                    @if($notifemployers != 0)
                    <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2">
                    @endif
                </div>
            </x-jet-responsive-nav-link>
        </div>
        <div class="ml-2">
            <x-jet-responsive-nav-link href="{{ url('employer/chat/all') }}" :active="request()->routeIs('employer.chat.open')">
                <div class="flex flex-row">
                    <p>Pesan</p>
                    @if($chatemployers != 0)
                    <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2">
                    @endif
                </div>
            </x-jet-responsive-nav-link>
        </div>
        @else
        <div class="ml-2">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="ml-2">
            <x-jet-responsive-nav-link href="{{ route('lowongan/{id}', 'sj_send=') }}" :active="request()->routeIs('lowongan/{id}')">
                {{ __('Lowongan') }}
            </x-jet-responsive-nav-link>
        </div>
        @endif
        @auth
        @else
        <div class="ml-2">
            <x-jet-responsive-nav-link href="{{ url('account') }}">
                {{ __('For Employers')}}
            </x-jet-responsive-nav-link>
        </div>
        @endif
        @if(Auth::user() != null)
            @if(Auth::user()->user_type == "administr")
                <div class="ml-2">
                    <x-jet-responsive-nav-link href="{{ route('posts') }}" :active="request()->routeIs('posts')">
                        {{ __('Tambah Loker') }}
                    </x-jet-responsive-nav-link>
                </div>
                
                <div class="ml-2">
                    <x-jet-responsive-nav-link href="{{ route('tags') }}" :active="request()->routeIs('tags')">
                        {{ __('Filter') }}
                    </x-jet-responsive-nav-link>
                </div>
                @php
                    $mysid = Auth::user()->id;
                    $this->mysid = $mysid;
                    $myuser = Auth::user()->with('notif_to_user')->whereHas('notif_to_user', function($que){
                        $que->where('to', $this->mysid);
                    })->first();
                    //dd($myuser);
                    if($myuser != null){
                        $notifusers = $myuser->notif_to_user()->sum('read');
                    }else{
                        $notifusers = null;
                    }
                    $myuserchat = Auth::user()->with('chat_to_user')->whereHas('chat_to_user', function($que){
                        $que->where('to', $this->mysid);
                    })->first();
                    if($myuserchat != null){
                        $chatusers = $myuserchat->chat_to_user()->sum('read');
                    }else{
                        $chatusers = null;
                    }
                @endphp
                <div class="ml-2">
                    <x-jet-responsive-nav-link href="{{ route('notif') }}" :active="request()->routeIs('notif')">
                        <div class="flex flex-row">
                            <p>Notifikasi</p>
                            @if($notifusers != 0)
                            <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2">
                            @endif
                        </div>
                    </x-jet-responsive-nav-link>
                </div>
                <div class="ml-2">
                    <x-jet-responsive-nav-link href="{{ url('user/chat/all') }}" :active="request()->routeIs('chat')">
                        <div class="flex flex-row">
                            <p>Pesan</p>
                            @if($chatusers != 0)
                            <img src="{{url('storage/photos/red-circle.png')}}" alt="" class="w-2 h-2">
                            @endif
                        </div>
                    </x-jet-responsive-nav-link>
                </div>
            @endif
        @endif
    </div>
</nav>

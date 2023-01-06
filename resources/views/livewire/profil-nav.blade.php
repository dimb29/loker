
        @if(Auth::guard('employer')->user() != null)
            <div class="hidden"></div>
        @else
            <div class="max-w-7xl mx-auto">
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profil') }}
                    </x-jet-nav-link>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('saveloker') }}" :active="request()->routeIs('saveloker')">
                            {{ __('Lowongan Tersimpan') }}
                        </x-jet-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('pengalaman') }}" :active="request()->routeIs('pengalaman')">
                            {{ __('Pengalaman') }}
                        </x-jet-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('pendidikan') }}" :active="request()->routeIs('pendidikan')">
                            {{ __('Pendidikan') }}
                        </x-jet-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link href="{{ route('keterampilan') }}" :active="request()->routeIs('keterampilan')">
                            {{ __('Keterampilan') }}
                        </x-jet-nav-link>
                    </div>
                </div>
            </div>

        @endif
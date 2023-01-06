<x-slot name="header">
</x-slot>

<x-slot name="footer">
</x-slot>
<div class="py-12 flex flex-row justify-center">
    <div class="max-w-4xl sm:px-6 lg:px-8" id="post-frame">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pb-2">
            <div class="flex flex-col">
                <div class="">
                    <img src="{{url('storage/photos/1641463010221.jfif')}}" alt="" class="h-76 w-full">
                </div>
                <div>
                    @if($udata->profile_photo_path != null)
                    <img src="{{url($udata->profile_photo_path)}}" alt="" 
                    class="ml-2 -mt-10 sm:ml-8 lg:-mt-28 md:-mt-16 h-20 w-20 lg:h-48 lg:w-48 md:h-32 md:w-32 rounded-full object-cover border-4 border-white border-solid">
                    @else
                    <img src="{{url('storage/photos/default-logo.jpg')}}" alt="" 
                    class="ml-2 -mt-10 sm:ml-8 lg:-mt-28 md:-mt-16 h-20 w-20 lg:h-48 lg:w-48 md:h-32 md:w-32 rounded-full object-cover border-4 border-white border-solid">
                    @endif
                </div>
                <div class="flex flex-row">
                    <div class="w-full sm:w-3/4 pt-2 pl-2 sm:pl-8">
                        <p class="text-lg sm:text-xl font-bold">
                            {{$udata->name}}
                            @if($this->authId == $udata->id && $usrtype == 'employer')
                            <a href="{{url('employer/profil')}}"><i class="fa-regular fa-pen-to-square"></i></a>
                            @endif
                        </p>
                        <p class="text-sm sm:text-base">{{$udata->tagline}}</p>
                        <div class="flex xl:flex-row lg:flex-row flex-col text-xs sm:text-base">
                            @if($udata->getkota != null && $udata->getprov != null)
                                <p class="text-gray-500">
                                    {{ucwords(strtolower($udata->getkota->name)) .', '. ucwords(strtolower($udata->getprov->name))}} 
                                </p>
                            @endif
                            <span wire:click="openInfo()" class="text-blue-400 cursor-pointer lg:ml-2 xl:ml-2 ml-0">Informasi Kontak</span>
                        </div>
                        @if($this->authId != null)
                        @if($this->authId == $udata->id && $usrtype == 'employer')
                        @else
                        <div class="flex flex-row mt-4">
                            @if($usrtype == 'user')
                            <button type="button" 
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-3xl text-sm h-8 px-5 py-1 mr-2 mb-2 dark:bg-blue-600 
                                dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                @if($getfollower != null)
                                    <p wire:click="unfollowUser">
                                        <i class="fa-solid fa-check mr-1"></i>
                                        Mengikuti
                                    </p>
                                @else
                                    <p wire:click="followUser">
                                        <i class="fa-solid fa-plus mr-1"></i>
                                        Ikuti
                                    </p>
                                @endif
                            </button>
                            @endif
                            <button type="button" wire:click="openChat({{$udata->id}})"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-3xl text-sm h-8 px-5 py-1 mr-2 mb-2 dark:bg-blue-600 
                                dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <i class="fa-regular fa-comment-dots mr-1"></i>
                                Pesan
                            </button>
                        </div>
                        @endif
                        @endif
                    </div>
                    <div class="hidden sm:block w-1/2 -mt-10 md:-mt-16 lg:-mt-28">
                        <!-- right-header-panel -->
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col mt-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-4 w-full h-auto mt-2">
                <p class="text-lg sm:text-xl font-bold">
                    Tentang 
                    @if($this->authId == $udata->id && $usrtype == 'employer')
                        <a href="{{url('employer/profil')}}"><i class="fa-regular fa-pen-to-square"></i></a>
                    @endif
                </p>
                <div class="flex flex-row">
                    <!-- <img src="" alt=""> -->
                    <div class="w-full">
                        {{$udata->desc}}
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-4 w-full h-auto mt-2">
                <p class="text-lg sm:text-xl font-bold">
                    Lowongan Terbaru 
                    @if($this->authId == $udata->id && $usrtype == 'employer')
                        <a href="{{url('employer/posts')}}"><i class="fa-regular fa-pen-to-square"></i></a>
                    @endif
                </p>
                <div class="flex flex-row">
                    <!-- <img src="" alt=""> -->
                    <div class="w-full">
                        <div class="slider">
                            @foreach($udata->getloker as $getloker)
                            <div data-mdb-ripple="true"
                                data-mdb-ripple-color="light" class="max-w-sm h-56 sm:h-96 mx-16 sm:mx-0 rounded overflow-hidden shadow-xl hover:bg-gray-300 mt-12 m-8
                                rounded-lg hover:text-blue-600 transition duration-150 transform hover:scale-110 hover:-translate-y-2">
                                    <a  href="{{ url('dashboard/posts', $getloker->id) }}">
                                            @if($getloker->employer_id != null)
                                                @if($getloker->author_employer->profile_photo_path != null)
                                                    <!-- <img class="h-28 object-cover sm:h-32 w-full object-contain my-auto mx-auto" style="filter: blur(4px);" src="{{url($getloker->author_employer->profile_photo_path)}}" alt="{{$getloker->author_employer->name}}" /> -->
                                                    <img class="h-28 sm:h-32 w-full object-cover mx-auto" src="{{url($getloker->author_employer->profile_photo_path)}}" alt="{{$getloker->author_employer->name}}" />
                                                @else
                                                    <img class="h-28 sm:h-32 w-40 sm:w-44 rounded-full object-contain my-auto mx-auto" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{$getloker->author_employer->name}}" />
                                                @endif
                                            @else
                                                @if($getloker->author->profile_photo_path != null)
                                                    <img class="h-28 sm:h-32 w-40 sm:w-44 rounded-lg object-contain my-auto mx-auto" src="{{ url($getloker->author->profile_photo_path) }}" alt="{{ $getloker->author->first_name . ' ' . $getloker->author->last_name }}" />
                                                @else
                                                    <img class="h-28 sm:h-32 w-40 sm:w-44 rounded-full object-contain my-auto mx-auto" src="{{ url('storage/photos/default-logo.jpg') }}" alt="{{ $getloker->author->first_name . ' ' . $getloker->author->last_name }}" />
                                                @endif
                                            @endif
                                        <div class="p-0 sm:p-6">

                                            <div class="pl-6 sm:p-0">
                                            <div wire:ignore class="slider2 text-gray-900 text-sm sm:text-xl h-14 sm:h-16 -ml-6 font-semibold my-2">
                                                @php
                                                $postt = $getloker->postTitles;
                                                @endphp
                                                @for($i=0;$i < count($postt);$i++)
                                                    <div>
                                                        {{$postt[$i]->title}}
                                                    </div>
                                                @endfor
                                            </div>
                                            @if($getloker->salary_check == 1)
                                            <h5 class="text-gray-900 text-xs sm:text-sm -ml-1 mb-4 font-semibold">
                                                Rp {{ number_format($getloker->salary_start,0,',','.').' - Rp '.number_format($getloker->salary_end,0,',','.') }}
                                            </h5>
                                            @else
                                            <!-- <p class="h-5"></p> -->
                                            @endif
                                            @if($getloker->employer_id != null)
                                                <h5 class="text-gray-900 text-xs sm:text-base font-medium">
                                                    {{ $getloker->author_employer->name}}
                                                </h5>
                                            @else
                                                <h5 class="text-gray-900 text-xs sm:text-base font-medium">
                                                    {{ $getloker->author->first_name . ' ' . $getloker->author->last_name }}
                                                </h5>
                                            @endif
                                            @if($getloker->salary_check == 1)
                                            <div wire:ignore class="slider2 text-gray-900 text-xs sm:text-base h-8 font-medium mb-6 -ml-5">
                                            @else
                                            <div wire:ignore class="slider2 text-gray-900 text-xs sm:text-base h-8 font-medium mb-15 -ml-5">
                                            @endif
                                                @php
                                                $regens = $getloker->regency;
                                                @endphp
                                                @for($i=0;$i < count($regens);$i++)
                                                    <div>
                                                        {{$regens[$i]->name}}
                                                    </div>
                                                @endfor
                                            </div>

                                            <div class="font-medium text-xs sm:text-base text-gray-400 mb-2">

                                            <p>
                                                @php
                                                $minutes = $thistime->diffInMinutes($getloker->updated_at);
                                                $hours = $thistime->diffInHours($getloker->updated_at);
                                                $days = $thistime->diff($getloker->updated_at)->days;
                                                $weeks = $thistime->diffInWeeks($getloker->updated_at);
                                                $months = $thistime->diffInMonths($getloker->updated_at);
                                                $years = $thistime->diffInYears($getloker->updated_at);
                                                @endphp
                                                @if($minutes <= 60)
                                                    {{$minutes}} menit yang lalu
                                                @elseif($hours <= 24)
                                                    {{$hours}} jam yang lalu
                                                @elseif($days <= 7)
                                                    {{$days}} hari yang lalu
                                                @elseif($weeks <= 4)
                                                    {{$weeks}} minggu yang lalu
                                                @elseif($months <= 12)
                                                    {{$months}} bulan yang lalu
                                                @else
                                                    {{$years}} tahun yang lalu
                                                @endif

                                            </p>

                                            </div>
                                        
                                            </div>

                                        </div>

                                    </a>

                                

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @if($infoOpen)
                <!-- Main modal -->
                <div tabindex="-1" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex" aria-modal="true" role="dialog">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Informasi Kontak
                                    @if($this->authId == $udata->id && $usrtype == 'employer')
                                        <a href="{{url('employer/profile')}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    @endif
                                </h3>
                                <button wire:click="closeInfo()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-3">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    {{$udata->name}}
                                </h3>
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    <i class="fa-solid fa-envelope-open-text mr-4"></i>
                                    <a href="#" class="text-blue-500">
                                        {{$udata->email}}
                                    </a>
                                </p>
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    <i class="fa-solid fa-phone mr-4"></i>
                                    {{$udata->telepon}}
                                </p>
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    <i class="fa-solid fa-cake-candles mr-4"></i>
                                    nope
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <!-- <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                <button data-modal-toggle="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                                <button data-modal-toggle="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                            </div> -->
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="hidden sm:block max-w-sm mx-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex flex-col">
                <div class="">
                    <a  href="{{ url('dashboard/lowongan/sj_send=') }}">
                        <img href="{{ url('dashboard/lowongan/sj_send=')" src="https://media.licdn.com/media/AAYQAgTPAAgAAQAAAAAAADVuOvKzTF-3RD6j-qFPqhubBQ.png" alt="" class="rounded-lg h-76 w-full">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('.slider').slick({
    arrows: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    draggable: true,
    touchMove: true,
    autoplay: true,
    autoplaySpeed: 2000,
});
$('.slider2').slick({
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        draggable: true,
        touchMove: true,
        autoplay: true,
        autoplaySpeed: 1000,
});
</script>
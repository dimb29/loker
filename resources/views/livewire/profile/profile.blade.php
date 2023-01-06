<x-slot name="header">
</x-slot>

<x-slot name="footer">
</x-slot>
<div class="min-h-screen overflow-hidden py-0 sm:py-12 flex flex-row justify-center">
    <div class="w-full sm:max-w-4xl sm:px-6 lg:px-8" id="post-frame">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex flex-col">
                <div class="">
                    <img wire:click="openHeader()" src="{{url('storage/photos/1641463010221.jfif')}}" alt="" class="cursor-pointer rounded-none sm:rounded-lg h-76 w-full">
                </div>
                <div class="">
                    @if($udata->profile_photo_path != null)
                    <img wire:click="openImg()" src="{{url($udata->profile_photo_path)}}" alt="" 
                    class="cursor-pointer ml-2 -mt-20 sm:ml-8 lg:-mt-32 md:-mt-16 h-28 w-28 lg:h-48 lg:w-48 md:h-32 md:w-32 rounded-full object-cover border-4 border-white border-solid">
                    @else
                    <img wire:click="openImg()" src="{{url('storage/photos/default-logo.jpg')}}" alt="" 
                    class="cursor-pointer ml-2 -mt-20 sm:ml-8 lg:-mt-32 md:-mt-16 h-28 w-28 lg:h-48 lg:w-48 md:h-32 md:w-32 rounded-full object-cover border-4 border-white border-solid">
                    @endif
                </div>
                <div class="flex flex-row px-4 py-4">
                    <div class="w-full sm:w-3/5 pt-2 pl-2 sm:pl-4 mb-4">
                        <p class="text-lg sm:text-xl font-bold">
                            {{$udata->first_name .' '. $udata->last_name}}
                            @if($this->authId == $udata->id && $usrtype == 'user')
                            <a href="{{url('user/profile')}}"><i class="fa-regular fa-pen-to-square"></i></a>
                            @endif
                        </p>
                        <p class="text-sm sm:text-base">{{$udata->profesi}}</p>
                        <div class="block sm:hidden">
                            <div class="flex flex-row text-xs sm:text-base text-gray-500">
                                <div class="truncate mr-2">
                                    @php
                                    $pendiuser = $udata->pendidikanuser;
                                    for($i=0;$i < count($pendiuser);$i++){
                                        if($i+1 == count($pendiuser)){
                                            echo $pendiuser[$i]->name;
                                        }else{
                                            echo $pendiuser[$i]->name.", ";
                                        }
                                    }
                                    @endphp
                                </div>
                                @if($this->authId == $udata->id && $usrtype == 'user')
                                    <a href="{{url('user/pendidikan')}}"><i class="fa-regular fa-pen-to-square"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="flex xl:flex-row lg:flex-row flex-col text-xs sm:text-base">
                            @if($udata->getkota != null && $udata->getprov != null)
                                <p class="text-gray-500">
                                    {{ucwords(strtolower($udata->getkota->name)) .', '. ucwords(strtolower($udata->getprov->name))}} 
                                </p>
                            @endif
                            <span wire:click="openInfo()" class="text-blue-400 cursor-pointer lg:ml-2 xl:ml-2 ml-0">Informasi Kontak</span>
                        </div>
                        @if($this->authId != null)
                        @if($this->authId == $udata->id && $usrtype == 'user')
                        @else
                        <div class="flex flex-row mt-4">
                            @if($usrtype == 'user')
                                <button type="button" 
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-3xl text-sm h-8 px-5 py-1 mr-2 mb-2 
                                    dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    @if($getfollower != null)
                                        @if($getfollowing != null)
                                            <p wire:click="unfollowUser">
                                                <i class="fa-solid fa-check mr-1"></i>
                                                Terhubung
                                            </p>
                                        @else
                                            <p wire:click="unfollowUser">
                                                <i class="fa-regular fa-clock"></i>
                                                Menunggu
                                            </p>
                                        @endif
                                    @else
                                        @if($getfollowing != null)
                                            <p wire:click="followbackUser">
                                                <!-- <i class="fa-solid fa-check mr-1"></i> -->
                                                Terima Permintaan
                                            </p>
                                        @else
                                            <p wire:click="followUser">
                                                <i class="fa-solid fa-plus mr-1"></i>
                                                Hubungkan
                                            </p>
                                        @endif
                                    @endif
                                </button>
                            @endif
                            <button type="button" wire:click="openChat({{$udata->id}})"
                                class="text-blue-700 bg-white hover:bg-blue-200 border-solid border-2 border-blue-500 hover:border-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-3xl text-sm h-8 px-5 py-1 mr-2 mb-2 dark:bg-blue-600 
                                dark:hover:bg-blue-200 focus:outline-none dark:focus:ring-blue-200">
                                <i class="fa-regular fa-comment-dots mr-1"></i>
                                Pesan
                            </button>
                        </div>
                        @endif
                        @endif
                    </div>


                    <div class="hidden sm:w-full sm:w-2/5 pt-2 pl-2 sm:pl-4 mb-4">
                        @foreach($udata->pendidikanuser as $pendiuser)
                        <div class="flex flex-row mt-2 mx-auto">
                            <div>
                                <img class="object-contain h-10 w-10 mr-2" src="{{url('storage/photos/iconee.jpg')}}">
                            </div>
                            <div>
                                <div class="text-sm sm:text-base w-full h-16 rounded">
                                    <p class="truncate">{{$pendiuser->name}}</p>
                                    <p class="truncaate text-xs sm:text-sm">{{$pendiuser->major}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
                    
            <div class="my-4">
                <div class="bg-white shadow-xl sm:rounded-lg px-4 py-4 w-full h-auto">
                    <p class="text-lg sm:text-xl font-semibold">
                        Pengalaman 
                        @if($this->authId == $udata->id && $usrtype == 'user')
                            <a href="{{url('user/pengalaman')}}"><i class="fa-regular fa-pen-to-square"></i></a>
                        @endif
                    </p>
                    <div class="flex flex-row">
                        <!-- <img src="" alt=""> -->
                        <div class="w-full">
                            @foreach($udata->pengalamanuser as $penguser)
                            <div class="py-2 flex flex-row">
                                <div>
                                    <img class="object-contain h-10 w-10 mr-2" src="{{url('storage/photos/icone.jpg')}}">
                                </div>
                                <div>
                                <p class="font-semibold">{{$penguser->name}}</p>
                                <p class="font-medium">{{$penguser->company_name}}</p>
                                <p class="text-sm text-gray-500 font-medium">
                                    {{$penguser->work_start}} s/d 
                                    @if($penguser->work_end != null)
                                    {{$penguser->work_end}}
                                    @else
                                    Saat ini
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500">{{$penguser->city}}, {{$penguser->province}}, {{$penguser->country}}</p>
                                </div>
                            </div>
                            @if($loop->last)  @else <hr> @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4">
                <div class="bg-white shadow-xl sm:rounded-lg px-4 py-4 w-full h-auto mb-2">
                    <p class="text-lg sm:text-xl font-semibold">
                        Keterampilan 
                        @if($this->authId == $udata->id && $usrtype == 'user')
                            <a href="{{url('user/keterampilan')}}"><i class="fa-regular fa-pen-to-square"></i></a>
                        @endif
                    </p>
                    <div class="flex flex-row">
                        <!-- <img src="" alt=""> -->
                        <div class="w-full">
                            @foreach($udata->keterampilanuser as $ketuser)
                            <div class="flex flex-row py-2">
                                <div>
                                    <p class="font-semibold mr-2">{{$ketuser->name}}</p>
                                </div>
                                <div>
                                    <p class="text-md"> - {{$ketuser->level}}</p>
                                </div>
                            </div>
                            @if($loop->last)  @else <hr> @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @if($headerOpen)
                <!-- Main modal -->
                <div tabindex="-1" wire:click="closeHeader()" class="fixed top-0 bot-0 right-0 left-0 z-50 w-full md:inset-0 min-h-screen overflow-hidden justify-center items-center flex" style="background-color: rgba(0,0,0,.75);" aria-modal="true" role="dialog">
                    <div class="block mt-24 sm:mt-0 w-full sm:w-auto h-screen md:h-auto">
                        <!-- Modal content -->
                        <div class="block w-full sm:w-auto bg-white rounded-lg sm:m-20 shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-2 rounded-t dark:border-gray-600">
                                <!-- <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Informasi Kontak
                                  
                                </h3> -->
                                <button wire:click="closeHeader()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="w-full sm:max-w-7xl mx-auto">
                                <img wire:click="openHeader()" src="{{url('storage/photos/1641463010221.jfif')}}" alt="" class="h-36 sm:h-auto w-full">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($imgOpen)
                <!-- Main modal -->
                <div tabindex="-1" wire:click="closeImg()" class="fixed top-0 bot-0 right-0 left-0 z-50 w-full md:inset-0 min-h-screen overflow-hidden justify-center items-center flex" style="background-color: rgba(0,0,0,.75);" aria-modal="true" role="dialog">
                    <div class="block p-4 mt-24 sm:mt-0 w-full sm:w-auto h-screen md:h-auto">
                        <!-- Modal content -->
                        <div class="block w-full sm:w-auto bg-white rounded-lg sm:m-20 shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t dark:border-gray-600">
                                <!-- <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Informasi Kontak
                                  
                                </h3> -->
                                <button wire:click="closeImg()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="max-w-4xl mx-auto sm:my-4">
                                @if($udata->profile_photo_path != null)
                                <img wire:click="openImg()" src="{{url($udata->profile_photo_path)}}" alt="" 
                                class="sm:p-8 mx-auto h-38 w-38 lg:h-full lg:w-full md:h-32 md:w-32 sm:rounded-full object-cover border-4 border-white border-solid">
                                @else
                                <img wire:click="openImg()" src="{{url('storage/photos/default-logo.jpg')}}" alt="" 
                                class="sm:p-8 mx-auto h-38 w-38 lg:h-full lg:w-full md:h-32 md:w-32 sm:rounded-full object-cover border-4 border-white border-solid">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($infoOpen)
                <!-- Main modal -->
                <div tabindex="-1" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex" style="background-color: rgba(0,0,0,.75);" aria-modal="true" role="dialog">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Informasi Kontak
                                    @if($this->authId == $udata->id && $usrtype == 'user')
                                        <a href="{{url('user/profile')}}"><i class="fa-regular fa-pen-to-square"></i></a>
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
                                    {{$udata->first_name .' '. $udata->last_name}}
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
                                    {{date('d F', strtotime($udata->birth_date))}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        <div class="bg-white rounded-lg mt-4 shadow-lg">
            <div class="py-2 px-4">
                <p class="text-lg sm:text-xl">
                    Pendidikan 
                    @if($this->authId == $udata->id && $usrtype == 'user')
                        <a href="{{url('user/pendidikan')}}"><i class="fa-regular fa-pen-to-square"></i></i></a>
                    @endif
                </p>
                @foreach($udata->pendidikanuser as $pendiuser)
                <div class="flex flex-row mt-4">
                    <div>
                        <img class="object-contain h-10 w-10 mr-2" src="{{url('storage/photos/iconee.jpg')}}">
                    </div>
                    <div>
                        <div class="w-full h-16 rounded">
                            <p class="text-sm sm:text-base truncate">{{$pendiuser->name}}</p>
                            <p class="text-sm truncaate">{{$pendiuser->major}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
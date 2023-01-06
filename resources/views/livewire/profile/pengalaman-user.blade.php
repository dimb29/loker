<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <livewire:profil-nav/>
    </h2>
</x-slot>

<x-slot name="footer">
</x-slot>
    <div>    
    <style>
    .select2-container{
        width:100%;
        height:50px;
    }
    .select2-selection{
        height:45px;
        border: 1px solid #f8fafc;
        padding: 20px;
        box-shadow: 1px 1px 2px 1px #e2e8f0;
    }
    .select2-selection__rendered {
    display: block;
    padding-left: 0px;
    padding-right: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-top: -13px;
    margin-left: -8px;
    }
    .select2-selection__arrow {
        margin-top: 7px;
    }
    </style>
        <div class="max-w-7xl mb-24 mx-auto py-10 sm:px-6 lg:px-8 md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
            <x-slot name="title">
                {{ __('Pengalaman') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Perbaharui Pengalaman anda untuk menarik minat Perusahaan.') }}
            </x-slot>
        </x-jet-section-title>

        <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                        @if($isEdits)
                            <!-- Posisi -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="position_name" value="{{ __('Posisi') }}" />
                                <x-jet-input required id="position_name" type="text" class="mt-1 block w-full" wire:model.defer="position_name" autocomplete="position_name" />
                                <x-jet-input-error for="position_name" class="mt-2" />
                            </div>

                            <!-- Nama Perusahaan -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="company" value="{{ __('Nama Perusahaan') }}" />
                                <x-jet-input required id="company" type="text" class="mt-1 block w-full" wire:model.defer="company" autocomplete="company" />
                                <x-jet-input-error for="company" class="mt-2" />
                            </div>

                            <!-- Lama Bekerja -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="work_start" value="{{ __('Lama Bekerja') }}" />
                                <div class="flex flex-row mt-2">
                                    <div class="block w-full">
                                        <x-jet-label for="work_start" class="" value="{{ __('Masuk Kerja') }}" />
                                        <div class="rounded-md border-2" style="width: 190px;">
                                        <x-jet-date-picker required id="work_start" class="w-full mr-1" type="text" wire:model.defer="work_start" />
                                        </div>
                                    </div>
                                    <div class="block w-full ml-1">
                                        <x-jet-label for="work_end" class="" value="{{ __('Keluar Kerja') }}" />
                                        <div class="rounded-md border-2" style="width: 190px;">
                                        <x-jet-date-picker id="work_end" class="w-full ml-1" type="text" wire:model.defer="work_end" />
                                        </div>
                                    </div>
                                </div>
                                <x-jet-input-error for="email" class="mt-2" />
                            </div>

                            <!-- Spesialis -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="specialist" value="{{ __('Spesialis') }}" />
                                <x-jet-select2 required wire:ignore id="specialist" type="text" wire:model="specialist" autocomplete="specialist" 
                                    class="mt-2 shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                        <option value=""></option>
                                    @for($i=0;$i < count($spesialists);$i++)
                                        <option class="p-2" value="{{$spesialists[$i]['id']}}">{{$spesialists[$i]['name_sk']}}</option>
                                    @endfor
                                </x-jet-select2>
                                <x-jet-input-error for="specialist" class="mt-2" />
                            </div>
                            
                            <!-- FOW -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="fow" value="{{ __('Bidang Kerja') }}" />
                                <select required id="fow" type="text" wire:model.defer="fow" autocomplete="fow" 
                                    class="mt-2 shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                                        <option value=""></option>
                                    @for($i=0;$i < count($bidker_arr);$i++)
                                        <option class="p-2" value="{{$bidker_arr[$i]['id']}}">{{$bidker_arr[$i]['name']}}</option>
                                    @endfor
                                </select>
                                <!-- <x-jet-input id="fow" type="text" class="mt-1 block w-full" wire:model.defer="fow" autocomplete="fow" /> -->
                                <x-jet-input-error for="fow" class="mt-2" />
                            </div>

                            <!-- Tingkat Kerja -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="tingker" value="{{ __('Bidang Kerja') }}" />
                                <select required wire:ignore id="tingker" type="text" wire:model="tingker" autocomplete="tingker" 
                                    class="mt-2 shadow appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none 
                                    focus:shadow-outline">
                                        <option value=""></option>
                                    @for($i=0;$i < count($tingker_arr);$i++)
                                        <option class="p-2" value="{{$tingker_arr[$i]['id']}}">{{$tingker_arr[$i]['name_tk']}}</option>
                                    @endfor
                                </select>
                                <x-jet-input-error for="tingker" class="mt-2" />
                            </div>

                            <!-- Country -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="country" value="{{ __('Negara') }}" />
                                <x-jet-input required id="country" type="text" class="mt-1 block w-full" wire:model.defer="country" autocomplete="country" />
                                <x-jet-input-error for="country" class="mt-2" />
                            </div>

                            <!-- Provinsi-Kota -->
                            <div class="col-span-6 sm:col-span-4">
                                <div class="flex flex-row mt-1">
                                    <div class="w-full mr-1">
                                        <x-jet-label for="province" value="{{ __('Provinsi') }}" />
                                        <x-jet-input required id="province" type="text" class="block w-full" wire:model.defer="province" />
                                        <x-jet-input-error for="province" class="mt-2" />
                                    </div>
                                    <div class="w-full ml-1">
                                        <x-jet-label for="city" value="{{ __('Kota') }}" />
                                        <x-jet-input required id="city" type="text" class="block w-full" wire:model.defer="city" />
                                        <x-jet-input-error for="city" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Salary -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="salary" value="{{ __('Gaji') }}" />
                                <div class="flex flex-row mt-1">
                                    <x-jet-select2 required id="currency" type="text" class="block w-24 mr-1" wire:model="currency" >
                                        <option value=""></option>
                                        <option value="IDR">IDR</option>
                                        <option value="USD">USD</option>
                                        <option value="JPY">JPY</option>
                                    </x-jet-select2>
                                    <x-jet-input required id="salary" type="text" class="block w-full ml-1 h-11" wire:model.defer="salary" />
                                </div>
                                <x-jet-input-error for="currency" class="mt-2" />
                                <x-jet-input-error for="salary" class="mt-2" />
                            </div>
                            
                            <!-- Deskripsi -->
                            <div wire:ignore
                            class="col-span-6 sm:col-span-4">
                                <x-jet-label for="desc" value="{{ __('Deskripsi') }}" />
                                <textarea required id="desc"
                                type="text" class="mt-1 block w-full" 
                                wire:model.defer="desc" autocomplete="desc" x-data 
                                x-init="
                                    CKEDITOR.replace('desc');
                                    CKEDITOR.instances.desc.on('change', function() {
                                        $dispatch('input', this.getData());
                                    });"></textarea>
                                <x-jet-input-error for="desc" class="mt-2" />
                            </div>
                        @else
                        <div class="col-span-10 sm:col-span-6">
                            @if (session()->has('message'))
                                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                                <div class="flex">
                                    <div>
                                    <p class="text-sm">{{ session('message') }}</p>
                                    </div>
                                </div>
                                </div>
                            @endif
                            <button wire:click="create()"
                                class="inline-flex items-center px-4 py-2 my-3 mb-12 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Buat Baru
                            </button>
                            @foreach($get_penusers as $penuser)
                            <div class="flex flex-row font-semibold text-2xl mb-4">
                                <h1 class="w-5/6 text-blue-800 font-semibold text-3xl sm:mr-8">{{$penuser->name}}</h1>
                                <div class="justify-end my-auto">
                                    <button class="text-gray-600 mr-1" wire:click="openEdit('{{$penuser->id}}')"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="text-red-700" wire:click="openDelete({{$penuser->id}})"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </div>
                            <p class="w-5/6 mb-2 font-semibold">{{$penuser->company_name}} | {{$penuser->province}}, {{$penuser->country}}</p>
                            <div class="flex flex-col text-sm">
                                <div class="flex flex-row my-2">
                                    <div class="w-1/3">
                                        <h1 class="">Spesialis</h1>
                                    </div>
                                    <div class="w-2">
                                        :
                                    </div>
                                    <div class="w-1/2">
                                        <h1>{{$penuser->spesialiskerja->name_sk}}</h1>
                                    </div>
                                </div>
                                <div class="flex flex-row mb-2">
                                    <div class="w-1/3">
                                        <h1 class="">Bidang Pekerjaan</h1>
                                    </div>
                                    <div class="w-2">
                                        :
                                    </div>
                                    <div class="w-1/2">
                                        <h1>{{$penuser->bidangkerja->name}}</h1>
                                    </div>
                                </div>
                                <div class="flex flex-row mb-2">
                                    <div class="w-1/3">
                                        <h1 class="">Jabatan</h1>
                                    </div>
                                    <div class="w-2">
                                        :
                                    </div>
                                    <div class="w-1/2">
                                        <h1>{{$penuser->tingkatkerja->name_tk}}</h1>
                                    </div>
                                </div>
                                <div class="flex flex-row">
                                    <div class="w-1/3">
                                        <h1 class="">Gaji Bulanan</h1>
                                    </div>
                                    <div class="w-2">
                                        :
                                    </div>
                                    <div class="w-1/2">
                                        <h1>{{$penuser->currency}} {{$penuser->salary}}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="w-5/6 border-b-2 border-black my-2 mb-8"></div>
                            @endforeach
                        </div>
                        @endif
                        </div>
                    </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            @if($isEdits)
                                <x-jet-action-message class="mr-3" on="saved">
                                    {{ __('Saved.') }}
                                </x-jet-action-message>

                                <x-jet-button wire:click="store">
                                    {{ __('Save') }}
                                </x-jet-button>
                            @endif
                        </div>
                </div>
                @if($isDelete)
                    <div id="popup-modal" tabindex="-1" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center" aria-hidden="true">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto top-1/4">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button wire:click="closeDelete()" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                                <div class="p-6 text-center">
                                    <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this content?</h3>
                                    <button wire:click="delete()"type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                    Yes, I'm sure
                                    </button>
                                    <button wire:click="closeDelete()" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
        </div>
    </div>


<div class="banner sm:hidden flex flex-row fixed justify-center z-50 left-0 right-0 bottom-0">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylee.css') }}">
</head>

<bodyy>

    <ul class="nav">
        <span class="nav-indicator4"></span>
        <li>
            <a class="animate-bounce" href="{{ url('dashboard/account') }}">
                <ion-icon name="people-circle-outline"></ion-icon>
                <span class="title">About Us</span>
            </a>
        </li>
        <li>
            <a href="{{ url('dashboard/lowongan/sj_send=') }}">
                <ion-icon name="search-outline"></ion-icon>
                <span class="title">Search</span>
            </a>
        </li>
        <li>
            <a href="{{ url('') }}">
                <ion-icon name="home-outline"></ion-icon>
                <span class="title">Homepage</span>
            </a>
        </li>
        <li>
            <a href="{{ url('/user/saveloker') }}">
                <ion-icon name="bookmarks-outline"></ion-icon>
                <span class="title">Bookmark</span>
            </a>
        </li>
        <li>
            <a class="open-side nav-item-active">
                <ion-icon name="person-outline"></ion-icon>
                <span class="title">Account</span>
            </a>
        </li>
    </ul>


    <!-- https://css-tricks.com/gooey-effect/ -->

    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="filter-svg">
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                <feBlend in="SourceGraphic" in2="goo" />
            </filter>
        </defs>
    </svg>

    

</bodyy>
</div>
<script>
    
let nav = document.querySelector('.nav')

nav.querySelectorAll('li a').forEach((a, i) => {
a.onclick = (e) => {
if (a.classList.contains('nav-item-active')) return

nav.querySelectorAll('li a').forEach(el => {
    el.classList.remove('nav-item-active')
})

a.classList.add('nav-item-active')

let nav_indicator = nav.querySelector('.nav-indicator4')

nav_indicator.style.left = `calc(${(i * 80) + 40}px - 45px)`
}
})

var lastScrollTop = 0;
$(window).scroll(function(){
  var st = $(this).scrollTop();
  var banner = $('.banner');
  setTimeout(function(){
    if (st > lastScrollTop){
      banner.addClass('hide');
    } else {
      banner.removeClass('hide');
    }
    lastScrollTop = st;
  }, 100);
});

</script>
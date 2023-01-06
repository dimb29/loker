<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <livewire:profil-nav/>
    </h2>
</x-slot>

<x-slot name="footer">
</x-slot>
<div class="h-screen">
    <!-- Jenis Kerja -->
    <div class="max-w-7xl mb-80 mx-auto sm:px-6 lg:px-8 pt-0 sm:pt-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <div class="sm:ml-24">
                <p>Keterampilan</p>
                <div class="flex flex-row text-blue-500 mb-4" wire:click="create()">
                    <i class="fa-solid fa-plus mr-2 my-auto"></i>
                    <p>Tambah Keterampilan</p>
                </div>
            </div>
            @if($isOpen)
            <div class="create-modals fixed zind1500 inset-0 overflow-y-auto ease-out duration-400">
                <div class="flex items-center justify-center my-auto h-screen text-center sm:block sm:p-0">

                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <form>
                            <div class="bg-white px-4 pt-5 pb-4">
                                <div class="flex mb-2">
                                        <div class="w-3/5 mx-1">
                                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                            <input type="text" class="input-filter shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" wire:model.defer="title">
                                            @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="w-2/5 mx-1">
                                            <label for="level" class="block text-gray-700 text-sm font-bold mb-2">Tingkat:</label>
                                            <select type="text" class="input-level shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" wire:model.defer="level">
                                                <option value="Pemula">Pemula</option>
                                                <option value="Menengah">Menengah</option>
                                                <option value="Tingkat Lanjut">Tingkat Lanjut</option>
                                            </select>
                                            @error('level') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                </div>
                            </div>

                            <div class="flex flex-row justify-end">
                                    <button
                                        wire:click.prevent="store()"
                                        type="button"
                                        class="save-create-modal btn-save inline-flex items-center mr-2 px-4 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Save
                                    </button>
                                    <button wire:click="closeCreate()"
                                        type="button"
                                        class="inline-flex items-center mr-4 px-4 py-2 my-3 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                    Cancel
                                    </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            
            @foreach($ketusers as $ketuser)
            <div class="flex flex-row mb-2 sm:mx-32" style="border-bottom-width: 1px;">
                <div class="flex flex-col w-4/5">
                    <div class="font-semibold">{{ $ketuser->name }}</div>
                    <div class="text-sm">{{ $ketuser->level }}</div>
                </div>
                <div class="ml-auto mt-2">
                    <i class="fa-regular fa-pen-to-square" wire:click="edit({{$ketuser->id}})" data-val="{{ $ketuser->name }}" data-level="{{ $ketuser->level }}" data-id="{{ $ketuser->id }}"></i>
                    <i class="fa-regular fa-trash-can get-edti-val text-red-800" wire:click="openDelete({{ $ketuser->id }})"></i>
                </div>
            </div>
            @endforeach
            @if($isDelete)
            <div id="popup-modal" tabindex="-1" class="overflow-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center" aria-hidden="true">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto top-1/4">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button wire:click="closeDelete()" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="p-6 text-center">
            <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this content?</h3>
            <button wire:click="delete()" data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
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
    <!-- /Jenis Kerja -->
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


    $(document).ready(function(){
        var btn_save;
        $('.content-filters').click(function(){
            var name_filter = $(this).attr('data-name');
            $('.input-filter').val('');
            $('.input-level').val('');
            $('.btn-save').attr('wire:click.prevent', 'store()');
            $('.create-modals').show();
        })
        $('.get-edti-val').click(function(){
            var data_id = $(this).attr('data-id');
            var data_val = $(this).attr('data-val');
            var data_level = $(this).attr('data-level');
            btn_save = "edit("+data_id+")";
            $('.input-filter').val(data_val);
            $('.input-level').val(data_level);
            $('.btn-save').attr('wire:click.prevent', btn_save);
            $('.create-modals').show();
        })
        // $('.close-create-modal').click(function(){
        //     $('.create-modals').hide();
        // })
        // $('.save-create-modal').click(function(){
        //     $('.create-modals').hide();
        // })

    });
</script>
<script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>

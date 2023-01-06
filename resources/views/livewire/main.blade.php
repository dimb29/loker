<x-slot name="header">
    <div class="bg-white">
        <div class="hidden sm:flex max-w-7xl mx-auto">
            <img class="object-contain h-full w-full" src="{{url('storage/photos/bkerjafixxx.jpg')}}">
        </div>
        <div class="flex sm:hidden max-w-7xl mx-auto h-56">
            <img class="object-cover h-56 w-full" src="{{url('storage/photos/hp.jpg')}}">
        </div>
    </div>
</x-slot>

<x-slot name="footer">
</x-slot>

<div class="py-12 bg-yellow bg-fixed ..." >
            <div class="flex-auto ">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 -mt-24 lg:-mt-28">
                    <div class=" justify-center">
                        <div class="flex justify-center ...">
                            <div class="w-full shadow-xl p-5 rounded-lg bg-white">
                            <div class="flex flex-col sm:flex-row">

                            <div class="relative w-full sm:w-80 mr-1 mb-1">

                                    <div class="absolute flex items-center ml-2 mt-2">

                                    <lord-icon
                                        src="https://cdn.lordicon.com/msoeawqm.json"
                                        trigger="loop"
                                        colors="primary:#1b1091,secondary:#1663c7"
                                        style="width:30px;height:30px">
                                    </lord-icon>

                                    </div>



                                    <input type="search" id="search-title" list="title-list" wire:model="searchjob" name="searchjob" type="text" placeholder="Pekerjaan, kata kunci, atau nama perusahaan" 

                                    class="pl-11 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">


                            </div>

                            <div class="w-full sm:w-80 ml-0 sm:ml-1 mr-0 sm:mr-1 mt-1 sm:mt-0 mb-1 sm:mb-0">

                                    <div class="absolute flex items-center ml-2 mt-2 ">

                                        <lord-icon
                                            src="https://cdn.lordicon.com/zzcjjxew.json"
                                            trigger="loop"
                                            colors="primary:#2516c7,secondary:#30c9e8"
                                            style="width:32px;height:32px">
                                        </lord-icon>

                                    </div>

                                    <input id="search-loc" wire:model.defer="locations" type="search" placeholder="Lokasi" 
                                    class="pl-11 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
                            </div>

                            <div class="w-full sm:w-80 ml-0 sm:ml-1 mr-0 sm:mr-1 mt-1 sm:mt-0 mb-1 sm:mb-0">

                                    <div class="absolute flex items-center ml-2 mt-2">

                                        <lord-icon
                                            src="https://cdn.lordicon.com/soseozvi.json"
                                            trigger="loop"
                                            colors="primary:#1b1091,secondary:#66d7ee"
                                            style="width:32px;height:32px">
                                        </lord-icon>

                                    </div>

                                    <select wire:model.defer="jenis_kerja" style="text-indent:39px;" class="py-3 w-full h-11 rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">

                                        <option value="">Jenis Pekerjaan</option>

                                        @foreach ($jenkers as $jenker)

                                        <option value="{{$jenker->id}}">{{$jenker->name_jk}}</option>

                                        @endforeach

                                    </select>

                            </div>

                            <div class="hidden lg:flex sm:w-48 ml-0 sm:ml-1 mr-0 sm:mr-1 mb-1 sm:mb-0 grid justify-items-end">

                                <button wire:click="searchJobs()" data-mdb-ripple="true"

                                    data-mdb-ripple-color="light"

                                    class="search-myjob w-full sm:w-48 justify-end inline-block px-6 py-2.5 my-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800">

                                    SEARCH

                                </button>

                            </div>

                            </div>

                            <div class="flex lg:hidden grid justify-items-end">

                                <button wire:click="searchJobs()" data-mdb-ripple="true"

                                    data-mdb-ripple-color="light"

                                    class="search-myjob w-full justify-end inline-block px-6 py-2.5 my-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-md shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800">

                                    SEARCH

                                </button>

                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <div class="max-w-7xl mx-auto lg:px-8 pt-4">
        <div class="cyanshadow bg-white overflow-hidden sm:rounded-lg px-4 pt-4">
        <p class="secondary-heading">Job Recommendation</p>
            <livewire:slider>
        </div>
</div>
                <div class="hidden space-x-8 lg:flex w-4/5 myframe">
                </div>
            

<div class="flex justify-end">
        <div class="sm:max-w-7xl pt-24 ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">



                    <div class="lg:flex flex-row">
                        <div class="lg:w-1/2 lg:m-10">
                            <h2 class="secondary-heading mt-4">Find the right job or</h2>
                            <h2 class="secondary-heading mb-12">internship for you</h2>
                        </div>
                        <div class="lg:w-1/2 md:mt-6 md:mb-4">
                            <p class="font-medium mb-2">SUGGESTED SEARCHES</p>
                            @foreach($speskerjas as $speskerja)
                            <a href="{{url('lowongan/sk_send='.$speskerja->spesialis_kerja_id)}}">
                                <button type="button" class="text-sm mt-2 inline-block px-6 py-3 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded-full shadow-md hover:bg-gray-300 
                                hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">
                                {{$speskerja->name_sk}}</button>
                            </a>
                            @endforeach
                        </div>
                    </div>

        </div>
    </div>
</div>


            <div class="max-w-7xl pt-24 ">
             <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

                    <div class="lg:flex flex-row my-4">
                        <div class="lg:w-1/2 lg:m-10">
                            <h2 class="secondary-heading mt-4">Explore location</h2>
                            <h2 class="secondary-heading mb-12">you are interested in</h2>
                        </div>
                        <div class="lg:w-1/2 sm:mt-10 sm:mb-4">
                            <p class="font-medium mb-2">SUGGESTED LOCATION</p>
                            @foreach($regens as $regen)
                            <a href="{{url('lowongan/loc_send='.$regen->name)}}">
                                <button type="button" class="text-sm mt-2 inline-block px-6 py-3 bg-gray-200 text-gray-700 font-medium leading-tight uppercase rounded-full shadow-md hover:bg-gray-300 
                                hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">
                                {{$regen->name}}</button>
                            </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>


        <div class="sm:max-w-full mt-28">
            <a  href="{{ url('lowongan/sj_send=') }}">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-4">

                    <div class="lg:flex flex-row justify-center sm:my-6">
                        <div class="lg:w-1/3 lg:mt-28">
                        <h2 class="secondary-heading ml-0 sm:ml-24">Find the right job</h2>
                        <h2 class="secondary-heading ml-0 sm:ml-24">for you now..</h2>
                        </div>

                        <div class="lg:w-1/4 ">
                        <img class="sm:ml-auto sm:mr-32 sm:h-96" src="{{url('storage/photos/chara22.svg')}}">
                        </div>
                    </div>
            </a>
         </div>
        </div>

</div>
            

<div class="banner sm:hidden flex flex-row fixed justify-center z-50 left-0 right-0 bottom-0">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylee.css') }}">

</head>

<body class="bodyy">

    <ul class="nav">
        <span class="nav-indicator"></span>
        <li>
            <a class="animate-bounce" href="{{ url('account') }}">
                <ion-icon name="people-circle-outline"></ion-icon>
                <span class="title">About Us</span>
            </a>
        </li>
        <li>
            <a href="{{ url('lowongan/sj_send=') }}">
                <ion-icon name="search-outline"></ion-icon>
                <span class="title">Search</span>
            </a>
        </li>
        <li>
            <a href="{{ url('') }}" class="nav-item-active">
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
            <a class="open-side">
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

    

</body>
</div>


<script>
    $(document).ready(function(){
    if($('.myframe').is(":visible")){
        $('.slider').slick({
            arrows: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            draggable: true,
            touchMove: true,
            autoplay: true,
            autoplaySpeed: 2000,
        });
    }else{
        $('.slider').slick({
            arrows: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            draggable: true,
            touchMove: true,
            autoplay: true,
            autoplaySpeed: 2000,
        });
    }
        $('.slider2').slick({
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                draggable: true,
                touchMove: true,
                autoplay: true,
                autoplaySpeed: 1000,
        });
 
            window.onscroll = function (ev) {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    window.livewire.emit('post-data');
                }
            };
    });
    var route = "{{ url('autocomplete-search') }}";
    $('#search-loc').typeahead({
        source: function (query, process) {
            var dataquery = query;
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
    $('#search-loc').on('change',function(){
        console.log($(this).val())
        $sloc_val = $(this).val()
        window.livewire.emit('dataLocation',$sloc_val)
    })


let nav = document.querySelector('.nav')

nav.querySelectorAll('li a').forEach((a, i) => {
a.onclick = (e) => {
if (a.classList.contains('nav-item-active')) return

nav.querySelectorAll('li a').forEach(el => {
    el.classList.remove('nav-item-active')
})

a.classList.add('nav-item-active')

let nav_indicator = nav.querySelector('.nav-indicator')

nav_indicator.style.left = `calc(${(i * 80) + 40}px - 45px)`
}
})


$(document).ready(function() {

$('.sel-loc').select2();

});



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
<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
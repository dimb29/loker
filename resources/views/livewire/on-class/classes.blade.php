<x-slot name="header">
    <div class="bg-white">
        <div class="hidden sm:flex max-w-7xl mx-auto">
            <img class="object-contain h-full w-full" src="{{url('storage/photos/bclass1.jpg')}}">
        </div>
        <div class="flex sm:hidden max-w-7xl mx-auto h-56">
            <img class="object-cover h-56 w-full" src="{{url('storage/photos/hp.jpg')}}">
        </div>
    </div>
</x-slot>
<x-slot name="footer">
</x-slot>
<div class="py-12 bg-yellow">
    <section class="h-64 -mt-10 block sm:hidden">
        <div class="flex sm:hidden max-w-full zind mx-auto px-4 sm:px-6 lg:px-8" id="myHeader">
            @include('livewire.search.search-class')
        </div>
    </section>
    <section class="h-20 max-w-5xl mx-auto -mt-60 hidden sm:block">
        <div class="hidden sm:flex sticky max-w-7xl mx-auto">
            @include('livewire.search.search-class')
        </div>
    </section>
    <div class="max-w-7xl mb-80 mx-auto sm:px-6 lg:px-8 pt-0 sm:pt-56">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="grid grid-flow-row grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($class as $kelas)
                    <div class="my-1 shadow-lg rounded cursor-pointer" onclick="window.location=`{{url('onclass/'.$kelas->id)}}`">
                        @foreach($kelas->images as $img)
                            @if($loop->first)
                                <img src="{{url($img->url)}}" alt="img-class" class="w-full h-20 object-cover">
                            @endif
                        @endforeach
                        <div class="py-2 px-3 font-bold">
                            {{$kelas->title}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="py-4">
            {{ $class->links() }}
        </div>
    </div>
</div>

<style>
    
.card {
  position: relative;
  height: 50vh;
  width: 200px;
  padding: 40px;
  transform-style: preserve-3d;
}

.card .title {
  position: relative;
  z-index: 2;
  transform: translateZ(20px);
}

.card .credits {
  font-size: 1.2vh;
  letter-spacing: 0.05em;
  opacity: 0.6;
  transform: translateZ(20px);
}

.card .bg {
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-size: cover;
  background-position: center;
}

</style>

<script>
    ( function( $ ) {

    "use strict";

    $(".card").tilt({
    maxTilt: 15,
    perspective: 1400,
    easing: "cubic-bezier(.03,.98,.52,.99)",
    speed: 1200,
    glare: true,
    maxGlare: 0.2,
    scale: 1.04
    });

    }( jQuery ) );
</script>

<script>

var stickyOffset = $('.sticky').offset().top;

$(window).scroll(function(){
  var sticky = $('.sticky'),
      scroll = $(window).scrollTop();
    
  if (scroll >= stickyOffset) sticky.addClass('fixeddd');
  else sticky.removeClass('fixeddd');
});

$(window).scroll(function() {

if ($(this).scrollTop()>250)
 {
    $('.a').fadeOut();
    $('.case').each(function() {
    var link = $(this).html();
    $(this).wrap('<a href="#"></a>');
    });
 }
else
 {
  $('.a').fadeIn();
 }
});


let nav = document.querySelector('.nav')

nav.querySelectorAll('li a').forEach((a, i) => {
a.onclick = (e) => {
if (a.classList.contains('nav-item-active')) return

nav.querySelectorAll('li a').forEach(el => {
    el.classList.remove('nav-item-active')
})

a.classList.add('nav-item-active')

let nav_indicator = nav.querySelector('.nav-indicator2')

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


function myFunction() {
  var copyText = document.getElementById("myInput");

  copyText.select();
  copyText.setSelectionRange(0, 99999);

  navigator.clipboard.writeText(copyText.value);
  
  alert("Tautan Berhasil Disalin");
}
</script>

<script>
window.onscroll = function() {scrollTop()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function scrollTop() {
  if (window.pageYOffset > sticky) {
    header.classList.add("fixeddd");
  } else {
    header.classList.remove("fixeddd");
  }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

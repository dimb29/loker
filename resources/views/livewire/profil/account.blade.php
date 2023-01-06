<x-slot name="header">
    <div class="bg-blue-800">
        <div class="flex w-full h-full">
            <img class="object-contain h-full w-full" src="{{url('storage/photos/bac.jpg')}}">
        </div>
    </div>
</x-slot>

<x-slot name="footer">
</x-slot>

<div class="bg-white bg-fixed shadow-xl" >
  
  <div class="flex max-w-7xl mx-auto lg:px-8 -mt-2 sm:-mt-12">
    <div class="cyanshadow w-full bg-white overflow-hidden sm:rounded-lg px-4 py-4">
      <h2 class="secondary-heading mt-2 font-semibold mx-auto">Untuk Perusahaan</h2>
      <h2 class="mt-12 text-blue-700 font-semibold text-4xl mx-auto">Mulai Pasang Iklan Lowongan Pekerjaan</h2>
      <h2 class="mt-4 text-purple-700 text-lg mx-auto">Daftarkan akun perusahaan anda dan masukan kode refferal untuk mendapatkan gratis satu lowongan iklan</h2>
      <div class="my-4">
          <a href="{{ url('employer/register') }}" class="text-base text-gray-700">
            <button data-mdb-ripple="true" data-mdb-ripple-color="light" class="w-56 inline-block py-3 bg-purple-500 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 ripple-surface-light" style="">

              Daftar Perusahaan

            </button>
          </a>
      </div>
    </div>
  </div>


  
  <div class="flex flex-row max-w-7xl mx-auto bg-white mt-72 pb-48">
    <div class="ml-2 sm:ml-8">
      <h1 class="mt-0 sm:mt-24 font-semibold text-4xl sm:text-5xl text-blue-800 text-center sm:text-left">Find your talent better <br class="d-block d-lg-none d-xl-block" />and faster</h1>
      <p class="mx-2 sm:mx-0 text-purple-700 text-4xl text-center sm:text-left mt-4">Start hiring with us!</p>
      <a href="{{ url('employer/register') }}" class="text-2xl underline text-cyan-500">

          <p class="mx-2 sm:mx-0 text-center sm:text-left">Register Here !</p>

      </a>
      <div class="flex flex-col mx-4 mt-8">
        <div class="flex flex-row mt-8">
          <div class="mt-4 pr-3 w-12">
            <i class="fa-solid fa-users text-3xl text-blue-500"></i>
          </div>
          <div>
            <p class="text-xl sm:text-2xl mt-3 ">Akses jutaan profil dan lakukan obrolan langsung dengan kandidat</p>
          </div>
        </div>
        <div class="flex flex-row mt-8">
          <div class="mt-4 pr-3 w-12">
            <i class="fa-solid fa-pager text-3xl text-blue-500"></i>
          </div>
          <div>
            <p class="text-xl sm:text-2xl mt-3">Pasang iklan lowongan anda dengan mudah dan cepat</p>
          </div>
        </div>
        <div class="flex flex-row mt-8">
          <div class="mt-4 pr-3 w-12">
            <i class="fa-solid fa-building-user text-3xl text-blue-500"></i>
          </div>
          <div>
            <p class="text-xl sm:text-2xl mt-3">Bangun tim anda di mana saja dengan beragam fitur yang kami sediakan</p>
          </div>
        </div>
      </div>  
    </div>
  </div>

</div>

<div class="flex bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
  <div class="max-w-7xl mx-auto">
    <p class="text-white text-xl sm:text-4xl max-w-3xl text-center mt-4">Hubungi kami kapan saja dan dimana saja, kami selalu ada untuk anda</p>
    <img class="object-contain mx-auto" src="{{url('storage/photos/em1.png')}}">
  </div>
</div>

<div class="bg-white">
  <div class="max-w-7xl mx-auto pt-12">
      <p class="mx-auto text-xl sm:text-5xl text-blue-700 max-w-3xl font-semibold text-center">Promo Spesial Untuk Perusahaan</p>
      <p class="mx-auto text-xl sm:text-xl max-w-3xl font-semibold text-center">Nikmati FREE 1 lowongan iklan untuk perusahaan yang memasukan kode refferal</p>
  </div>
</div>









<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<style>
.reveal {
  position: relative;
  opacity: 0;
}

.reveal.active {
  opacity: 1;
}
.active.fade-bottom {
  animation: fade-bottom 1s ease-in;
}
.active.fade-left {
  animation: fade-left 1s ease-in;
}
.active.fade-right {
  animation: fade-right 1s ease-in;
}
@keyframes fade-bottom {
  0% {
    transform: translateY(200px) scaleX(3);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}
@keyframes fade-left {
  0% {
    transform: translateX(-100px);
    opacity: 0;
  }
  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes fade-right {
  0% {
    transform: translateX(100px);
    opacity: 0;
  }
  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

</style>

<div class=" bg-white">
      <section class="py-0" id="home">
        <!-- <div class="absolute top-0 left-0 w-full h-full bg-no-repeat z-0 mt-16" style="background-image:url({{url('jobest/public/assets/img/illustrations/hero-bg.png')}});background-position:right top;background-size:contain;">
        </div> -->
        <!--/.bg-holder-->

        <!-- <div class="bg-holder d-sm-none" style="background-image:url({{url('jobest/public/assets/img/illustrations/hero-bg.png')}});background-position:right top;background-size:contain;">
        </div> -->
        <!--/.bg-holder-->

        <div class="container py-72">
          <div class="flex flex-row">
            <div class="ml-2 sm:ml-48">
              <h1 class="mt-0 sm:mt-24 font-semibold text-4xl sm:text-6xl text-blue-800 text-center sm:text-left">Find your job better <br class="d-block d-lg-none d-xl-block" />and faster</h1>
              <p class="mx-2 sm:mx-0 text-2xl text-center sm:text-left mt-4">Find your best job better and faster with KedaiKerja</p>

            </div>
          </div>
        </div>
      </section>
      <section class="py-5">
        <div class="absolute w-full h-full bg-no-repeat z-0" style="background-image:url({{url('jobest/public/assets/img/illustrations/bg.png')}});background-position:left top;background-size:initial;margin-top:-180px;">
        </div>
        <!--/.bg-holder-->

        <div class="container mx-auto reveal fade-left">
          <div class="flex flex-col sm:flex-row justify-center mx-8 sm:mx-48">
            <div class="w-full sm:w-1/2 animate__animated animate__bounceInLeft">
              <img class="img-fluid mb-4" src="{{ asset('jobest/public/assets/img/illustrations/passion.png') }}" alt="" />
            </div>
            <div class="ml-0 sm:ml-8 w-full sm:w-1/2 my-auto">
              <h6 class="text-4xl font-semibold text-blue-800 text-center sm:text-left">Find your passion and<br />achieve success</h6>
              <br>
              <p class="w-full sm:w-4/5 text-xl text-center sm:text-left"> find a job that suits your interests and talents. A high salary is not the top priority. Most importantly,You can work according to your heart's desire.</p>
            </div>
          </div>
        </div>
      </section>
      <section class="py-0">

        <div class="container mx-auto">


          <!-- ============================================-->
          <!-- <section> begin ============================-->
          <section class="py-12 sm:py-72">

            <div class="container reveal fade-right mx-auto">
              <div class="flex flex-col sm:flex-row justify-center mx-8 sm:mx-48">
                <div class="w-full sm:w-1/2 ml-0 sm:ml-38">
                  <img class="img-fluid mb-4 ml-0 sm:ml-72" src="{{ asset('jobest/public/assets/img/illustrations/jobs.png') }} " alt="" />
                </div>
                <div class="w-full sm:w-1/2 my-auto ml-0 sm:-ml-48">
                  <h6 class="w-full sm:w-4/5 text-4xl font-semibold text-blue-800 text-center sm:text-left ml-0 sm:-ml-80">Million of jobs, finds <br> the one thats rights for you</h6>
                  <p class="w-full sm:w-4/5 text-xl text-center sm:text-left ml-0 sm:-ml-80">Get your blood tests delivered at home collect a sample from the news your blood tests.</p>
                </div>
              </div>
            </div>
            <!-- end of .container-->

          </section>
          <!-- <section> close ============================-->
          <!-- ============================================-->


        </div>
        <!-- end of .container-->

      </section>
      <section class="py-12 reveal fade-bottom">
        <img class="w-100" src="{{ asset('jobest/public/assets/img/illustrations/come-on-join.png') }} " alt="" />
        <div class="container mx-auto">
          <div class="flex flex-col sm:flex-row justify-center">
            <div class="text-center">
              <h6 class="font-bold text-3xl sm:text-4xl">Come on, join with us !</h6>
              <p class="text-lg">Create an account and refer your friend </p>
            </div>
          </div>
        </div>
      </section>
</div>


<div class="banner sm:hidden flex flex-row fixed justify-center z-50 left-0 right-0 bottom-0 z-40">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylee.css') }}">

</head>

<bodyy>

    <ul class="nav">
        <span class="nav-indicator1"></span>
        <li>
            <a class="animate-bounce nav-item-active" href="{{ url('account') }}">
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

    

</bodyy>
</div>


<script>
  function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 150;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}

window.addEventListener("scroll", reveal);




let nav = document.querySelector('.nav')

nav.querySelectorAll('li a').forEach((a, i) => {
a.onclick = (e) => {
if (a.classList.contains('nav-item-active')) return

nav.querySelectorAll('li a').forEach(el => {
    el.classList.remove('nav-item-active')
})

a.classList.add('nav-item-active')

let nav_indicator = nav.querySelector('.nav-indicator1')

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
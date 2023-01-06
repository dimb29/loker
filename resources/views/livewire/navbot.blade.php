
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Animated bottom navbar
    </title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylee.css') }}">

</head>

<body>

    <ul class="nav">
        <span class="nav-indicator"></span>
        <li>
            <a href="#">
                <i class='bx bx-home'></i>
                <span class="title">Home</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-receipt'></i>
                <span class="title">Receipt</span>
            </a>
        </li>
        <li>
            <a href="#" class="nav-item-active">
                <i class='bx bx-plus-circle'></i>
                <span class="title">Add</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-bell'></i>
                <span class="title">Noti</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-user'></i>
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

    
  <script>
    let nav = document.querySelector('.nav')

        nav.querySelectorAll('li a').forEach((a, i) => {
        a.onclick = (e) => {
        if (a.classList.contains('nav-item-active')) return

        nav.querySelectorAll('li a').forEach(el => {
            el.classList.remove('nav-item-active')
        })

        a.classList.add('nav-item-active')

        let nav_indicator = nav.querySelector('.nav-indicator')

        nav_indicator.style.left = `calc(${(i * 120) + 60}px - 45px)`
    }
})
  </script>
</body>
</html>
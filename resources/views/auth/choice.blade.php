<head>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/split.css') }}">
<title>Kedai Kerja</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

:root {
    --left-bg-color: rgb(87 84 236 / 26%);
    --right-bg-color: rgb(43 43 43 / 43%);
    --left-btn-hover-color: rgba(87,84, 236, 1);
    --right-btn-hover-color: #a01cf2;
    --hover-width: 75%;
    --other-width: 25%;
    --speed: 1000ms;

}
* {
    box-sizing: border-box;
}

body {
    font-family: 'Roboto', sans-serif;
    height: 100vh;
    overflow: hidden;
    margin: 0;
}

h1 {
    font-size: 4rem;
    color: #fff;
    position: absolute;
    left: 50%;
    top: 33%;
    transform: translateX(-50%);
    white-space: nowrap;
}

.btn {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    left: 50%;
    top: 50%;
    transform: translateX(-50%);
    text-decoration: none;
    color: #fff;
    border: #fff solid .2rem;
    font-size: 1rem;
    font-weight: bold;
    text-transform: uppercase;
    width: 15rem;
    padding: 1.5rem;
}

.split.left .btn:hover {
    background-color: var(--left-btn-hover-color);
    border-color: var(--left-btn-hover-color);
}

.split.right .btn:hover {
    background-color: var(--right-btn-hover-color);
    border-color: var(--right-btn-hover-color);
}

.container {
    position: relative;
    width: 100%;
    height: 100%;
    background: #333;
}

.split {
    position: absolute;
    width: 50%;
    height: 100%;
    overflow: hidden;
}

.split.left {
    left: 0;
    background: url('https://kedker.com/storage/photos/lusers4.jpg');
    background-repeat: no-repeat;
    background-size: cover;
}

.split.left::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: var(--left-bg-color);
}

.split.right {
    right: 0;
    background:url('https://kedker.com/storage/photos/lemployers2.jpg');
    background-repeat: no-repeat;
    background-size: cover;
}

.split.right::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: var(--right-bg-color);
}

.split.right, 
.split.left, 
.split.right::before,
.split.left::before  {
    transition: all var(--speed) ease-in-out;
}

.hover-left .left {
    width: var(--hover-width);
}

.hover-left .right {
    width: var(--other-width);
}

.hover-right .right {
    width: var(--hover-width);
}

.hover-right .left {
    width: var(--other-width);
}

@media (max-width: 800px) {
    h1 {
        font-size: 1.5rem;
        top: 37%;
    }

    .btn {
        top: 43%;
        padding: 1rem;
        width: 10rem;
        
    }

    .split.left {
        left: 0;
        background: url('https://kedker.com/storage/photos/lusersmob2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .split.left::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: transparent;
    }

    .split.right {
        right: 0;
        background:url('https://kedker.com/storage/photos/lemployersmob2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .split.right::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: transparent;
    }
}
</style>

    <div class="container">
        <div class="split left">
            <h1>Login Users</h1>
            <a href="{{ url('/login') }}" class="btn">Log In</a>
        </div>
        <div class="split right">
            <h1>Login Employers</h1>
            <a href="{{ url('employer/login') }}" class="btn">Log In</a>
        </div>
    </div>

    <script>
        const left = document.querySelector('.left')
        const right = document.querySelector('.right')
        const container = document.querySelector('.container')

        left.addEventListener('mouseenter', () => container.classList.add('hover-left'))
        left.addEventListener('mouseleave', () => container.classList.remove('hover-left'))

        right.addEventListener('mouseenter', () => container.classList.add('hover-right'))
        right.addEventListener('mouseleave', () => container.classList.remove('hover-right'))
    </script>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> 
<body>

<!--navbar-->
<header>
    <a href="#" class="logo"><img src="{{ asset('images/logo.png') }}" alt=""></a>
</header>
<!--home-->
<section class="home" id="home">
    <div class="home-text">
        <span>Welcome To</span>
        <h1>Access by KAI</h1>
       
        <a href="{{ route('login') }}" class="btn">Login Now</a>
    </div>
    <div class="home-img">
        <img src="{{ asset('images/home1.png') }}">
    </div>
</section>

<!--Delivery-->
<!-- <section class="delivery" id="delivery">
    <div class="heading">
        <span>Get Now</span>
        <h1>Order With Uber Eats</h1>
    </div>
    <div class="container">
        <div class="delivery-img">
            <img src="{{ asset('images/uber.jpeg') }}" alt="">
        </div>
        <div class="delivery-text">
            <h2>Today deserve delivery</h2>
            <p>lorem</p>
            <p>lorem</p>
           
        </div>
    </div>
</section> -->

<!-app-->
<section class="app" id="app">
    <div class="heading">
        <span> Our App</span>
        <h1>Download App</h1>
    </div>
    <div class="container">

        <div class="app-text">
            <h2>Fall into an easier routine</h2>
            <p>lorem</p>
            <p>lorem</p>
           
        </div>
        <div class="app-img">
            <img src="{{ asset('images/utama1.jpeg') }}" alt="">
        </div>
    </div>
</section>
<!--About-->
<section class="about" id="about">
    <div class="about-img">
        <img src="{{ asset('images/utama2.jpeg') }}" alt="">
    </div>
    <div class="about-text">
            <h2>50 years of serving communities</h2>
            <p>lorem</p>
            <p>lorem</p>
            <br>
           
        </div>
</section>
<!--contact-->
<section class="contact" id="contact">
    <div class="social">
        <a href="#"><i class='bx bxl-facebook'></i></a>
        <a href="#"><i class='bx bxl-twitter'></i></a>
        <a href="#"><i class='bx bxl-instagram'></i></a>
        <a href="#"><i class='bx bxl-youtube' ></i></a>
    </div>
    <div class="links">
        <a href="#">Privacy</a>
        <a href="#">Terms of use</a>
        <a href="#">our company</a>
    </div>
    <p>
        <small>© <span id="year"></span> - All Rights Reserved</small>
    </p>
</section>


<script src="{{ asset('js/home1.js') }}"></script>
</body>
</html>

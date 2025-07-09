<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}else {
    $user_id = '';
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    

<?php include 'components/user_header.php';?>

<!--about start-->

    <section class="about">

        <div class="row">

            <div class="image">

               <img src="images/about-img.svg" alt="">

            </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>Welcome to <strong>ElectroCart</strong> - your one-stop shop for the latest and greatest in technology. From powerful laptops and sleek smartphones to home essentials like refrigerators and smart gadgets, we bring you a wide range of high-quality electronics at unbeatable prices.</p>
                <p>Our mission is simple: to make cutting-edge technology accessible, reliable, and affordable for everyone. Whether you're upgrading your workspace, enhancing your home, or shopping for the perfect gift, we’ve got you covered with products from top brands and emerging innovators.</p>
                <p>We pride ourselves on fast shipping, secure shopping, and customer support that actually supports. At ElectroCart, technology meets trust.</p>
                
                <p class="tagline">Join the future — shop smarter with ElectroCart.</p>
                <a href="contact.php" class="btn">contact us</a>
            </div>

        </div>

    </section>

<!--reviews start-->


<section class="reviews">

    <h1 class="heading">clients's reviews</h1>

    <div class="swiper reviews-slider">

     <div class="swiper-wrapper">

    <div class="swiper-slide slide">

        <img src="images/pic-1.png" alt="">
        <p>Excellent service and fast delivery. Got my laptop within 2 days and it works flawlessly!</p>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <h3> Jason K.</h3>
    </div>

    <div class="swiper-slide slide">

        <img src="images/pic-2.png" alt="">
        <p>I was amazed at the price I got for a high-end fridge. Super easy checkout and delivery was on time.</p>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <h3> Sarah M.</h3>
    </div>

    <div class="swiper-slide slide">

        <img src="images/pic-3.png" alt="">
        <p>I’ve ordered twice now — both times my products arrived early and in perfect condition. Highly recommend!</p>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <h3> Mohammed A..</h3>
    </div>

    <div class="swiper-slide slide">

        <img src="images/pic-4.png" alt="">
        <p>Customer support is top-notch. They helped me pick the right phone and answered all my questions patiently.</p>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <h3> Priya D.</h3>
    </div>

    <div class="swiper-slide slide">

        <img src="images/pic-5.png" alt="">
        <p>Got a smart TV and sound system combo — amazing quality! Love the tech and the price.</p>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <h3> David S.</h3>
    </div>

    <div class="swiper-slide slide">

        <img src="images/pic-6.png" alt="">
        <p>The site is easy to navigate, and the deals are better than anywhere else. Will shop again soon.</p>
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <h3>  Lena R.</h3>
    </div>

     </div>

     <div class="swiper-pagination"></div>

    </div>

</section>













<?php include 'components/footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!--custom js-->
<script src="js/script.js"></script>


<script>

var swiper = new Swiper(".reviews-slider", {
    loop:true,
    grabCursor:true,
        spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        550: {
            slidesPerView: 2,
        },
        768: {
        slidesPerView: 2,
        },
        1024: {
        slidesPerView: 3,
        },
    },
    });

</script>


</body>
</html>
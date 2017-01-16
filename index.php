<!--Page Meta - Constantine -->
<!--TITLE Constant is being used for the header <title> tag and also for the 'mobileTitle'  mobile version of class which echoes TITLE-->

<?php define('TITLE', 'Welcome!'); ?>
<!-- Page Meta - Constantine -->
<?php include('includes/header.php'); ?>


    <div class="box">
        <div class="row">
        <div class="col-lg-12 text-center">
            <div id="carousel-example-generic" class="carousel slide">
                <!-- Indicators -->
                <ol class="carousel-indicators hidden-xs">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="img-responsive img-full" src="img/slide-1.jpg" alt="California Spicy BBQ Chicken Wings">
                        <!-- Image Reference: http://www.freepik.com/free-photo/delicious-chicken-wings-with-tomato-sauce_972406.htm -->
                        <!-- Designed by Freepik -->
                    </div>
                    <div class="item">
                        <img class="img-responsive img-full" src="img/slide-2.jpg" alt="Cowboy's Buffalo EXTREME Chops">
                        <!-- Image Reference: http://www.freepik.com/free-photo/hamburger-on-a-wooden-board-with-french-fries_999778.htm -->
                        <!-- Designed by Freepik -->
                    </div>
                    <div class="item">
                        <img class="img-responsive img-full" src="img/slide-3.jpg" alt="Don't make WAR, make BURGER">
                        <!-- Image Reference: http://www.freepik.com/free-photo/juicy-meat-with-vegetables_910064.htm -->
                        <!-- Designed by Freepik -->
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="icon-next"></span>
                </a>
            </div>
            <div class="col-md-12">
                <h2 class="brand-before">
                    <small>Welcome to</small>
                </h2>
                <h1 class="brand-name">Felipetakia</h1>
                <hr class="tagline-divider"><p></p>
                <p> After the successful operation of the <strong>Felipe Coffe House</strong> and the <strong>Felipe Logistics Company</strong>
                    our Group decided to expand even more and open three Unique Restaurants! 
                    <strong>PapaFelipe</strong>, <strong>FelipeBeer</strong> the present one <strong>Felipetakia</strong>!</p>
                <p>Serving the <strong>highest quality</strong> and fresh food from all over the World, <strong>Felipetakia</strong>
                    is specialized gastronomy of Meat Dishes.</p>
                <p>Some people call our dishes <strong>ART</strong>.<br>We call them the 
                    <strong>Tradition of the near future!</strong></p>
                <p> We are confident of our services and food choices, that we have equipped our
                    staff with <strong> America's 3 of the top 20 Meat Chefs! </strong> along with highly trained staff from waiters to IT Facilities!</p>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>


<!-- Script to Activate the Carousel -->
<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>

</body>

</html>

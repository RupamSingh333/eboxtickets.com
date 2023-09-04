<!-------------------calculator---------------------------- -->


<div id="calculator">
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-sm-7 col-12">
                <div class="counting">
                    <h1>Calculate Your Fees</h1>
                    <p>Ticket Price</p>

                    <div class="range-slider">
                        <input class="range-slider__range" type="range" value="100" min="0" max="500">
                        <span class="range-slider__value">100</span>
                    </div>

                    <form class="row g-3 mt-1">

                        <div class="col-md-4 col-sm-4 col-4 rang_f">
                            <label for="inputCity" class="form-label">Customer Pays</label>
                            <input type="text" class="form-control" id="customerpays" placeholder="$ 107">
                        </div>
                        <div class="col-md-4 col-sm-4 col-4 rang_f">
                            <label for="inputZip" class="form-label">You Receive</label>
                            <input type="text" class="form-control" id="youreceive" placeholder="$ 100">
                        </div>
                        <div class="col-md-4 col-sm-4 col-4 rang_f">
                            <label for="inputZip" class="form-label">Our Cost</label>
                            <input type="text" class="form-control" id="ourcost" placeholder="<?php echo $admin_info['feeassignment']; ?>%">
                        </div>
                        <!-- <div class="col-12">
                                <a type="submit" class="btn site_b">Close</a>
                            </div> -->

                    </form>

                    <!-- =====================calculator============================= -->
                    <script>
                        // First let's set the colors of our sliders
                        const settings = {
                            fill: '#1abc9c',
                            background: '#d7dcdf'
                        }

                        // First find all our sliders
                        const sliders = document.querySelectorAll('.range-slider');
                        Array.prototype.forEach.call(sliders, (slider) => {
                            slider.querySelector('input').addEventListener('input', (event) => {
                                // 1. apply our value to the span
                                slider.querySelector('span').innerHTML = event.target.value;
                                // 2. apply our fill to the input
                                applyFill(event.target);
                            });
                            // Don't wait for the listener, apply it now!
                            applyFill(slider.querySelector('input'));
                        });

                        function applyFill(slider) {
                            const percentage = 100 * (slider.value - slider.min) / (slider.max - slider.min);

                            // $('#customerpays').val("$ " + slider.value);
                            // var sliderper = slider.value * 7 / 100;
                            // var sliderper_value = slider.value - sliderper;
                            // $('#youreceive').val("$ " + sliderper_value);
                            var fees = <?php echo $admin_info['feeassignment']; ?>;
                            var sliderper = slider.value * fees / 100;
                            var customerpaystotal = parseInt(slider.value) + sliderper;
                            var youreceive = customerpaystotal - sliderper;
                            $('#customerpays').val("$ " + customerpaystotal);
                            $('#youreceive').val("$ " + youreceive);

                            const bg = `linear-gradient(90deg, ${settings.fill} ${percentage}%, ${settings.background} ${percentage+0.1}%)`;
                            slider.style.background = bg;
                        }
                    </script>



                </div>
            </div>
            <div class="col-md-4 col-sm-5 col-12">
                <div class="container_img">
                    <img src="<?php echo SITE_URL; ?>images/Calculate_Fees_img.png"></a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-------------------App---------------------------- -->

<?php $adminsetting = $this->Comman->admindetail();  ?>
<?php  ?>
<div id="down_app">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-6">
                <div class="counting">
                    <h1>Download on any Device</h1>
                    <!-- <p>eboxTICKETS App now available on your android devices</p> -->
                    <p>Our mobile event app is available to download on any iOS or Android device via the app store.</p>
                    <!-- <a href="">DOWNLOAD NOW</a> -->
                    <div class="down_icon">
                        <a href="<?php echo $adminsetting['googleplaystore']; ?>"><img src="<?php echo SITE_URL; ?>images/play_stor.png"></a>
                        <a href="<?php echo $adminsetting['applestore']; ?>"><img src="<?php echo SITE_URL; ?>images/app_stor.png"></a>

                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="app_img">
                    <img src="<?php echo SITE_URL; ?>images/app-screen.png">
                </div>

            </div>
        </div>
    </div>
</div>
<?php  ?>

<!-- ---------------------------footer------------------------------ -->

<footer>

    <div class="container">
        <a href="./index.html"><img class="f_logo" src="<?php echo SITE_URL; ?>images/Logo.png"></a>
        <p class="footer_p">eboxtickets is a hyper-efficient, massively scalable and defensibly secure online event and ticket management solution.</p>

        <div class="social">

            <ul class="list-inline social_ul">
                <li class="list-inline-item">
                    <a href="<?php echo $adminsetting['fburl']; ?>" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="<?php echo $adminsetting['Twitterurl']; ?>" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>



                <li class="list-inline-item">
                    <a href="<?php echo $adminsetting['googleplusurl']; ?>" target="_blank">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                </li>



                <li class="list-inline-item">
                    <a href="<?php echo $adminsetting['linkdinurl']; ?>" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </li>


            </ul>
        </div>

        <div class="copyright_dv">

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-copyR">
                        <p> Copyright <?php echo date('Y'); ?> <a href="<?php echo SITE_URL; ?>">eboxtickets.com</a>- All Rights Reserved</p>
                        <hr>

                    </div>
                    <div class="col-md-12 col-sm-12 text-policy">
                        <ul class="d-flex justify-content-center">
                            <li><a class="polic-link" href="<?php echo SITE_URL; ?>pages/terms-and-conditions">Terms of Use Policy</a></li>
                            <li><a class="polic-link" href="<?php echo SITE_URL; ?>pages/refund">Refund Policy</a></li>
                            <li><a class="polic-link" href="<?php echo SITE_URL; ?>pages/privacy-policy">Privacy Policy</a></li>
                            <li><a class="polic-link" href="<?php echo SITE_URL; ?>pages/delivery-policy">Delivery Policy</a></li>
                            <li><a class="polic-link" href="<?php echo SITE_URL; ?>pages/branding">Branding</a></li>
                            <li><a class="polic-link" href="<?php echo SITE_URL; ?>pages/cookie-policy">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>


            </div>

        </div>
    </div>
</footer>


<!-- ---------------------------footer------------------------------------------- -->

<!-- <script src="https://code.jquery.com/jquery-2.1.4.js"></script> -->
<!-- <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo SITE_URL; ?>js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL; ?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL; ?>js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL; ?>js/wow.min.js" type="text/javascript"></script>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>


<script>
    $('.slider_owl').owlCarousel({
        loop: false,
        autoplayTimeout: 5000,
        smartSpeed: 3000,
        responsiveClass: true,
        // autoplay: true,
        nav: false,
        dots: false,
        items: 1,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 1,
                nav: false,
                loop: true
            }
        }
    })
</script>

</body>

</html>
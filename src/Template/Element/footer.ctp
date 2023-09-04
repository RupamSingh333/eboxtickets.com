    <!-- ---------------------------footer------------------------------ -->
    <?php $adminsetting = $this->Comman->admindetail();  ?>

    <footer>

        <div class="container">
            <a href="<?php echo SITE_URL; ?>"><img class="f_logo" src="<?php echo SITE_URL; ?>images/Logo.png"></a>
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

    <script src="<?php echo SITE_URL; ?>js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.js"></script>
    <script src="<?php echo SITE_URL; ?>js/bootstrap.min.js" type="text/javascript"></script>

    <script src="<?php echo SITE_URL; ?>js/creditCardvalidater.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL; ?>js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL; ?>js/wow.min.js" type="text/javascript"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
    <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Compose message...',
                height: 250,
                width: '100%',
                fontSize: '10',
                followingToolbar: false,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'hr']]
                ],
                callbacks: {
                    onPaste: function(e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
            var slugify = function(text) {
                return text.toString()
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                    .replace(/\-\-+/g, '-') // Replace multiple - with single -
                    .replace(/^-+/, '') // Trim - from start of text
                    .replace(/-+$/, ''); // Trim - from end of text
            }
            $('.slug').on('keyup', function(e) {
                text = $(e.target).val();

                if (text) {
                    $('.slug-display').empty().append(slugify(text));
                } else {
                    $('.slug-display').empty().append('270402');
                }
            }).on('blur', function(e) {
                $(e.target).val(slugify(e.target.value));
            });
        });
    </script>


    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

    <script>
        $(document).ready(function() {
            $(".side_menu_icon").click(function() {
                $(".sidebar").toggleClass("closetab");
            });
        });
    </script>

    <!-- <script>
        $('.slider_owl').owlCarousel({
            loop: true,
            autoplayTimeout: 5000,
            smartSpeed: 3000,
            responsiveClass: true,
            autoplay: true,
            nav: false,
            dots: false,
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
    </script> -->
    <!-- =====================calculator============================= -->
    <script>
        // I've added annotations to make this easier to follow along at home. Good luck learning and check out my other pens if you found this useful


        // First let's set the colors of our sliders
        const settings = {
            fill: '#1abc9c',
            background: '#d7dcdf'
        }

        // First find all our sliders
        const sliders = document.querySelectorAll('.range-slider');

        // Iterate through that list of sliders
        // ... this call goes through our array of sliders [slider1,slider2,slider3] and inserts them one-by-one into the code block below with the variable name (slider). We can then access each of wthem by calling slider
        Array.prototype.forEach.call(sliders, (slider) => {
            // Look inside our slider for our input add an event listener
            //   ... the input inside addEventListener() is looking for the input action, we could change it to something like change
            slider.querySelector('input').addEventListener('input', (event) => {
                // 1. apply our value to the span
                slider.querySelector('span').innerHTML = event.target.value;
                // 2. apply our fill to the input
                applyFill(event.target);
            });
            // Don't wait for the listener, apply it now!
            applyFill(slider.querySelector('input'));
        });

        // This function applies the fill to our sliders by using a linear gradient background
        function applyFill(slider) {
            // Let's turn our value into a percentage to figure out how far it is in between the min and max of our input
            const percentage = 100 * (slider.value - slider.min) / (slider.max - slider.min);
            // now we'll create a linear gradient that separates at the above point
            // Our background color will change here
            const bg = `linear-gradient(90deg, ${settings.fill} ${percentage}%, ${settings.background} ${percentage+0.1}%)`;
            slider.style.background = bg;
        }
    </script>



    </body>

    </html>
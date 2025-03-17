<!--Footer Start-->
<footer class="footer-style-1 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!--Social-->
            <div class="col-md-6">
                <div class="footer-social">
                    <ul class="list-unstyled">
                        <li><a class="wow fadeInUp" href="{{ isset($contact->value['facebook']) ? $contact->value['facebook'] : ''  }}"><i aria-hidden="true"
                                                                                  class="fab fa-facebook-f"></i></a></li>
                        <li><a class="wow fadeInDown" href="{{ isset($contact->value['email']) ? $contact->value['linkedin'] : ''  }}"><i aria-hidden="true"
                                                                                    class="fab fa-linkedin-in"></i></a></li>
                        <li><a class="wow fadeInUp" href="{{ isset($contact->value['email']) ? $contact->value['instagram'] : ''  }}"><i aria-hidden="true"
                                                                                  class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <!--Text-->
            <div class="col-md-6 text-md-right">
                <p class="company-about fadeIn">&copy; 2023 PT. ABADILESTARI CELEBES BAHARI<a href="javascript:void(0);"></a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!--Footer End-->

<!--Animated Cursor-->
<div id="aimated-cursor">
    <div id="cursor">
        <div id="cursor-loader"></div>
    </div>
</div>
<!--Animated Cursor End-->

<!--Scroll Top Start-->
<span class="scroll-top-arrow"><i class="fas fa-angle-up"></i></span>

<script src="{{ url('frontend/js/bundle.min.js') }}"></script>
<!-- Plugin Js -->
<script src="{{ url('frontend/js/jquery.appear.js') }}"></script>
<script src="{{ url('frontend/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ url('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('frontend/js/swiper.min.js') }}"></script>
<script src="{{ url('frontend/js/morphext.min.js') }}"></script>
<script src="{{ url('frontend/js/TweenMax.min.js') }}"></script>
<script src="{{ url('frontend/js/wow.min.js') }}"></script>
<script src="{{ url('frontend/js/jquery.cubeportfolio.min.js') }}"></script>
<!-- REVOLUTION JS FILES -->
<script src="{{ url('frontend/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ url('frontend/js/jquery.themepunch.revolution.min.js') }}"></script>
<!-- SLIDER REVOLUTION EXTENSIONS -->
<script src="{{ url('frontend/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ url('frontend/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ url('frontend/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ url('frontend/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ url('frontend/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ url('frontend/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ url('frontend/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ url('frontend/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ url('frontend/js/extensions/revolution.extension.video.min.js') }}"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJRG4KqGVNvAPY4UcVDLcLNXMXk2ktNfY"></script>
<script src="{{ url('frontend/agency/js/map.js') }}"></script>
<!-- custom script -->
<script src="{{ url('frontend/js/contact_us.js') }}"></script>
<script src="{{ url('frontend/agency/js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(Session::get('send'))
<script>
    $( document ).ready(function() {
        Swal.fire(
            'Successfully!',
            'Your message has been sent',
            'success'
            )
    });
</script>
@endif
@extends('layouts.app')

@section('content')
  
      <!--Slider Start-->
      <section class="p-0 no-transition cursor-light" id="home">
        <!-- Swiper -->
        <div class="swiper-container banner-container">
          <ul class="swiper-wrapper">
            <div class="swiper-slide align-items-center banner-item" style="background-image: url('{{ isset($about->banner) ? $about->banner : '' }}'); background-size: cover">
              <div class="layer-black"></div>
              <div class="container position-relative">
                <p class="text-white h1 text-banner">ABOUT US</p>
              </div>
            </div>
          </ul>
        </div>
      </section>
      <!--Slider End-->
      <!-- content -->
  
      <section class="pb-0" id="about-us">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 wow fadeInLeft">
              <div class="heading-area">
                <h2 class="title">Visi</h2>
                <p class="para">{!! isset($about->visi) ? $about->visi : '' !!}</p>
              </div>
            </div>
            <div class="col-lg-6 wow fadeInLeft">
              <div class="heading-area">
                <h2 class="title">Misi</h2>
                <ul>
                  {!! isset($about->misi) ? $about->misi : '' !!}
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <img src="{{ isset($about->image) ? $about->image : '' }}" class="w-100 rounded" />
            </div>
          </div>
        </div>
      </section>
@endsection

@section('script')
<script>
    var swiper = new Swiper("#ut", {
      slidesPerView: "auto",
      paginationClickable: true,
      spaceBetween: 0,
      loop: true,
      slidesPerView: 3,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      autoplay: {
        delay: 4500,
        disableOnInteraction: false,
      },
    });

    $(document).ready(function () {
      $("#ut").lightGallery({
        selector: ".banner-item-sm",
        download: false,
        thumbnail: false,
      });
    });
  </script>
@endsection
  
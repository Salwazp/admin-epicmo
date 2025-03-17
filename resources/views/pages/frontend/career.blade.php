@extends('layouts.app')

@section('content')

    <!--Slider Start-->
    <section class="p-0 no-transition cursor-light" id="home">
        <!-- Swiper -->
        <div class="swiper-container banner-container">
          <ul class="swiper-wrapper">
            <div class="swiper-slide align-items-center banner-item" style="background-image: url('{{ $banner->image }}'); background-size: cover">
              <div class="layer-black"></div>
              <div class="container position-relative">
                <p class="text-white h1 text-banner">{{ $banner->title }}</p>
              </div>
            </div>
          </ul>
        </div>
      </section>
      <!--Slider End-->
      <!-- content -->
  
      <div class="container mt-5 mb-5">
        <div class="mb-3">
          <h3 class="font-weight-bold">INFO REQUIRMENT</h3>
        </div>
        <div class="row mb-4">
          <!--News Item-->
          @foreach ($career as $data)    
          <div class="col-lg-6">
            <div class="news-item shadow-sm">
              <img alt="image" class="news-img" src="{{ $data->image }}" />
              <div class="news-text-box">
                <span class="date main-color">{{ $data->date }}</span>
                <a href="#"><h4 class="news-title">{{ $data->title }}</h4></a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
  
        <div class="mt-2">
          <div class="text-muted text-center">Follow</div>
          <div class="d-flex justify-content-center mt-2">
            <a href="{{ $contact->value['instagram'] }}"><button class="btn btn-primary mr-2"><i class="fab fa-instagram"></i> instragram</button></a>
            <a href="{{ $contact->value['linkedin'] }}"> <button class="btn btn-primary"><i class="fab fa-linkedin"></i> linkedin</button></a>
          </div>
        </div>
      </div>

@endsection
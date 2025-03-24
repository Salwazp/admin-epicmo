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

<section class="container">
  <table class="table">
    <tr>
      <th>Vessel Name</th>
      <th>Photo</th>
      <th>Year Built</th>
      <th>Vessel Type</th>
      <th>Capacity / Bollard Pull</th>
    </tr>
    @foreach ($banner->spesifikasi as $item)
    <tr>
      <td>{{ $item->vessel_name }}</td>
      <td>
        <a class="text-primary" href="{{ $item->image }}"><u>Photo</u></a>
      </td>
      <td>{{ $item->year_built }}</td>
      <td>{{ $item->vessel_type }}</td>
      <td>{{ $item->capacity }}</td>
    </tr>
    @endforeach
  </table>
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
</script>
@endsection
  
@extends('layouts.app')

@section('content')

<!--Slider Start-->
<section class="p-0 no-transition cursor-light" id="home">
    <!-- Swiper -->
    <div class="swiper-container">
        <ul class="swiper-wrapper">
            @foreach ($banner as $data) 
            @if ($data->with_desc == 1)        
            <div class="swiper-slide banner-item" style="background-image: url('{{ $data->image }}');background-size: cover;">
                <div class="layer-black"></div>
                <div class="d-block mb-5 ml-5 position-relative"><p class="text-white h1">{{ $data->title }}</p>
                    <div class="font-weight-bold w-95 font-size-22 mt-3">
                        <p>{!! $data->deskripsi !!}</p>
                        <a href="{{ route('spesifikasi', ['banner' => $data->id, 'slug' => str_replace(' ', '-', $data->title)]) }}" class="btn btn-primary rounded">Detail</a>
                    </div>
                </div>
            </div>
            @else
            <div class="swiper-slide banner-item" style="background-image: url('{{ $data->image }}');background-size: cover;">
                <div class="layer-black"></div>
                <div class="d-block mb-5 ml-5 position-relative"><p class="text-white h1">{{ $data->title }}</p>
                </div>
            </div>
            @endif          
            @endforeach
        </ul>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>
<!--Slider End-->

<!--About Us-->
<section class="pb-0" id="about-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 wow fadeInLeft">
                <div class="heading-area">
                    <span class="sub-title">About Us
                    </span>
                    <h2 class="title">{{ $about->title }} <span class="alt-color js-rotating">{{ $about->text_highlight[0] }}, {{ $about->text_highlight[1] }}</span></h2>
                    <p class="para text">
                        {!! $about->deskripsi !!}
                    </p>
                    <a class="btn btn-large btn-rounded btn-pink btn-hvr-blue mt-3" href="/about">
                        {{ $about->text_button }}
                        <div class="btn-hvr-setting">
                            <ul class="btn-hvr-setting-inner">
                                <li class="btn-hvr-effect"></li>
                                <li class="btn-hvr-effect"></li>
                                <li class="btn-hvr-effect"></li>
                                <li class="btn-hvr-effect"></li>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight">
                <div class="about-image mt-5 pt-4 mt-lg-0 pt-lg-0" style="background-image: url('{{ $about->image }}');"></div>
            </div>
        </div>
    </div>
</section>
<!--About Us End-->

<!--Parallax Start-->
<div class="mt-4">
    <div class="d-block mb-4 py-4 section-marquee">
        <div class="marquee">
            <ul class="marquee__content">
                @forelse ($runningimage as $data)
                    <li>
                        <h5>{{ $data->title }}</h5> <!-- Menampilkan Title -->
                        <img src="{{ $data->image }}" class="image-marquee" />
                    </li>
                @empty
                    <li>No data available</li> <!-- Jika tidak ada data -->
                @endforelse
            </ul>
            <ul class="marquee__content">
                @forelse ($runningimage as $data)
                    <li>
                        <h5>{{ $data->title }}</h5>
                        <img src="{{ $data->image }}" class="image-marquee" />
                    </li>
                @empty
                    <li>No data available</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!--Parallax End-->
<!--Blog Start-->
<section id="blog">
    <div class="container">
        <!--Row-->
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="heading-area mx-570 pb-lg-5 mb-5">
                    <span class="sub-title">{{ $gallery->subtitle }}</span>
                    <h2 class="title mb-0">Our <span class="alt-color js-rotating">{{ $gallery->text_highlight[0] }}, {{ $gallery->text_highlight[1] }}</span> 
                    {{ $gallery->title }}</h2>
                </div>
            </div>
        </div>
        <!--Row-->
        <div class="row wow fadeIn">
            <div class="col-md-12">
                <!--Portfolio Items-->
                <div class="cbp cbp-l-grid-mosaic-flat" id="js-grid-mosaic-flat">
                    @foreach ($gallery_image as $data)             
                    <div class="cbp-item web-design graphic">
                        <a class="cbp-caption cbp-lightbox" href="{{ $data->image }}">
                            <div class="cbp-caption-defaultWrap">
                                <img alt="port-8" src="{{ $data->image }}">
                            </div>
                            <div class="cbp-caption-activeWrap"></div>
                            <div class="cbp-l-caption-alignCenter center-block">
                                <div class="cbp-l-caption-body">
                                    <div class="plus"></div>
                                    <h5 class="text-white mb-1">Latest Work</h5>
                                    <p class="text-white">See Our Amazing Work</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div id="pagination-result">
                    {{ $gallery_image->links('vendor.pagination.bootstrap-4') }}
                </div>
                <nav>
                    <ul class="pagination" id="pagination">

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<!--Blog End-->

<section class="bg-light" id="why">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 wow fadeInRight">
                <div>
                    <div class="image-absolute image-1" style="background-image: url('{{ $why->image['image1'] }}');"></div>
                    <div class="image-absolute image-2" style="background-image: url('{{ $why->image['image2'] }}');"></div>
                    <div class="image-absolute image-3" style="background-image: url('{{ $why->image['image3'] }}');"></div>
                </div>
            </div>
            <div class="col-lg-5 wow fadeInLeft">
                <div class="heading-area justify">
                    <h2 class="title">{{ $why->title }}</h2>
                    <div class="mb-3 mt-5">
                        <h4>{{ $why->value['subtitle1'] }}</h4>
                        <p>
                            {!! $why->value['deskripsi1'] !!}
                        </p>
                    </div>
                    <div class="mb-3">
                        <h4>{{ $why->value['subtitle2'] }}</h4>
                        <p>
                            {!! $why->value['deskripsi2'] !!}
                        </p>
                    </div>
                    <div class="mb-3">
                        <h4>{{ $why->value['subtitle3'] }}</h4>
                        <p>
                            {!! $why->value['deskripsi3'] !!}
                        </p>
                    </div>
                    <div class="mb-3">
                        <h4>{{ $why->value['subtitle4'] }}</h4>
                        <p>
                            {!! $why->value['deskripsi4'] !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Contact Start-->
<section class="contact-us" id="contact">

    <div class="container">

        <div class="full-map">
            <div class="maps">
                <iframe src="{{ isset($contact->value['maps']) ? $contact->value['maps'] : '' }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div class="row align-items-top">

            <div class="col-lg-5 order-lg-2 wow fadeInRight">
                <div class="contact-detail">
                    <div class="contact-dots" data-dots=""></div>
                    <!--Heading-->
                    <div class="heading-area pb-5">
                        <h2 class="title mt-0 pb-1">Our Location</h2>
                    </div>

                    <!--Address-->
                    <ul class="address list-unstyled">
                        <li>
                            <span class="address-icon gradient-text2"><i aria-hidden="true"
                                                                         class="fas fa-map-marker-alt"></i></span>
                            <span class="address-text">{!! isset($contact->value['lokasi']) ? $contact->value['lokasi'] : ''  !!}</span>
                        </li>
                        <li>
                            <span class="address-icon gradient-text2"><i aria-hidden="true"
                                                                         class="fas fa-phone-volume"></i></span>
                            <span class="address-text"><a class="mr-3" href="javascript:void(0)">{{ isset($contact->value['nomer_telepon']) ? $contact->value['nomer_telepon'] : ''  }}</a>
                                <!-- <a href="javascript:void(0)">(021) 7705737</a> -->
                            </span>
                        </li>
                        <li>
                            <span class="address-icon gradient-text2"><i aria-hidden="true"
                                                                         class="fas fa-paper-plane"></i></span>
                            <span class="address-text">
                                <!-- <a class="mr-3 alt-color" href="javascript:void(0)">email@website.com</a> -->
                                <a class="mr-3 alt-color" href="javascript:void(0)">{{ isset($contact->value['email']) ? $contact->value['email'] : ''  }}</a></span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-7 mt-4 pt-3 mt-lg-0 pt-lg-0 wow fadeInLeft">
                <!--Heading-->
                <div class="heading-area pb-2">
                    <h2 class="title mt-0">Get In Touch</h2>
                </div>
                <!--Contact Form-->
                <form action="{{ route('store') }}" class="contact-form" id="contact-form-data">
                    <div class="row">

                        <!--Left Column-->
                        <div class="col-md-5">
                            <div class="form-group">
                                <input class="form-control" name="name" placeholder="Name" required=""
                                       type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="email" placeholder="Email" required=""
                                       type="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="subject" placeholder="Subject" required=""
                                       type="text">
                            </div>
                        </div>

                        <!--Right Column-->
                        <div class="col-md-7">
                            <div class="form-group">
                                <textarea class="form-control" name="message"
                                          placeholder="Message"></textarea>
                            </div>
                        </div>

                        <!--Button-->
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-large btn-rounded btn-purple btn-hvr-blue d-block mt-4" href="javascript:void(0);"
                               id="submit_btn"><i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i><b>Send Message</b>
                                <div class="btn-hvr-setting">
                                    <ul class="btn-hvr-setting-inner">
                                        <li class="btn-hvr-effect"></li>
                                        <li class="btn-hvr-effect"></li>
                                        <li class="btn-hvr-effect"></li>
                                        <li class="btn-hvr-effect"></li>
                                    </ul>
                                </div>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--Contact End-->
@endsection

@section('script')
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        slidesPerView: 'auto',
        paginationClickable: true,
        spaceBetween: 0,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        loop:true
    });
</script>

@endsection
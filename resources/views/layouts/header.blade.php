  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="{!! isset($preference->value['favicon']) ? $preference->value['favicon'] : '-' !!}" rel="shortcut icon" type="image/*">
    <meta name="title" content="{{ isset($preference->value['meta_title']) ? $preference->value['meta_title'] : 'ALCB' }}" />
    <title>{{ isset($preference->value['meta_title']) ? $preference->value['meta_title'] : 'ALCB' }}</title>
    <meta name="title" content="{!! isset($preference->value['meta_description']) ? $preference->value['meta_description'] : '-' !!}" />
    <meta name="description" content="{!! isset($preference->value['description']) ? $preference->value['description'] : '-' !!}" />
    {{-- <meta name="keywords" content="{!! isset($preference->value['tag']) ? $preference->value['tag'] : '-' !!}" /> --}}
    <link href="{{ url('frontend/css/bundle.min.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/revolution-settings.min.css') }}" rel="stylesheet">
    <!-- Plugin Css -->
    <link href="{{ url('frontend/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/cubeportfolio.min.css') }}" rel="stylesheet">
    <!-- Style Sheet -->
    <link href="{{ url('frontend/agency/css/style.css') }}" rel="stylesheet">
  </head>
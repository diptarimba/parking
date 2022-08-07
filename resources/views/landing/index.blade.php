<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Parking</title>
    <!-- Website meta description and keywords -->
    <meta name="description" content="Add your app description here">
    <meta name="keywords" content="Add your app keywords here">
    <!-- Website Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing/css/bootstrap.min.css') }}" media="all" />
    <!-- Owl carousel CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing/css/owl.carousel.css') }}">
    <!-- Slick nav CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing/css/slicknav.min.css') }}" media="all" />
    <!-- Iconfont CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing/css/icofont.css') }}" media="all" />
    <!-- Metarial font CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing/css/material-design-iconic-font.css') }}"
        media="all" />
    <!-- Lightbox CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing/css/lightbox.min.css') }}" />
    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing/css/animate.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing/css/style-2.css') }}" media="all" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing/css/responsive-2.css') }}" media="all" />
</head>

<body data-spy="scroll" data-target=".header" data-offset="50">
    <!-- Page loader -->
    <div id="preloader"></div>
    <!-- header section start -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-6">
                    <div>
                        <img src="{{ asset('assets/images/logo-depan.png') }}" class="logo-icon" alt="logo icon">
                    </div>
                </div>
                <div class="col-md-10 col-6">
                    <div class="responsive-menu"></div>
                    <div class="mainmenu">
                        <ul id="primary-menu">
                            <li><a class="nav-link active" href="#home">Home</a></li>
                            <li><a class="nav-link"
                                    href="#{{ $optionalContent[0]['target'] }}">{{ $optionalContent[0]['menu'] }}</a>
                            </li>
                            <li><a class="nav-link" href="#feature">FEATURE</a></li>
                            <li><a class="nav-link" href="#overview">OVERVIEW</a></li>
                            <li><a class="nav-link"
                                    href="#{{ $optionalContent[1]['target'] }}">{{ $optionalContent[1]['menu'] }}</a>
                            </li>
                            <li><a class="nav-link"
                                    href="#{{ $optionalContent[2]['target'] }}">{{ $optionalContent[2]['menu'] }}</a>
                            </li>
                            <li><a class="nav-link"
                                    href="#{{ $optionalContent[3]['target'] }}">{{ $optionalContent[3]['menu'] }}</a>
                            </li>
                            <li><a class="nav-link"
                                    href="#{{ $optionalContent[4]['target'] }}">{{ $optionalContent[4]['menu'] }}</a>
                            </li>
                            <li><a class="nav-link"
                                    href="#{{ $optionalContent[5]['target'] }}">{{ $optionalContent[5]['menu'] }}</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('login.index') }}">LOGIN</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- header section end -->
    <!-- banner section start -->
    <section class="banner-area" id="home">
        <div class="container">
            <div class="row flexbox-center">
                <div class="col-lg-5">
                    <div class="single-banner text-lg-left text-center">
                        <img class="img-rounded" style="max-width: 416px;" src="{{ asset($feature->{0}['image']) }}"
                            alt="banner" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="single-banner">
                        <h1>{{ $feature->{0}['title'] }}</h1>
                        {!! $feature->{0}['description'] !!}
                        {{-- <a href="#" class="appbox-btn">Download</a>
                        <a href="#" class="appbox-btn appbox-btn2">Learn more</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section><!-- banner section end -->
    <!-- about section start -->
    <section class="about-area ptb-80" id="{{ $optionalContent[0]['target'] }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title">
                        <h2>{{ $optionalContent[0]['title'] }}</h2>
                        <p>{{ $optionalContent[0]['description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($about as $each)
                    <div class="col-lg-4">
                        <div class="single-about-box">
                            <i class="icofont {{ $each->icon->code }}"></i>
                            <h4>{{ $each->title }}</h4>
                            <p>{{ $each->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- about section end -->
    <!-- feature section start -->
    <section class="feature-area" id="feature">
        <div class="container">
            <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-feature-box">
                        <h2>{{ $feature->{1}['title'] }}</h2>
                        {!! $feature->{1}['description'] !!}
                        {{-- <a href="#" class="appbox-btn">Download</a>
                        <a href="#" class="appbox-btn appbox-btn2">Learn more</a> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-feature-box text-center">
                        <img style="max-width: 514px" src="{{ asset($feature->{1}['image']) }}" alt="feature" />
                    </div>
                </div>
            </div>
        </div>
    </section><!-- feature section end -->
    <!-- overview section start -->
    <section class="overview-area ptb-80">
        <div class="container">
            <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-overview-box text-lg-left text-center">
                        <img style="max-width: 487px;" src="{{ asset($feature->{2}['image']) }}" alt="feature" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-overview-box">
                        <h2>{{ $feature->{2}['title'] }}</h2>
                        {!! $feature->{2}['description'] !!}
                    </div>
                </div>
            </div>
        </div>
    </section><!-- overview section end -->
    <!-- feature section start -->
    <section class="feature-area" id="overview">
        <div class="container">
            <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-feature-box">
                        <h2>{{ $feature->{3}['title'] }}</h2>
                        {!! $feature->{3}['description'] !!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-feature-box text-lg-right text-center">
                        <img style="max-width: 399px;"src="{{ asset($feature->{3}['image']) }}" alt="feature" />
                    </div>
                </div>
            </div>
        </div>
    </section><!-- feature section end -->
    <!-- activity section start -->
    <section class="activity-area ptb-80" id="{{ $optionalContent[1]['target'] }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title">
                        <h2>{{ $optionalContent[1]['title'] }}</h2>
                        <p>{{ $optionalContent[1]['description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($activity as $each)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-activity-box">
                            <i class="{{ $each->icon->code }}"></i>
                            <h2>{{ $each->title }}</h2>
                            <h5>{{ $each->description }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- activity section end -->
    <!-- screenshots section start -->
    <section class="screenshots-area ptb-80" id="{{ $optionalContent[2]['target'] }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title">
                        <h2>{{ $optionalContent[2]['title'] }}</h2>
                        <p>{{ $optionalContent[2]['description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="screenshot-area-slider">
                        @foreach ($parkingLocation as $each)
                            <div class="screenshot-single-slide">
                                <img src="{{ asset($each->image) }}" alt="screenshot" />
                                <div class="screenshot-overlay">
                                    <a class="icofont icofont-ui-search example-image-link"
                                        href=" https://www.google.com/maps/search/?api=1&query={{ urlencode($each->latitude . ',' . $each->longitude) }}"
                                        target="_blank"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section><!-- screenshots section end -->
    <!-- feedback section start -->
    <section class="feedback-area ptb-80" id="{{ $optionalContent[3]['target'] }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title">
                        <h2>{{ $optionalContent[3]['title'] }}</h2>
                        <p>{{ $optionalContent[3]['description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="author-feedback">
                        @foreach ($feedback as $each)
                            <div class="author-single-slide">
                                <div class="author-img">
                                    <img src="{{ asset($each->avatar) }}" alt="author" />
                                </div>
                                <h4>{{ $each->name }}</h4>
                                <p>{{ $each->feedback }}</p>
                                <div class="author-rating">
                                    @for ($x = 0; $x < $each->star_count; $x++)
                                        <i class="icofont icofont-star"></i>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section><!-- feedback section end -->
    <!-- contact section start -->
    <section class="contact-area ptb-80" id="{{ $optionalContent[4]['target'] }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title">
                        <h2>{{ $optionalContent[4]['title'] }}</h2>
                        <p>{{ $optionalContent[4]['description'] }}</p>
                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="contact-form-7">
                        <form action="{{ route('landing.contact.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="contact-container">
                                        <input type="text" name="name" placeholder="Full Name">
                                        <i class="icofont icofont-ui-user"></i>
                                    </div>
                                    <div class="contact-container">
                                        <input type="email" name="email" placeholder="Email Address">
                                        <i class="icofont icofont-envelope"></i>
                                    </div>
                                    <textarea name="content" max="255" placeholder="Your Messege"></textarea>
                                </div>
                            </div>
                            <div class="row flexbox-center">
                                <div class="col-sm-4 text-sm-right text-center">
                                    <button type="submit" class="appbox-btn">SEND</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- contact section end -->
    <!-- faq section start -->
    <section class="ptb-80" id="{{ $optionalContent[5]['target'] }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title">
                        <h2>{{ $optionalContent[5]['title'] }}</h2>
                        <p>{{ $optionalContent[5]['description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="faq-area">
                        <div class="pannel-group" id="general-question">
                            @foreach ($faq as $each)
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#question{{ $loop->iteration }}" data-toggle="collapse"
                                            data-parent="#general-question" class="collapsed" aria-expanded="false">
                                            {{ $each->question }}
                                        </a>
                                    </div>
                                    <div id="question{{ $loop->iteration }}" class="panel-collapse collapse"
                                        aria-expanded="false" role="banner" style="">
                                        <div class="card-body">
                                            <p>{{ $each->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- faq section end -->
    <!-- footer section start -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer-content">
                        <p>Copyright <a href="/">Smart Parking</a> - All Right Reserved</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-content">
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#faq">FAQ</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="#">Team</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- footer section end -->
    <a href="#" class="scrolltotop">
        <i class="icofont icofont-arrow-up" aria-hidden="true"></i>
    </a>
    <!-- jquery main JS -->
    <script src="{{ asset('assets/landing/js/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/landing/js/bootstrap.min.js') }}"></script>
    <!-- Slick nav JS -->
    <script src="{{ asset('assets/landing/js/jquery.slicknav.min.js') }}"></script>
    <!-- owl carousel JS -->
    <script src="{{ asset('assets/landing/js/owl.carousel.min.js') }}"></script>
    <!-- EasyPieChart JS -->
    <script src="{{ asset('assets/landing/js/jquery.easypiechart.min.js') }}"></script>
    <!-- lightbox JS -->
    <script src="{{ asset('assets/landing/js/lightbox.min.js') }}"></script>
    <!-- WOW JS -->
    <script src="{{ asset('assets/landing/js/wow-1.3.0.min.js') }}"></script>
    <!-- common JS -->
    <script src="{{ asset('assets/landing/js/common.js') }}"></script>
    <!-- main JS -->
    <script src="{{ asset('assets/landing/js/main-2.js') }}"></script>
</body>

</html>

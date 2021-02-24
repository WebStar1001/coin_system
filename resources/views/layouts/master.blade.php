<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{__($general->sitename)}} {{  '| '.__($pt) }}  </title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/font-awesome.min.css')}}">
    <!-- flaticon -->
    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/flaticon.css">
    <!-- slicknav -->
    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/slicknav.min.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/animate.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/owl.carousel.min.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/magnific-popup.css">
    <!-- stylesheet -->
    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/style.css">
    <!-- responsive -->
    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/responsive.css">

    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/flipclock.css">

    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/custom.css">

    <link rel="stylesheet" href="{{asset('assets/admin/css/sweetalert.css')}}">

    <link rel="stylesheet" href="{{url('/')}}/assets/front/css/color.php?color={{$general->color}}&color2={{$general->color_two}}">
    @yield('style')


</head>

<body>
<!-- support bar area start -->
<div class="support-bar">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-9 col-md-12 col-sm-12 support-bar-curve">
                <div class="support-wrapper">
                    <div class="support-bar-left">
                        <span class="support-item"><i class="fa fa-envelope"></i> {{$general->email}}</span>
                        <span class="support-item"><i class="fa fa-phone"></i> {{__($general->phone)}}</span>
                    </div>
                    <div class="support-bar-right">
                        <span class="support-item">
                            <i class="fa fa-language"></i>
                             <select id="langSel">
                                    <option style="color: black" value="en"> English</option>
                                 @foreach($lang as $data)
                                     <option value="{{$data->code}}" @if(Session::get('lang') === $data->code) selected  @endif style="color: black"><img src="{{ asset('assets/images/'.$data->icon)  }}"> {{$data->name}}</option>
                                 @endforeach
                                </select>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- support bar area end -->
<div class="header-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="site-logo site-title" href="{{url('/')}}"><img style="max-width: 200px" src="{{asset('assets/images/logo/logo.png')}}" alt="site-logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="menu-toggle"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav main-menu ml-auto" id="primary-pranto">

                    @guest

                        <li><a @if(request()->path() == '/') href="#home" @else href="{{url('/')}}#home" @endif>@lang('Home')</a>
                        <li><a @if(request()->path() == '/') href="#service" @else href="{{url('/')}}#service"@endif>@lang('Services')</a>
                        <li><a @if(request()->path() == '/') href="#about" @else href="{{url('/')}}#about"  @endif>@lang('About')</a>
                        <li><a @if(request()->path() == '/') href="#faq" @else href="{{url('/')}}#faq"  @endif>@lang('FAQ')</a>
                        <li><a @if(request()->path() == '/') href="#map" @else href="{{url('/')}}#map"  @endif>@lang('Road Map')</a>
                        <li><a href="{{route('contact.front')}}">@lang('Contact')</a>

                        <li class="menu_has_children"><a href="#0">@lang('Account')</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('register')}}">@lang('Sign Up')</a></li>
                                <li><a href="{{route('login')}}">@lang('Sign In')</a></li>
                            </ul>
                        </li>


                    @else
                        <li><a href="{{url('/home')}}">@lang('Dashboard')</a>

                        <li class="menu_has_children"><a href="#0">@lang('Purchase STO')</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('user.deposit')}}">@lang('Purchase STO')</a></li>
                                <li><a href="{{route('user.deposit.history')}} ">@lang('Purchase History')</a></li>
                                <li><a href="{{route('user.interest.log')}} ">@lang('STO Log')</a></li>
                            </ul>
                        </li>


                        <li class="menu_has_children"><a href="#0">@lang('Withdraw')</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('user.withdraw')}}">@lang('Withdraw Now')</a></li>
                                <li><a href="{{route('withdraw.history')}}">@lang('Withdraw History')</a></li>
                            </ul>
                        </li>

                        <li class="menu_has_children"><a href="#0">@lang('Transaction')</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('user.balance.transfer')}}">@lang('STO Transfer')</a></li>
                                <li><a href="{{route('user.transaction')}}">@lang('Transaction History')</a></li>
                                <li><a href="{{route('my.referral.com')}}">@lang('Referral Statistic')</a></li>
                                <li><a href="{{route('user.referral.com')}}">@lang('Referral Commission')</a></li>
                            </ul>
                        </li>

                        <li class="menu_has_children"><a href="#0">{{ Auth::user()->name }}</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('user.profile')}}">@lang('Profile')</a></li>
                                <li><a href="{{route('support.index.customer')}}">@lang('Support Ticket')</a></li>
                                <li><a href="{{route('two.factor.index')}}">@lang('2Fa Security')</a></li>
                                <li><a href="{{ route('logout') }}"onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();" class="dropdown-item">@lang('Logout')</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>

                    @endguest


                </ul>
            </div>
        </nav>
    </div>
</div><!-- header-bottom end -->

<div id="app">
    @yield('content')
</div>
<!-- footer area start -->
<footer class="footer-area footer-bg" style="background: url({{asset('assets/images/footer.jpg')}}); background-size: cover;">
    <div class="container">
        <div class="row">

            <div class="col-md-8 offset-md-2 text-center">
                <a href="{{url('/')}}" class="footer-logo ">
                    <img style="max-width: 220px" src="{{asset('assets/images/logo/logo.png')}}" alt="footer logo">
                </a>
                <p style="color: #fff; margin-top: 30px;">{{__($general->footer_text)}}</p>
            </div>

            <div class="col-md-12 text-center">
                <div class="footer-social">
                    <ul>
                        @foreach($social as $key=> $data)
                        <li><a class="facebook" href="{{$data->link}}"><i class="fa fa-{{$data->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>
<!-- footer area end -->
<!-- copyright area start -->

<div class="copyright-area copyright-bg">
    <div class="containter">
        <div class="row">
            <div class="col-lg-12 text-center">
                {{__($general->footer)}}
            </div>
        </div>
    </div>
</div>
<!-- copyright area end -->

<!-- back to top btn start -->
<div class="back-to-top">
    <i class="fa fa-angle-up"></i>
</div>
<!-- back to top btn end -->

<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-wrapper">
        <div class="preloader-img">
            <img style="max-width: 120px" src="{{asset('assets/images/logo/favicon.png')}}" alt="">
        </div>
    </div>

</div>
<!-- preloader area end -->

<!-- jquery -->
<script src="{{url('/')}}/assets/front/js/jquery.js"></script>
<!-- popper -->
<script src="{{url('/')}}/assets/front/js/popper.min.js"></script>
<!-- bootstrap -->
<script src="{{url('/')}}/assets/front/js/bootstrap.min.js"></script>
<!-- slicknav -->
<script src="{{url('/')}}/assets/front/js/jquery.slicknav.min.js"></script>

<script src="{{url('/')}}/assets/front/js/flipclock.min.js"></script>
<!-- owl carousel -->
<script src="{{url('/')}}/assets/front/js/owl.carousel.min.js"></script>
<!-- magnific popup -->
<script src="{{url('/')}}/assets/front/js/jquery.magnific-popup.js"></script>
<!-- way poin js-->
<script src="{{url('/')}}/assets/front/js/waypoints.min.js"></script>
<!-- wow js-->
<script src="{{url('/')}}/assets/front/js/wow.min.js"></script>
<!-- counterup js-->
<script src="{{url('/')}}/assets/front/js/jquery.counterup.min.js"></script>
<!-- contact js-->
<script src="{{url('/')}}/assets/front/js/contact.js"></script>
<!-- main -->
<script src="{{url('/')}}/assets/front/js/main.js"></script>

<script src="{{asset('assets/admin/js/sweetalert.js')}}"></script>

<script src="{{url('/')}}/assets/vue/vue.js"></script>

<script src="{{url('/')}}/assets/vue/axios.js"></script>

<script>
    $(document).on('change', '#langSel', function () {
        var code = $(this).val();
        window.location.href = "{{url('/')}}/change-lang/"+code ;
    });
</script>

@yield('script')
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>


<script>
    $(document).ready(function(){
        var winheight = $(window).height() -150;
        $('#justify-height').css('min-height',winheight+'px');
    });
</script>


@if (Session::has('success'))
    <script type="text/javascript">
        $(document).ready(function () {
            iziToast.success({
                title: '{{__('Success!')}}',
                message: '{{__(Session::get('success'))}}',
            });

        });
    </script>
@endif

@if (Session::has('message'))
    <script type="text/javascript">
        $(document).ready(function () {
            iziToast.success({
                title: '{{__('Success!')}}',
                message: '{{__(Session::get('message'))}}',
            });

        });
    </script>
@endif

@if (Session::has('alert'))
    <script type="text/javascript">
        $(document).ready(function () {
            iziToast.error({
                title: '{{__('Opps!')}}',
                message: '{{__(Session::get('alert'))}}',
            });
        });
    </script>
@endif
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <script>
            $(document).ready(function(){
                iziToast.warning({
                    title: '{{__('Error!')}}',
                    message: '{{__($error)}}',
                    position: 'topRight',
                });
            });
        </script>
    @endforeach
@endif

</body>

</html>
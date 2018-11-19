<!doctype html>
<html>
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
   Email Invitation
 </title>

 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/main.css">

 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/slicknav.css">

 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/color-switcher.css">

 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/responsive.css">
 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/custom.css">
 <link rel="stylesheet" media="screen" href="{{$PUBLIC_ASSETS}}/fonts/font-awesome/font-awesome.min.css">
 <link rel="stylesheet" media="screen" href="{{$PUBLIC_ASSETS}}/fonts/simple-line-icons.css">

 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/owl/owl.carousel.css">
 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/owl/owl.theme.css">
 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/animate.css">
 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/normalize.css">
 <link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/colors/green.css" media="screen">
 <link rel="stylesheet" id="colors" href="{{$PUBLIC_ASSETS}}/css/colors/green.css" type="text/css">
 <link rel="stylesheet" href="{{$PUBLIC_ASSETS}}/css/color-switcher.css" type="text/css">
 <script src="{{$PUBLIC_ASSETS}}/js/jquery-min.js"></script>
 <script src="{{$PUBLIC_ASSETS}}/js/custom.js"></script> 
 <script src="{{$PUBLIC_ASSETS}}/js/search.js"></script> 


</head>
<body>

  <section class="error-section section split">
    <div class="container">
     {{--  <div class="row">
      <div class="col-md-12 text-center">
        <h1>404</h1>
        <h4>Opps! Page Not Found</h4>
        <a href="#" class="mt-30 btn btn-outline btn-lg"><i class="fa fa-home"></i> GET BACK HOME</a>
      </div>
    </div> --}}
    <div class="row">

      <div class="col-md-8 mr-auto portfolio-single-content wow fadeIn animated" data-wow-delay="0.5s" style="visibility: visible;-webkit-animation-delay: 0.5s; -moz-animation-delay: 0.5s; animation-delay: 0.5s;">
        <h3 class="small-title mb-30">Assalam o Alaikum!</h3>
        <p>{{ $msg }}</p>
        <p>Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text Sampel text .</p>

      </div>

      <div class="col-md-3 wow fadeIn animated" data-wow-delay="0.5s" style="visibility: visible;-webkit-animation-delay: 0.5s; -moz-animation-delay: 0.5s; animation-delay: 0.5s;">
        <h3 class="small-title mb-30">Details</h3>
        <div class="portfolio-meta">
          <ul>
            <li><span>Sender name</span>{{ $name }}</li>
            <li><span>Email</span>{{ $sender_email }}</li>

          </ul>
        </div>
        <a class="btn btn-common btn-md btn-block mt-30" href="{{url('/')}}"><i class="fa fa-link"></i>Visit Quran Online</a>
      </div>
    </div>
  </div>
</section>

</body>


</html>
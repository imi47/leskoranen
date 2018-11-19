<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
        <meta charset=utf-8>
        <meta http-equiv=X-UA-Compatible content="IE=edge">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <meta name=description content="">
        <meta name=author content="">
        <title>{{ $title }}</title>
        <link rel="shortcut icon" href="{{$PUBLIC_ASSETS}}/img/forweb2.jpg" type="image/x-icon">
        <script src="{{ $ADMIN_ASSETS }}/ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <style type="text/css" media="screen">
            #wait {
              position: fixed;
              left: 0px;
              top: 0px;
              width: 100%;
              height: 100%;
              z-index: 9999;
              background: url('{{ asset("public/") }}/img/loading.gif') 50% 50% no-repeat rgba(249,249,249,0.7);
              background-size: 100px 100px;
            }
            .skiptranslate{
                display:none !important;
            }
            /*input {
                color: white !important;
            }
            input::placeholder {
                color: #2c3136 !important;
            }
            :-ms-input-placeholder {
                color: red;
            }

            ::-ms-input-placeholder {
                color: red;
            }*/
        </style>
        <script>
            WebFont.load({
                google: {
                    families: ['Alegreya+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i', 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Open Sans']
                }
            });
        </script>
        <!-- START GLOBAL MANDATORY STYLE -->
        <script src="{{ $ADMIN_ASSETS }}/plugins/jQuery/jquery-1.12.4.min.js"></script>
        <link href="{{ $ADMIN_ASSETS }}/dist/css/base.css" rel=stylesheet type="text/css"/>
        <!-- STRAT PAGE LABEL PLUGINS -->
        @stack('css')
        <!-- END PAGE LABEL PLUGINS -->
        <link href="{{ $ADMIN_ASSETS }}/dist/css/component_ui.css" rel=stylesheet type="text/css"/>
        <!-- <link id=defaultTheme href="{{ $ADMIN_ASSETS }}/dist/css/skins/component_ui_black.css" rel=stylesheet type="text/css"/> -->
        <link href="{{ $ADMIN_ASSETS }}/dist/css/custom.css" rel=stylesheet type="text/css"/>
        <link href="{{ $ADMIN_ASSETS }}/plugins/toastr/toastr.min.css" rel=stylesheet type="text/css"/>
        <script src="{{ $ADMIN_ASSETS }}/plugins/toastr/toastr.min.js"></script>
        <script type="text/javascript">
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "3000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
        </script> 
        
        <!--[if lt IE 9]>
                    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->
    </head>
    <body>
      <div id="google_translate_element" style="display: none"></div>
        <div id="wait" style="display: none"></div>
        <div id=wrapper class="wrapper animsition">
            @include('admin.top-bar')
            @include('admin.sidebar')
            <div class=control-sidebar-bg></div>
            <div id=page-wrapper>
                @yield('data')
            </div>
            <form id="logout-form" action="{{ route('admin-logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <script data-cfasync="false" src="{{ $ADMIN_ASSETS }}/cdn-cgi/scripts/d07b1474/cloudflare-static/email-decode.min.js">
        </script>

        <script src="{{ $ADMIN_ASSETS }}/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <script src="{{ $ADMIN_ASSETS }}/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{ $ADMIN_ASSETS }}/plugins/metisMenu/metisMenu.min.js" type="text/javascript"></script>
        <script src="{{ $ADMIN_ASSETS }}/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
        <script src="{{ $ADMIN_ASSETS }}/plugins/animsition/js/animsition.min.js" type="text/javascript"></script>
        <script src="{{ $ADMIN_ASSETS }}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <script src="{{ $ADMIN_ASSETS }}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- STRAT PAGE LABEL PLUGINS -->
        @stack('js')
        <!-- END PAGE LABEL PLUGINS -->
        <script src="{{ $ADMIN_ASSETS }}/dist/js/app.min.js" type="text/javascript"></script>
        <script src="{{ $ADMIN_ASSETS }}/dist/js/jQuery.style.switcher.min.js" type="text/javascript"></script>
    </body>
</html>
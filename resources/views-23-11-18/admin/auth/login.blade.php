<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>{{ $title }}</title>
        <link rel="shortcut icon" href="{{$PUBLIC_ASSETS}}/img/forweb2.jpg" type="image/x-icon">
        <script src="{{ $ADMIN_ASSETS }}/ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
            WebFont.load({
                google: {
                    families: ['Alegreya+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i', 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Open Sans']
                }
            });
        </script>
        <!-- Bootstrap -->
        <script src="{{ $ADMIN_ASSETS }}/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <link href="{{ $ADMIN_ASSETS }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="{{ $ADMIN_ASSETS }}/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Pe-icon-7-stroke -->
        <link href="{{ $ADMIN_ASSETS }}/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <link href="{{ $ADMIN_ASSETS }}/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="{{ $ADMIN_ASSETS }}/dist/css/component_ui.css" rel="stylesheet" type="text/css"/>
        <!-- <link href="{{ $ADMIN_ASSETS }}/dist/css/skins/component_ui_black.css" rel="stylesheet" type="text/css"/> -->
        <!-- Theme style rtl -->
        <!--<link href="{{ $ADMIN_ASSETS }}/dist/css/component_ui_rtl.css" rel="stylesheet" type="text/css"/>-->
        <!-- Custom css -->
        <link href="{{ $ADMIN_ASSETS }}/dist/css/custom.css" rel="stylesheet" type="text/css"/>
      {{--   <style type="text/css" media="screen">
        	.form-errors{
        		color: red;
        	}
        	html , body{
        		background: url({{ asset('public/img') }}/background.jpg) no-repeat center center fixed;
			    -webkit-background-size: cover;
			    -moz-background-size: cover;
			    -o-background-size: cover;
			    background-size: cover;
        	}
            #anch {
                background-image: url({{$PUBLIC_ASSETS}}/img/forweb2.jpg) !important;
                /* padding-bottom: 30px; */
                margin: 0 auto;
                background-size: 380px 75px;
                background-repeat: no-repeat;
                width: 380px;
                height: 100px;
                display: block;
            }
        </style> --}}
    </head>
    <body>
        <!-- Content Wrapper -->
        <h4><a href="{{ route('login') }}" id="anch" title="BETAAR" tabindex="-1"></a></h4>
        <div class="login-wrapper">
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin-login') }}" method="POST" id="loginForm">
                        	@csrf
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="username" type="text" class="form-control" name="email" placeholder="Username" autofocus>
                                </div>
                                <span class="help-block small form-errors" id="email"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input id="pass" type="password" class="form-control" name="password" placeholder="******">
                                </div>
                                <span class="help-block small form-errors" id="password"></span>
                            </div>
                            <span id="invalid-cred" class="form-errors"></span>
                            <div>
                                <button class="btn btn-primary btn-block account-btn" type="submit" id="logn"><i class="fa fa-check"></i> Login</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        
        <!-- bootstrap js -->
        <script src="{{ $ADMIN_ASSETS }}/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $('#loginForm').submit(function(e){
              e.preventDefault();
              form = $(this);
              $('.form-errors').html('');
              $.ajax({
                  url: form.attr('action'), 
                  type: "POST",            
                  data: new FormData(this),
                  contentType: false,       
                  cache: false,            
                  processData:false,
                  beforeSend: function(){ $('#logn').html('<i aria-hidden="true" class="fa fa-spinner fa-spin"></i> Validating');},        
                  success: function(data)   
                  {
                    $('#logn').html('<i aria-hidden="true" class="fa fa-check"></i> Login');
                    response = $.parseJSON(data);
                    if(response.feedback == 'false')
                    {
                      $.each( response.errors, function( key, value) {
                        $('#' + key).html(value);
                      });
                      // $('html, body').animate({scrollTop: '250px'}, 1000);
                    }
                    else if(response.feedback == 'invalid')
                    {
                        $('#invalid-cred').html(response.msg);
                    }
                    else
                    {
                        window.location.reload();
                    }
                   },
                   error: function (jqXHR, exception) 
                   {
                        $('#logn').html('<i aria-hidden="true" class="fa fa-check"></i> Login');
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not Connected.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error, Please try again later';
                        }
                        $('#invalid-cred').html("<div class='alert alert-danger'><strong>Error!</strong> "+msg+"</div>");
                    },
                });
            });
        </script>
    </body>
</html>

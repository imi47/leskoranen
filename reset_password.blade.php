<hr>
<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          <h3><i class="fa fa-lock fa-4x"></i></h3>
                          <h2 class="text-center">Bytt passord.</p>
                            <div class="panel-body">
                              
                              <form method="post" action="{{ route('change-password') }}" class="form">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">

                                  <div class="form-group">
                                      <input placeholder="Nytt passord" class="form-control" type="password" name="password">
                                    </div>
                                    <span style="font-size: 12px; color: red;">{{ $errors->first('password') }}</span>
                                  
                                  <div class="form-group">
                                    <div class="form-group">
                                      <input placeholder="Bekreft passord" class="form-control" type="password" name="password_confirmation">
                                    </div>
                                    <span style="color: red; font-size: 12px;">{{ $errors->first('password_confirmation') }}</span>
                                    
                                  
                                  <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block"  type="submit">Bytt passord</button>
                                    
                                  </div>
                                
                              </form>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
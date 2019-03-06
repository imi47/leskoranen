@extends('admin.master-layout')
@section('data')
<div class="content">
	<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>{{ $title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">{{ admin_uri() }}</li>
            </ol>
        </div>
    </div> 
    <!-- /. Content Header (Page header) -->
    <div class="row">
		<div class="col-md-12">
		    <div class="panel panel-bd">
		        <div class="panel-heading">
		            <div class="panel-title">
		                <h4>
                      @if(Session::get('error'))
                      <p class="alert alert-danger">{{ Session::get('error') }}</p>
                      @endif
                     @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    </h4>
		            </div>
		        </div>
		        <div class="panel-body">
		            <form method="POST" action="{{ route('post-admin') }}" id="sub-form">
		            	@csrf
		            	<div class="row">
		            		<div class="col-md-4">
				            	<div class="form-group nsurahname">
                          <label for="name">Name</label>
                          <input type="text" name="name" class="form-control" placeholder="Name">
                          <div class="form-feedback"></div>
                      </div>
		            		</div>


		            		<div class="col-md-4">
				            	<div class="form-group nsurahname">
                          <label for="user-name">User name</label>
                          <input type="text" name="username" class="form-control" placeholder="User Name">
                          <div class="form-feedback"></div>
                      </div>
		            		</div>
                    <div class="col-md-4">
                      <div class="form-group nsurahnamearabic">
                          <label for="email">Email</label>
                          <input type="text" name="email" class="form-control" placeholder="Email">
                          <div class="form-feedback" id="nsurahnamearabic"></div>
                      </div>
                    </div>
                    </div>
                     <div class="row">
                    <div class="col-md-4">
                      <div class="form-group nsurahnumber">
                          <label for="surah-number">Phone</label>
                          <input type="number" name="phone" class="form-control" placeholder="Phone number">
                          <div class="form-feedback"></div>
                      </div>
                    </div>
		            	
                 
                    <div class="col-md-4">
                      <div class="form-group nsurahjuznumber">
                          <label for="password">Password</label>
                          <input type="password" name="password" class="form-control"  placeholder="Password">
                          <div class="form-feedback" ></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group nsurahjuznumber">
                          <label for="confirm password">Confirm Password</label>
                          <input type="password" name="password_confirmation" class="form-control"  placeholder="Confirm password">
                          <div class="form-feedback" ></div>
                      </div>
                    </div>
                </div>
                   
                
		            	<div class="row">
		            		{{-- <div class="col-md-6"></div> --}}
		            		<div class="col-md-12">
		            			<button type="submit" class="btn btn-labeled btn-info btn-transparent btn-block m-b-5" id="sub-btn">
                          <span class="btn-label"><i class="fa fa-check"></i></span>Save
                      </button>
		            		</div>
		            	</div>
		            </form>
		        </div>
		    </div>
		</div>
    </div>
</div>

@endsection



@push('js')
  <script src="{{ $ADMIN_ASSETS }}/plugins/jQuery-mask-plugin/jquery.mask.min.js" type="text/javascript"></script>  
  
@endpush
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
                      @php
                        $name = explode(' ', $title . ' Details');
                      @endphp 
                      @foreach($name as $key => $name)
                        {{ ($key > 0)? $name . ' ' : '' }}
                      @endforeach
                    </h4>
		            </div>
		        </div>
		        <div class="panel-body">
		            <form method="POST" action="{{ route('post-surah') }}" id="sub-form">
		            	@csrf
		            	<div class="row">
		            		<div class="col-md-3">
				            	<div class="form-group nsurahname">
                          <label for="surah-name">Name (In English)</label>
                          <input type="text" name="nsurahname" class="form-control" id="surah-name" placeholder="e.g., Al-Fatiha">
                          <div class="form-feedback" id="nsurahname"></div>
                      </div>
		            		</div>
                    <div class="col-md-3">
                      <div class="form-group nsurahnamearabic">
                          <label for="surah-name-ar">Name (In Arabic)</label>
                          <input type="text" name="nsurahnamearabic" class="form-control" id="surah-name-ar" placeholder="e.g., الفَاتِحَة">
                          <div class="form-feedback" id="nsurahnamearabic"></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group nsurahnumber">
                          <label for="surah-number">Surah Number in Quran</label>
                          <input type="number" name="nsurahnumber" class="form-control" id="surah-number" placeholder="From 1 to 114">
                          <div class="form-feedback" id="nsurahnumber"></div>
                      </div>
                    </div>
		            	</div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group nsurahjuznumber">
                          <label for="surah-number-juz">Surah Starting Juz Number in Quran</label>
                          <input type="number" name="nsurahjuznumber" class="form-control" id="surah-number-juz" placeholder="From 1 to 30">
                          <div class="form-feedback" id="nsurahjuznumber"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group nsurahendjuznumber">
                          <label for="surah-end-number-juz">Surah Ending Juz Number in Quran</label>
                          <input type="number" name="nsurahendjuznumber" class="form-control" id="surah-end-number-juz" placeholder="From 1 to 30">
                          <div class="form-feedback" id="nsurahendjuznumber"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group ntotalverses">
                          <label for="total-verses">Total Verses</label>
                          <input type="number" name="ntotalverses" class="form-control" id="total-verses" placeholder="e.g., 7">
                          <div class="form-feedback" id="ntotalverses"></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group ntotalruku">
                          <label for="total-ruku">Total Ruku</label>
                          <input type="number" name="ntotalruku" class="form-control" id="total-ruku" placeholder="e.g., 1">
                          <div class="form-feedback" id="ntotalruku"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group nsurahtype">
                          <label for="total-verses">Surah Type</label>
                          <select class="form-control basic-single" id="total-verses" name="nsurahtype">
                            <option value="" disabled="" selected="">Choose Type</option>
                              <option value="1">Makki</option>
                              <option value="2">Madani</option>
                          </select>
                          <div class="form-feedback" id="nsurahtype"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group nsurahintro">
                          <label for="surah-intro">Surah Introduction</label>
                          <textarea type="text" name="nsurahintro" class="form-control" id="surah-intro" style="resize: none" rows="15"></textarea>
                          <div class="form-feedback" id="nsurahintro"></div>
                      </div>
                    </div>
                  </div>

                  {{-- <div class="row">
                    <div class="col-md-12">
                      <div class="form-group nsurahdescription">
                          <label for="surah-description">Surah Description</label>
                          <textarea type="text" name="nsurahdescription" class="form-control" id="surah-description" style="resize: none" rows="15"></textarea>
                          <div class="form-feedback" id="nsurahdescription"></div>
                      </div>
                    </div>
                  </div> --}}
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
<script type="text/javascript">
    $('#sub-form').submit(function(e){
      for ( instance in CKEDITOR.instances ) {
          CKEDITOR.instances[instance].updateElement();
      }
      e.preventDefault();
      form = $(this);
      $('.form-feedback').html('');
      $('.form-group').removeClass('has-danger');
      $.ajax({
          url: form.attr('action'), 
          type: form.attr('method'),            
          data: new FormData(this),
          contentType: false,       
          cache: false,            
          processData:false,
          beforeSend: function(){ $('#sub-btn').html('<span class="btn-label"><i aria-hidden="true" class="fa fa-spinner fa-spin"></i></span>Saving');},        
          success: function(data)   
          {
            $('#sub-btn').html('<span class="btn-label"><i class="fa fa-check"></i></span>Save');
            response = $.parseJSON(data);
            if(response.feedback == 'false')
            {
              $('.form-group').addClass('has-success');
              $.each( response.errors, function( key, value) {
                $('#' + key).html(value);
                $('.' + key).addClass('has-danger');
              });
              $('html, body').animate({scrollTop: '120px'}, 800);
              toastr.error(response.msg , 'Error');
            }
            else
            {
            	toastr.success(response.msg , 'Success');
                setTimeout(function(){
	                window.location.href = response.url;
	            }, 1000);
            }
           },
           error: function (jqXHR, exception) 
           {
                $('#sub-btn').html('<span class="btn-label"><i class="fa fa-check"></i></span>Save');
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
                toastr.error(msg , 'Error');
            },
        });
    });
</script>
@endsection

@push('css')
  <script src="https://cdn.ckeditor.com/4.10.1/full-all/ckeditor.js"></script>
@endpush

@push('js')
  <script src="{{ $ADMIN_ASSETS }}/plugins/jQuery-mask-plugin/jquery.mask.min.js" type="text/javascript"></script>  
  <script type="text/javascript">
    $(document).ready(function () {
       CKEDITOR.replace( 'surah-intro');
      "use strict"; // Start of use strict
      $('.cnicmask').mask('00000-0000000-0');
    });

  </script>
@endpush
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
		            <form method="POST" action="{{ route('update-juz') }}" id="sub-form">
		            	@csrf
		            	<div class="row">
		            		<div class="col-md-6">
				            	<div class="form-group njuzname">
                          <label for="surah-name">Name (In Arabic)</label>
                          <input type="text" name="njuzname" class="form-control" value="{{ $juz->juz_name }}" id="surah-name" placeholder="e.g., الٓمّٓۚ">
                          <div class="form-feedback" id="njuzname"></div>
                      </div>
		            		</div>
                    <div class="col-md-6">
                      <div class="form-group njuznumber">
                          <label for="juz-num">Juz Number</label>
                          <input type="number" name="njuznumber" class="form-control" value="{{ $juz->juz_number }}" id="juz-num" placeholder="e.g., 1">
                          <div class="form-feedback" id="njuznumber"></div>
                      </div>
                    </div>
		            	</div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group nstartsurah">
                          <label for="start-surah">Starting Surah</label>
                          <select class="form-control basic-single" id="start-surah" name="nstartsurah">
                            <option value="" disabled="" selected="">Choose Starting Surah</option>
                            @foreach($surahs as $key => $row)
                              <option @if($row->id == $juz->start_surah_id) selected="" @endif value="{{ $row->id }}" surah_number="{{ $row->surah_number }}" id="verses-op{{ $row->id }}" varses="{{ $row->verses }}">{{ $row->surah_number . '. ' . $row->surah_name }}</option>
                            @endforeach
                          </select>
                          <div class="form-feedback" id="nstartsurah"></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group nstartsurahverse">
                          <label for="start-surah-verse">Starting Surah's Verse</label>
                          <select class="form-control basic-single" id="start-surah-verse" name="nstartsurahverse">
                            <option value="" disabled="" selected="">Choose Starting Surah's Verse</option>
                            @foreach($juz->starting_surah->verse as $row)
                              <option @if($row->id == $juz->start_verse_id) selected="" @endif value="{{ $row->verse }}">{{ $row->verse }}</option>
                            @endforeach
                          </select>
                          <div class="form-feedback" id="nstartsurahverse"></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group nendsurah">
                          <label for="end-start-surah">Ending Surah</label>
                          <select class="form-control basic-single" id="end-surah" name="nendsurah">
                            <option value="" disabled="" selected="">Choose Ending Surah</option>
                            @foreach($surahs as $key => $row)
                              <option @if($row->id == $juz->end_surah_id) selected="" @endif value="{{ $row->id }}" end_surah_number="{{ $row->surah_number }}" id="end-verses-op{{ $row->id }}" varses="{{ $row->verses }}">{{ $row->surah_number . '. ' . $row->surah_name }}</option>
                            @endforeach
                          </select>
                          <div class="form-feedback" id="nendsurah"></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group nendsurahverse">
                          <label for="end-surah-verse">Ending Surah's Verse</label>
                          <select class="form-control basic-single" id="end-surah-verse" name="nendsurahverse">
                            <option value="" disabled="" selected="">Choose Ending Surah's Verse</option>
                            @foreach($juz->ending_surah->verse as $row)
                              <option @if($row->id == $juz->end_verse_id) selected="" @endif value="{{ $row->verse }}">{{ $row->verse }}</option>
                            @endforeach
                          </select>
                          <div class="form-feedback" id="nendsurahverse"></div>
                      </div>
                    </div>
                  </div>

		            	<div class="row">
		            		{{-- <div class="col-md-6"></div> --}}
		            		<div class="col-md-12">
                      <input type="hidden" name="juz_id" value="{{ $juz->id }}">
		            			<button type="submit" class="btn btn-labeled btn-info btn-transparent btn-block m-b-5" id="sub-btn">
                          <span class="btn-label"><i class="fa fa-check"></i></span>Update
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
    $('#start-surah').on('change' , function(){
      var options = '<option value="" disabled="" selected="">Choose Starting Surah\'s Verse</option>';
      surah_number = $('#verses-op'+$(this).val()).attr('surah_number');
      for(var i=1 ; i <= $('#verses-op'+$(this).val()).attr('varses') ; ++i)
      {
        options += '<option value="'+i+'">'+i+'</option>';
      }
      $('#start-surah-verse').html(options);
      console.log($('option[end_surah_number]')); 
    });
    $('#end-surah').on('change' , function(){
      var options = '<option value="" disabled="" selected="">Choose Ending Surah\'s Verse</option>';
      for(var i=1 ; i <= $('#end-verses-op'+$(this).val()).attr('varses') ; ++i)
      {
        options += '<option value="'+i+'">'+i+'</option>';
      }
      $('#end-surah-verse').html(options);
    });
    $('#sub-form').submit(function(e){
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
          beforeSend: function(){ $('#sub-btn').html('<span class="btn-label"><i aria-hidden="true" class="fa fa-spinner fa-spin"></i></span>Updating');},        
          success: function(data)   
          {
            $('#sub-btn').html('<span class="btn-label"><i class="fa fa-check"></i></span>Update');
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
            else if(response.feedback == 'other_error')
            {
              $('.form-group').addClass('has-success');
              $('#' + response.id).html(response.custom_msg);
              $('.' + response.id).addClass('has-danger');
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
                $('#sub-btn').html('<span class="btn-label"><i class="fa fa-check"></i></span>Update');
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
  {{-- <script src="https://cdn.ckeditor.com/4.10.1/full-all/ckeditor.js"></script> --}}
@endpush

@push('js')
  <script src="{{ $ADMIN_ASSETS }}/plugins/jQuery-mask-plugin/jquery.mask.min.js" type="text/javascript"></script>  
  <script type="text/javascript">
    $(document).ready(function () {
       // CKEDITOR.replace( 'surah-intro');
      "use strict"; // Start of use strict
      $('.cnicmask').mask('00000-0000000-0');
    });

  </script>
@endpush
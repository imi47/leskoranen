@extends('admin.master-layout')
@section('data')
<div class="content">
	<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>{{ $title }} in {{ __('Surah') }} {{ $surah->surah_name }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('all-surahs') }}"> All Surahs</a></li>
                <li class="active">{{ admin_uri() }}</li>
                <a title="Go Back" href="{{ url()->previous() }}" class="btn btn-info btn-rounded m-b-12 pull-right"><i class="fa fa-backward"></i> Go Back</a>
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
		            <form method="POST" action="{{ route('update-verse') }}" id="sub-form" enctype="multipart/form-data">
		            	@csrf
		            	<div class="row">
		            		<div class="col-md-12">
				            	<div class="form-group nversearabic">
                          <label for="editor1">Arabic (With Immune)</label>
                          <textarea id="editor1" dir="rtl" name="nversearabic" class="form-control" style="resize: vertical;">{{ $d->arabic_immune }}</textarea>
                          <div class="form-feedback" id="nversearabic"></div>
                      </div>
		            		</div>
		            	</div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group nversearabicwithoutimmune">
                          <label for="editor2">Arabic (Without Immune)</label>
                          <textarea id="editor2"  dir="rtl" name="nversearabicwithoutimmune" class="form-control" style="resize: vertical;">{{ $d->arabic_no_immune }}</textarea>
                          <div class="form-feedback" id="nversearabicwithoutimmune"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group nnortrans">
                          <label for="editor3">Norwegian Translation</label>
                          <textarea id="editor3" name="nnortrans" class="form-control" style="resize: vertical;">{{ $d->translation }}</textarea>
                          <div class="form-feedback" id="nnortrans"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <h4>Recitor's Audio</h4>
                    </div>
                    <div class="col-md-4">
                      <audio controls>
                          <source src="{{ asset('public') . '/admin_assets/audios' }}/{{ $d->link_to_audio }}" >
                      </audio>
                    </div>
                    <div class="col-md-2">
                      <h4>Translator's Audio</h4>
                    </div>
                    <div class="col-md-4">
                      <audio controls>
                          <source src="{{ asset('public') . '/admin_assets/audios' }}/{{ $d->link_to_translation_audio }}" >
                      </audio>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group nrecname">
                          <label for="rec-name">Recitor Name</label>
                          <select class="form-control basic-single" id="rec-name" name="nrecname">
                            <option value="" disabled="">Choose Recitor Name</option>
                              @foreach($recitors as $r => $row)
                                <option @if($row->id == $d->recitor_id) selected="" @endif value="{{ $row->id }}">{{ $row->name }}</option>
                              @endforeach
                          </select>
                          <div class="form-feedback" id="nrecname"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group narabicaudiolink">
                          <label for="ln1">Recitor's Audio</label>
                          <input type="file" name="narabicaudiolink" id="ln1" class="form-control basic-single">
                          <div class="form-feedback" id="narabicaudiolink"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group ntranname">
                          <label for="tran-name">Translator Name</label>
                          <select class="form-control basic-single" id="tran-name" name="ntranname">
                            <option value="" disabled="" >Choose Translator Name</option>
                              @foreach($translators as $r => $row)
                                <option @if($row->id == $d->translator_id) selected="" @endif value="{{ $row->id }}">{{ $row->name }}</option>
                              @endforeach
                          </select>
                          <div class="form-feedback" id="ntranname"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group nartransaudiolink">
                          <label for="ln2">Translator's Audio</label>
                          <input type="file" name="nartransaudiolink" id="ln2" class="form-control basic-single">
                          <div class="form-feedback" id="nartransaudiolink"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group nversenum">
                          <label for="verse-num">Verse</label>
                          <input type="number" value="{{ $d->verse }}" name="nversenum" class="form-control" id="verse-num" placeholder="From 1 to {{ $surah->verses }}">
                          <div class="form-feedback" id="nversenum"></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group njuzzid">
                          <label for="verse-juz">Juz</label>
                          <input type="number" value="{{ $d->juzz_number }}" name="njuzzid" class="form-control" id="verse-juz" placeholder="From 1 to 30">
                          <div class="form-feedback" id="njuzzid"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group nruku">
                          <label for="ruku-id">Ruku</label>
                          @if($surah->raku <> 1)
                            <input type="number" value="{{ $d->raku }}" name="nruku" class="form-control" id="ruku-id" placeholder="e.g., 1 to {{ $surah->raku }}">
                          @else
                            <input type="number" value="{{ $d->raku }}" name="nruku" class="form-control" id="ruku-id">
                          @endif
                          <div class="form-feedback" id="nruku"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group nversedesc">
                          <label for="verse-desc">Verse Description</label>
                          <textarea type="text" name="nversedesc" class="form-control" id="verse-desc" style="resize: none" rows="15">{{ $d->description }}</textarea>
                          <div class="form-feedback" id="nversedesc"></div>
                      </div>
                    </div>
                  </div>
                  
		            	<div class="row">
		            		{{-- <div class="col-md-6"></div> --}}
                    <input type="hidden" name="surah_id" value="{{ $d->surah_id }}">
                    <input type="hidden" name="verse_id" value="{{ $d->id }}">
		            		<div class="col-md-12">
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
  <script src="https://cdn.ckeditor.com/4.10.1/full-all/ckeditor.js"></script>
  {{-- <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script> --}}
@endpush

@push('js')
  <script src="{{ $ADMIN_ASSETS }}/plugins/jQuery-mask-plugin/jquery.mask.min.js" type="text/javascript"></script>  
  <script>
    CKEDITOR.replace( 'editor1', {
      extraPlugins: 'bidi',
      // Setting default language direction to right-to-left.
      contentsLangDirection: 'rtl',
      height: 150
    } );
    // CKEDITOR.replace( 'editor2', {
    //   extraPlugins: 'bidi',
    //   // Setting default language direction to right-to-left.
    //   contentsLangDirection: 'rtl',
    //   height: 150
    // } );
    // CKEDITOR.replace( 'editor3', {
    //   extraPlugins: 'bidi',
    //   // Setting default language direction to right-to-left.
    //   // contentsLangDirection: 'rtl',
    //   height: 150
    // } );
  </script>
@endpush
@extends('admin.master-layout')
@section('data')
<div class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>{{ $title }}</h1>
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
        <div class="col-sm-12">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>{{ $title }}</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <input type="text" class="form-control input-sm m-b-15" id="filter" placeholder="Search in table">
                        <table id="listing" class="footable table table-bordered toggle-arrow-tiny" data-filter=#filter>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Verse</th>
                                    <th>Surah</th>
                                    <th>Ruku</th>
                                    <th>Actions</th>
                                    <th data-hide="all">Arabic</th>
                                    <th data-hide="all">Translation</th>
                                    <th data-hide="all">Recitor</th>
                                    <th data-hide="all">Translator</th>
                                    <th data-hide="all">Translation (Norw)</th>
                                    <th data-hide="all">Description</th>
                                    <th data-hide="all">Juz</th>
                                    <th data-hide="all">Added By</th>
                                    <th data-hide="all">Updated By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listing as $key => $list)
                                <tr>
                                    <td>{{ $list->verse }}</td>
                                    <td>
                                        ({!! ($list->arabic_immune == NULL OR $list->arabic_immune == '')? 'N/A' : $list->arabic_immune !!}
                                        {{ ($list->arabic_no_immune == NULL OR $list->arabic_no_immune == '')? '' : ' (' . $list->arabic_no_immune }}
                                    </td>
                                    <td>{{ ($list->surah == NULL OR empty($list->surah))? 'N/A' : $list->surah->surah_name }}</td>
                                    <td>{{ $list->raku }}</td>
                                    <td>
                                        <a title="Edit Verse" href="{{ route('edit-verse' , ['verse_id' => encrypt($list->id)]) }}" class="btn btn-primary btn-circle m-b-5"><i class="fa fa-edit"></i></a>
                                        {{-- <a title="Delete Verse" id="row-id{{ ($list->id == NULL OR $list->id == '')? 'N/A' : $list->id }}" href="javascript:delete_verse('{{ ($list->id == NULL OR $list->id == '')? 'N/A' : encrypt($list->id) }}');" class="btn btn-danger btn-circle m-b-5"><i class="fa fa-trash"></i></a> --}}
                                    </td>
                                    <td>
                                        <audio controls>
                                            <source src="{{ asset('public') . '/admin_assets/audios' }}/{{ $list->link_to_audio }}" >
                                        </audio>
                                    </td>
                                    <td>
                                        <audio controls>
                                            <source src="{{ asset('public') . '/admin_assets/audios' }}/{{ $list->link_to_translation_audio }}" >
                                        </audio>
                                    </td>
                                    <td>{{ ($list->recitor == NULL OR empty($list->recitor))? 'N/A' : $list->recitor->name }}</td>
                                    <td>{{ ($list->translator == NULL OR empty($list->translator))? 'N/A' : $list->translator->name }}</td>
                                    <td>{{ $list->translation }}</td>
                                    <td>{{ $list->description }}</td>
                                    <td>{{ $list->juzz_number }}</td>
                                    <td>{{ ($list->added_by == NULL OR empty($list->added_by))? 'N/A' : $list->added_by->name }} at {{ date('H:i A d-m-Y' , strtotime($list->created_at)) }}</td>
                                    <td>{{ ($list->edited_by == NULL OR empty($list->edited_by))? 'N/A' : $list->edited_by->name }} at {{ date('H:i A d-m-Y' , strtotime($list->updated_at)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <span class="pull-right"> {{ $listing->links() }}</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    <link href="{{ $ADMIN_ASSETS }}/plugins/footable-bootstrap/css/footable.core.min.css" rel="stylesheet" type="text/css"/>
@endpush

@push('js')
    <script src="{{ $ADMIN_ASSETS }}/plugins/footable-bootstrap/js/footable.all.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            "use strict"; // Start of use strict
            // Footable example 1
            $('#listing').footable();
        });
        @if(\Auth::user()->role == 1)
            function delete_verse(verse_id)
            {
              r = confirm('Really You want to Delete?');
              if(!r)
              {
                return;
              }
              else
              {
                document.getElementById("wait").style.display = "block";
                $.post('{{ route('delete-verse') }}' , {_token: '{{ csrf_token() }}' , verse_id: verse_id , json: 'json'} , function(data){
                  document.getElementById("wait").style.display = "none";
                  response = $.parseJSON(data);
                  if(response.feedback == 'role_issue')
                  {
                    toastr.error(response.error_msg , 'Error');
                  }
                  else if(response.feedback == 'login_issue')
                  {
                    window.location.reload();
                  }
                  else if(response.feedback == 'true')
                  {
                    toastr.success(response.msg , 'Success');
                    $('#row-id'+response.verse_id).fadeOut(200, function(){ 
                        $(this).closest('tr').remove(); 
                    });
                  }
                  else
                  {
                    toastr.error('Something went Wrong' , 'Error');
                  }
                });
              }
            }
        @endif
    </script>
@endpush
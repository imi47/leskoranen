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
                        <table id="example" class="table table-striped table-bordered nowrap">
                        {{-- <table id="listing" class="footable table table-bordered toggle-arrow-tiny" data-filter=#filter> --}}
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th data-hide="all">Type</th>
                                    <th>Juz</th>
                                    <th data-hide="all">Ending Juz</th>
                                    <th>Ruku</th>
                                    <th>Verses</th>
                                    <th>Actions</th>
                                    {{-- <th data-hide="all">Introduction</th>
                                    <th data-hide="all">Description</th>
                                    <th data-hide="all">Added By</th>
                                    <th data-hide="all">Updated By</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listing as $key => $list)
                                <tr>
                                    <td>{{ $list->surah_number }}</td>
                                    {{-- <td>{{ $key + $listing->firstItem() }}</td> --}}
                                    <td>
                                        {{ ($list->surah_name == NULL OR $list->surah_name == '')? 'N/A' : $list->surah_name }}
                                        {{ ($list->surah_name_arabic == NULL OR $list->surah_name_arabic == '')? '' : ' (' . $list->surah_name_arabic . ')' }}
                                    </td>
                                    <td>
                                        @if($list->type_id == 1)
                                            Makki
                                        @elseif($list->type_id == 2)
                                            Madani
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $list->juz_id }}</td>
                                    <td>{{ $list->juz_ending_id }}</td>
                                    <td>{{ $list->raku }}</td>
                                    <td>{{ $list->verses }}</td>
                                    <td>
                                        <a title="Add Verse" href="{{ route('add-verse' , ['surah_id' => encrypt($list->id)]) }}" class="btn btn-success btn-circle m-b-5"><i class="fa fa-plus"></i></a>
                                        <a title="All Verses" href="{{ route('all-verses' , ['surah_id' => encrypt($list->id)]) }}" class="btn btn-primary btn-circle m-b-5"><i class="fa fa-snowflake-o"></i></a>
                                        @if(\Auth::user()->role == 3)
                                        <a title="Edit Surah" href="{{ route('edit-surah' , ['surah_id' => encrypt($list->id)]) }}" class="btn btn-primary btn-circle m-b-5"><i class="fa fa-edit"></i></a>
                                        @endif
                                    </td>
                                    {{-- <td>{!! nl2br($list->introduction) !!}</td>
                                    <td>{!! nl2br($list->description) !!}</td>
                                    <td>{{ ($list->added_by == NULL OR empty($list->added_by))? 'N/A' : $list->added_by->name }} at {{ date('H:i A d-m-Y' , strtotime($list->created_at)) }}</td>
                                    <td>{{ ($list->edited_by == NULL OR empty($list->edited_by))? 'N/A' : $list->edited_by->name }} at {{ date('H:i A d-m-Y' , strtotime($list->updated_at)) }}</td> --}}
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
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css">
@endpush

@push('js')
<script>
$(document).ready(function() {
    $('#example').DataTable( {
      } );
} );
</script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>

<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js" type="text/javascript"></script>


@endpush
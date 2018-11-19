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
                        <table id="listing" class="footable table table-bordered toggle-arrow-tiny" data-filter=#filter>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <td>Starting Surah</td>
                                    <td>Ending Surah</td>
                                    <td>Actions</td>
                                    <th data-hide="all">Added By</th>
                                    <th data-hide="all">Updated By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listing as $key => $list)
                                <tr>
                                    <td>{{ $list->juz_number }}</td>
                                    <td>
                                        {{ $list->juz_name }}
                                    </td>
                                    <td>
                                        {{ ($list->starting_surah == NULL OR empty($list->starting_surah))? 'N/A' : $list->starting_surah->surah_name }} from Verse {{ ($list->starting_surah_verse == NULL OR empty($list->starting_surah_verse))? 'N/A' : $list->starting_surah_verse->verse }}
                                    </td>
                                    <td>
                                        {{ ($list->ending_surah == NULL OR empty($list->ending_surah))? 'N/A' : $list->ending_surah->surah_name }} to Verse {{ ($list->ending_surah_verse == NULL OR empty($list->ending_surah_verse))? 'N/A' : $list->ending_surah_verse->verse }}
                                    </td>
                                    <td>
                                        <a title="Edit Juz" href="{{ route('edit-juz' , ['juz_id' => encrypt($list->id)]) }}" class="btn btn-primary btn-circle m-b-5"><i class="fa fa-edit"></i></a>
                                    </td>
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
    </script>
@endpush
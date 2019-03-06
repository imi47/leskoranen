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
            @if(\Session::has('action_feedback'))
                <div class="alert alert-{!! \Session::get('action_feedback_type') !!} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {!! \Session::get('action_feedback') !!}
                </div>
            @endif
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
                                    <td>Surah</td>
                                    <td>script</td>
                                    <td>Recitor</td>
                                    <td data-hide="all">Summary</td>
                                    <th data-hide="all">Details</th>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listing as $key => $list)
                                <tr>
                                    <td>{{ $key + $listing->firstItem() }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        {{ ($list->surah == NULL OR empty($list->surah))? 'N/A' : $list->surah->surah_name }} from Verse {{ $list->from_verse }} to Verse {{ $list->to_verse }}
                                    </td>
                                    <td>{{ $list->script }}</td>
                                    <td>{{ ($list->recitor == NULL OR empty($list->recitor))? 'N/A' : $list->recitor->name }}</td>  
                                    <td>{{ $list->summery }}</td>
                                    <td>{{ $list->details }}</td>
                                    <td>
                                         <a onclick="confirm_delete(this)" title="Delete Report" href="{{ route('delete-bug-report' , ['bug_id' => encrypt($list->id)]) }}" class="btn btn-danger btn-circle m-b-5"><i class="fa fa-trash"></i></a>    
                                    </td>
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
        function confirm_delete(e)
        {
            r = confirm('Really you want to delete this report?');
            if(!r)
            {
                ee.stopPropagation()
                e.preventDefault();
                return false;
            }
        }
    </script>
@endpush
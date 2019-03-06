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
                        <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                        <table id="listing" class="footable table table-bordered toggle-arrow-tiny" data-filter=#filter>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Admin Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admin_view as $key => $row)
                                <tr>
                                	 <td>{{ $key }}</td>
                                    <td>{{ $row->name}}</td>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>
                                    @if($row->role==3)
                                          Admin
                                          @else
                                          User

                                        @endif
                                        </td>
                                    <td>
                                        <a title="Add Admin" href="{{ route('add-admin') }}" class="btn btn-success btn-circle m-b-5"><i class="fa fa-plus"></i></a>
                                        @if(\Auth::user()->role == 3)
                                        <a title="Edit Admin" href="{{ route('edit-admin' , ['id' => encrypt($row->id)]) }}" class="btn btn-primary btn-circle m-b-5"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if($row->role==3)
                                        <a href="javascript:;">
                                            <img src="{{$PUBLIC_ASSETS}}/img/limit_admin_1.png" alt="" style="width: 36px; padding-bottom: 5px;">
                                          </a>
                                          @else
                                          <a href="javascript:;">
                                          <img src="{{$PUBLIC_ASSETS}}/img/limit_admin_2.png" alt="" style="width: 29px; padding-bottom: 5px;">
                                      </a>

                                        @endif
                                    </td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <span class="pull-right"> {{ $admin_view->links() }}</span>
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
@extends('admin.master-layout')
@section('data')
<div class="content">
	<div class="content-header">
        <div class="header-icon">
            <i class="fa fa-dashboard"></i>
        </div>
        <div class="header-title">
            <h1>{{ $title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">{{ admin_uri() }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <a href="{{ route('all-surahs') }}">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="statistic-box statistic-filled-1">
                    <h2><span class="count-number">{{ surahs_count() }}</span></h2>
                    <div class="small">Total Surahs</div>
                    <i class="fa fa-leanpub statistic_icon"></i>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
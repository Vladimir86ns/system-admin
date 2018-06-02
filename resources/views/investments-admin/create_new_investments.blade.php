@extends('investments-admin/layouts/default')

{{-- Page title --}}
@section('title')
Blank Page
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
    <!--JUST INCLUDED FORM COMPONENT IN THIS PAGE-->
@include('investments-admin.form.create-investment')
        
@stop

{{-- page level scripts --}}
@section('footer_scripts')
@stop

@extends('owner.layouts.default')

{{-- Page title --}}
@section('title')
Product
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <style>
        body{
            overflow: -webkit-paged-x;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
  <h1>Product</h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
        Dashboard
      </a>
    </li>
    <li class="active">Blank page</li>
  </ol>
</section>

{{-- ADD NEW PRODUCT --}}
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-info">

          <div class="panel-heading">
            <h3 class="panel-title">
              <i data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Add new product
            </h3>
          </div>
          <div class="panel-body">

          <div class="col-md-12">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group {{ $errors->first('name', 'has-error') }}">
              <label>Name:</label>
              <input type="text" name="name" id="name" class="form-control input-md" placeholder="name">
              {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group {{ $errors->first('name', 'has-error') }}">
              <label>Expense:</label>
              <input type="text" name="name" id="name" class="form-control input-md" placeholder="name">
              {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
          </div>

          {{-- START FORM TO ADD ON PRJECT --}}
          <form action="#" method="POST" onsubmit="return Validation()" role="form" id="project_details">
            <div class="col-md-6">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <div class="form-group {{ $errors->first('position', 'has-error') }}">
                <label>Add positions:</label>
                <input type="text" name="position" id="position" class="form-control input-md" placeholder="position1,position2,position3">
                {!! $errors->first('position', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label></label>
                <input type="submit" name="btnSubmit" id="btnSubmit" value="Save project details" class="btn btn-success btn-block btn-md btn-responsive">
              </div>
            </div>
          </form>
          {{-- END OF FORM --}}

       </div>
      </div>
    </div>
  </section>
@stop

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
        <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}"  rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
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

          <form action="/owner/product/store" method="POST" onsubmit="return Validation()" role="form" id="product">
          <div class="col-md-6">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group {{ $errors->first('name', 'has-error') }}">
              <label>Name:</label>
              <input type="text" name="name" id="name" class="form-control input-md">
              {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group {{ $errors->first('size', 'has-error') }}">
              <label>Size:</label>
              <input type="text" name="size" id="size" class="form-control input-md">
              {!! $errors->first('size', '<span class="help-block">:message</span>') !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group {{ $errors->first('cost', 'has-error') }}">
              <label>Costs:</label>
              <input type="text" name="cost" id="cost" class="form-control input-md">
              {!! $errors->first('cost', '<span class="help-block">:message</span>') !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group {{ $errors->first('price', 'has-error') }}">
              <label>Price:</label>
              <input type="text" name="price" id="price" class="form-control input-md">
              {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
            </div>
          </div>

          <div class="col-md-6" data-provides="fileinput">
            <div class="form-group {{ $errors->first('picture', 'has-error') }}">
              <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
              <div>
                <span class="btn btn-default btn-file">
                <span class="fileinput-new">Select image</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="picture" id="picture"></span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
              {!! $errors->first('picture', '<span class="help-block">:message</span>') !!}
            </div>
          </div>

          <div class="col-md-6">

            <div class="form-group {{ $errors->first('time_to_prepare', 'has-error') }}">
              <label>Time to pripare:</label>
              <input type="text" name="time_to_prepare" id="time_to_prepare" class="form-control input-md">
              {!! $errors->first('time_to_prepare', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->first('category', 'has-error') }}">
              <label>Belongs to category product:</label>
                <select class="form-control" name="category">
                      <option value="" >Not selected</option>
                      <option value="pizza">Pizza</option>
                      <option value="Palacinke">Palacinke</option>
                </select>
                {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
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

@section('footer_scripts')
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_examples.js') }}"></script>
@stop

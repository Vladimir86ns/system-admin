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

{{-- DISPLAY ALL PRODUCTS --}}
 <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- BEGGINING OWNER PROJECT -->
        <div class="portlet box primary">
          <div class="portlet-title">
            <div class="caption">
              <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Project details
            </div>
          </div>
          <div class="portlet-body flip-scroll">
            <table class="table table-bordered table-striped table-condensed flip-content">
              <thead class="flip-content">
                <tr>
                  <th>Name</th>
                  <th class="numeric">Total Amount</th>
                  <th class="numeric">Income</th>
                  <th class="numeric">Expense</th>
                  <th class="numeric">Profit</th>
                  <th class="numeric">Profit Sharing</th>
                  <th class="numeric">Investment Collected</th>
                  <th class="numeric">Phone Number</th>
                  <th class="numeric">Income</th>
                  <th class="numeric">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <td>Name</td>
                <td class="numeric">Total amount</td>
                <td class="numeric">Income</td>
                <td class="numeric">Expense</td>
                <td class="numeric">Add something</td>
                <td class="numeric">Add something</td>
                <td class="numeric">Add something</td>
                <td class="numeric">Add something</td>
                <td class="numeric">Add something</td>
                <td>
                    <a href="#">
                    <i class="fa fa-fw fa-search"></i>
                    </a>
                </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- END BEGGINING OWNER PROJECT-->
      </div>
    </div>
  </section>
@stop

@extends('owner.layouts.default')

{{-- Page title --}}
@section('title')
Blank Page
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


 <section class="content">
    <div class="row">
      <div class="col-md-12">

        <!-- BEGGINING ALL EMPLOYEES -->
        <div class="portlet box primary">
          <div class="portlet-title">
            <div class="caption">
              <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                All Employees
            </div>
          </div>
          <div class="portlet-body flip-scroll">
            <table class="table table-bordered table-striped table-condensed flip-content">
              <thead class="flip-content">
                <tr>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Position</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($employees as $employee)
                  <tr>
                    <td>{{ $employee['name'] }}</td>
                    <td>{{ $employee['email'] }}</td>
                    <td>{{ $employee['position'] }}</td>
                    <td>
                      <a href="/owner/employee-details/{{ $employee['id'] }}">
                      <i class="fa fa-fw fa-search"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- END ALL EMPLOYEES-->

      </div>
    </div>
  </section>

  @if($employeeDetails)
    @include('owner.employee.employee-details')
  @endif
@stop

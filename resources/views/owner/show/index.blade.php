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
  <h1>Blank page</h1>
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

{{-- DISPLAY OWNERS PROJECT --}}

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
                <td>{{ $ownerProject['name'] }}</td>
                <td class="numeric">{{ $ownerProject['total_amount'] }}</td>
                <td class="numeric">{{ $ownerProject['income'] }}</td>
                <td class="numeric">{{ $ownerProject['expense'] }}</td>
                <td class="numeric">{{ $ownerProject['profit'] }}</td>
                <td class="numeric">{{ $ownerProject['profit_sharing'] }}</td>
                <td class="numeric">{{ $ownerProject['investment_collected'] }}</td>
                <td class="numeric">{{ $ownerProject['phone_number'] }}</td>
                <td class="numeric">{{ $ownerProject['income'] }}</td>
                <td>
                    <a href="/owner/show-project-details/{{ $ownerProject['id'] }}">
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

  {{-- DISPLAY PROJECT DETAILS--}}
  @if($showProjectForm)
    @include('owner.show.project-details');
  @endif

@stop

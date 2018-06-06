@extends('investor.layouts.default')

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

 <!-- SEE ALL INVESTMENTS -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- BEGIN ALL INVESTMENTS TABLE-->
      <div class="portlet box primary">
        <div class="portlet-title">
          <div class="caption">
            <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Investments
          </div>
        </div>
        <div class="portlet-body flip-scroll">
          <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
              <tr>
                <th>Name</th>
                <th class="numeric">Total Investition</th>
                <th class="numeric">Country</th>
                <th class="numeric">City</th>
                <th class="numeric">Address</th>
                <th class="numeric">Collected To Date</th>
                <th class="numeric">Closed</th>
                <th class="numeric">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allInvestments['data'] as $investment)
                <tr>
                  <td>{{ $investment['name'] }}</td>
                  <td class="numeric">{{ $investment['total_investition'] }}</td>
                  <td class="numeric">{{ $investment['country'] }}</td>
                  <td class="numeric">{{ $investment['city'] }}</td>
                  <td class="numeric">{{ $investment['address'] }}</td>
                  <td class="numeric">{{ $investment['collected_to_date'] }}</td>
                  <td class="numeric">{{ $investment['closed'] ? 'Yes' : 'No' }}</td>
                  <td>
                    <a href="/investments-admin/all-and-selected-investments/{{ $investment['id'] }}">
                      <i class="fa fa-fw fa-sign-in"></i>
                    </a>                            
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- END ALL INVESTMENTS TABLE-->
    </div>
  </div>
</section>        
@stop

{{-- page level scripts --}}
@section('footer_scripts')
@stop

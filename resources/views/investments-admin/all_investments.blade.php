@extends('investments-admin/layouts/default')

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
  <h1>All Investments</h1>
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
      <!-- BEGIN ALL INVESTMENTS TABLE-->
      <div class="portlet box primary">
        <div class="portlet-title">
          <div class="caption">
            <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Investments
          </div>
        </div>
        <div class="portlet-body flip-scroll">
          <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th class="numeric">Total Investition</th>
                <th class="numeric">City</th>
                <th class="numeric">Country</th>
                <th class="numeric">Address</th>
                <th class="numeric">Collected To Date</th>
                <th class="numeric">Closed</th>
                <th class="numeric">Status</th>
                <th class="numeric">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allInvestments['data'] as $investment)
                <tr>
                  <td>{{ $investment['id'] }}</td>
                  <td>{{ $investment['name'] }}</td>
                  <td class="numeric">{{ $investment['total_investition'] }}</td>
                  <td class="numeric">{{ $investment['city'] }}</td>
                  <td class="numeric">{{ $investment['country'] }}</td>
                  <td class="numeric">{{ $investment['address'] }}</td>
                  <td class="numeric">{{ $investment['collected_to_date'] }}</td>
                  <td class="numeric">{{ $investment['closed'] ? 'Yes' : 'No' }}</td>
                  <td>  
                    @if ($investment['status'] === 'PENDING')
                      <span class="label label-sm label-info">{{ $investment['status'] }}</span>
                    @elseif  ($investment['status'] === 'APPROVED')
                      <span class="label label-sm label-success">{{ $investment['status'] }}</span>
                    @elseif  ($investment['status'] === 'REJECTED')
                      <span class="label label-sm label-danger">{{ $investment['status'] }}</span>
                    @endif
                  </td>
                  <td>
                    <a href="/investments-admin/all-and-selected-investments/{{ $investment['id'] }}">
                      <i class="fa fa-fw fa-pencil"></i>
                    </a>
                    <a href="/investments-admin/all-and-selected-investments/{{ $investment['id'] }}">
                      <i class="fa fa-fw fa-sign-in"></i>
                    </a>
                    @if ($investment['status'] === 'REJECTED')
                      <a href="/investments-admin/rejected-or-delete-investment/{{ $investment['id'] }}">
                        <i class="fa fa-fw fa-trash-o"></i>
                      </a>  
                    @endif                               
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
  @if ($transformedInvestment)
  <div class="row">
    <div class="col-md-12">
      <!-- BEGIN ALL INVESTMENTS TABLE-->
      <div class="portlet box primary">
        <div class="portlet-title">
          <div class="caption">
            <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Details before accept
          </div>
        </div>
        <div class="portlet-body flip-scroll">
          <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th class="numeric">Total Investition</th>
                <th class="numeric">City</th>
                <th class="numeric">Country</th>
                <th class="numeric">Address</th>
                <th class="numeric">Collected To Date</th>
                <th class="numeric">Closed</th>
                <th class="numeric">Status</th>
                <th class="numeric">Action</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>{{ $transformedInvestment['id'] }}</td>
                  <td>{{ $transformedInvestment['name'] }}</td>
                  <td class="numeric">{{ $transformedInvestment['total_investition'] }}</td>
                  <td class="numeric">{{ $transformedInvestment['city'] }}</td>
                  <td class="numeric">{{ $transformedInvestment['country'] }}</td>
                  <td class="numeric">{{ $transformedInvestment['address'] }}</td>
                  <td class="numeric">{{ $transformedInvestment['collected_to_date'] }}</td>
                  <td class="numeric">{{ $transformedInvestment['closed'] ? 'Yes' : 'No' }}</td>
                  <td>
                    @if ($transformedInvestment['status'] === 'PENDING')
                      <span class="label label-sm label-info">{{ $transformedInvestment['status'] }}</span>
                    @elseif  ($transformedInvestment['status'] === 'APPROVED')
                      <span class="label label-sm label-success">{{ $transformedInvestment['status'] }}</span>
                    @elseif  ($transformedInvestment['status'] === 'REJECTED')
                      <span class="label label-sm label-danger">{{ $transformedInvestment['status'] }}</span>
                    @endif
                  </td>
                  <td>
                    @if ($transformedInvestment['status'] != 'REJECTED')
                    <a href="/investments-admin/rejected-or-delete-investment/{{ $transformedInvestment['id'] }}">
                      <i class="fa fa-fw fa-times"></i>
                    </a>
                    @endif
                    @if ($transformedInvestment['status'] === 'PENDING' || $transformedInvestment['status'] === 'REJECTED')
                      <a href="/investments-admin/approve-or-un-approve-investment/{{ $transformedInvestment['id'] }}">
                        <i class="fa fa-fw fa-thumbs-o-up"></i>
                      </a>
                    @elseif  ($transformedInvestment['status'] === 'APPROVED')
                      <a href="/investments-admin/approve-or-un-approve-investment/{{ $transformedInvestment['id'] }}">
                        <i class="fa fa-fw fa-thumbs-o-down"></i>
                      </a>
                    @endif
                  </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- END ALL INVESTMENTS TABLE-->
    </div>
  </div>
  @endif
</section>        
    @stop

{{-- page level scripts --}}
@section('footer_scripts')
@stop

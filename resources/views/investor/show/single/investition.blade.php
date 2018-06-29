<section class="content">
  <div class="row">
    <div class="col-md-12">

      <!-- BEGIN SINGLE INVESTMENT TABLE-->
      <div class="portlet box primary">
        <div class="portlet-title">
          <div class="caption">
            <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Details
          </div>
        </div>
        <div class="portlet-body flip-scroll">
          <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
              <tr>
                <th>Name</th>
                <th class="numeric">Total Investition</th>
                <th class="numeric">Investment Collected</th>
                <th class="numeric">Monthly Collected</th>
                <th class="numeric">Percent Of Income</th>
              </tr>
            </thead>
              <tbody>
                  <tr>
                    <td>{{ $transformedInvestment['name'] }}</td>
                    <td class="numeric">{{ $transformedInvestment['total_investment'] }}</td>
                    <td class="numeric">{{ $transformedInvestment['investment_collected_total'] }}</td>
                    <td class="numeric">{{ $transformedInvestment['monthly_collected'] }}</td>
                    <td class="numeric">{{ $transformedInvestment['percent_of_income'] }}</td>
                  </tr>
              </tbody>
          </table>
        </div>
      </div>
      <!-- END SINGLE INVESTMENT TABLE-->
      
    </div>
  </div>
</section>

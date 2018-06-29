<section class="content">
  <!--main content-->
  <div class="row">
    <!--row starts-->
    <div class="col-md-6">
      <!--input form starts-->
      <div class="panel panel-warning" id="hidepanel5">

        <div class="panel-heading">
          <h3 class="panel-title">
            <i class="livicon" data-name="dashboard" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
            Invest in this investment
          </h3>
          <span class="pull-right">
            <i class="glyphicon glyphicon-chevron-up clickable"></i>
            <i class="glyphicon glyphicon-remove removepanel clickable"></i>
          </span>
        </div>

        <div class="panel-body">
          <form  action="/investment/invest/{{ $transformedInvestment['id'] }}" method="POST" onsubmit="return Validation()" role="form" id="create_investments">
            <div class="form-group input-group">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <span class="input-group-addon">Din</span>
              <input type="text" class="form-control" name="total_investment" placeholder="1000, 2000, 5000, 10000, 50000 ...">
              <span class="input-group-addon">.00</span>
            </div>
            <div>
              {!! $errors->first('total_investment', '<span class="help-block">:message</span>') !!}
            </div
            <div class="col-xs-6 col-md-6">
              <input type="submit" name="btnSubmit" id="btnSubmit" value="Invest" class="btn btn-info btn-block btn-md btn-responsive">
            </div>
            <!-- <div class="col-xs-6 col-md-6">
              <input type="submit" name="btnSubmit" id="btnSubmit" value="Confirm" class="btn btn-success btn-block btn-md btn-responsive">
            </div> -->
          </form>
        </div>

      </div>
    </div>
  </div>
</section>
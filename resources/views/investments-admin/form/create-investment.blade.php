<section class="content-header">
    <h1>Create New Investments</h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            <i class="livicon" data-name="plane-up" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> New Investments
          </h3>
          <span class="pull-right clickable">
            <i class="glyphicon glyphicon-chevron-up"></i>
          </span>
        </div>
        <div class="panel-body">
          <form action="/investments-admin/store-investments" method="POST" onsubmit="return Validation()" role="form" id="create_investments">
            <div class="col-md-12">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />

              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <input type="text" name="name" id="name" class="form-control input-md" placeholder="Name of investments">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('country', 'has-error') }}">
                <input type="text" name="country" id="country" class="form-control input-md" placeholder="Country">
                {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('city', 'has-error') }}">
                <input type="text" name="city" id="city" class="form-control input-md" placeholder="City">
                {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('address', 'has-error') }}">
                <input type="text" name="address" id="address" class="form-control input-md" placeholder="Adress Line 1">
                {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('total_investition', 'has-error') }}">
                <input type="text" name="total_investition" id="total_investition" class="form-control input-md" placeholder="Total Investment Price">
                {!! $errors->first('total_investition', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12 mar-10">
              <div class="col-xs-6 col-md-6">
                <input type="submit" name="btnSubmit" id="btnSubmit" value="Start Investment" class="btn btn-success btn-block btn-md btn-responsive">
              </div>
              <div class="col-xs-6 col-md-6">
                <input type="reset" value="Cancel" class="btn btn-danger btn-block btn-md btn-responsive">
              </div>
            </div>

          </form>
        </div>
      </div>
  </div>
</section>
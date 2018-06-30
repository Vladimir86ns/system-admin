<section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">
              <i data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Before confirm
            </h3>
          </div>
          <div class="panel-body">
            <form action="/investments-admin/confirm-investment/{{ $editInvestment['id'] }}" method="POST" onsubmit="return Validation()" role="form" id="create_investments">

            <div class="col-md-12">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />

              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $editInvestment['name'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('city', 'has-error') }}">
                <input type="text" name="city" id="city" class="form-control input-md" readonly="readonly" value="{{ $editInvestment['city'] }}">
                {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('country', 'has-error') }}">
                <input type="text" name="country" id="country" class="form-control input-md" readonly="readonly" value="{{ $editInvestment['country'] }}">
                {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('address', 'has-error') }}">
                <input type="text" name="address" id="address" class="form-control input-md" readonly="readonly" value="{{ $editInvestment['address'] }}">
                {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('total_investition', 'has-error') }}">
                <input type="text" name="total_investition" id="total_investition" class="form-control input-md" readonly="readonly" value="{{ $editInvestment['total_investition'] }}">
                {!! $errors->first('total_investition', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
                <div class="form-group {{ $errors->first('phone_number', 'has-error') }}">
                  <input type="text" name="phone_number" id="phone_number" class="form-control input-md" placeholder="Phone number">
                  {!! $errors->first('phone_number', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('owner_id', 'has-error') }}">
                <select class="form-control" name="owner_id">
                  <option value="" selected disabled>Select owners...</option>
                  @foreach ($allOwners as $owner)
                    <option value={{ $owner['id'] }}>{{ $owner['first_name'] }}  {{ $owner['last_name'] }}</option>
                  @endforeach
                </select>
                {!! $errors->first('owner_id', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12 mar-10">
              <div class="col-xs-6 col-md-6">
                <input type="submit" name="btnSubmit" id="btnSubmit" value="Confirm" class="btn btn-success btn-block btn-md btn-responsive">
              </div>
              <div class="col-xs-6 col-md-6">
                <a class="btn btn-danger btn-block btn-md btn-responsive" href="/investments-admin/all-investments">
                  Cancel
                </a>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
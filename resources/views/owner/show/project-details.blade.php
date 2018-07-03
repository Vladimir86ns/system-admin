<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">
              <i data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Project details
            </h3>
          </div>
          <div class="panel-body">

            <div class="col-md-6">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label>Income:</label>
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $ownerProject['income'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label>Total Amount:</label>
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $ownerProject['total_amount'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label>Income:</label>
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $ownerProject['income'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label>Expense:</label>
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $ownerProject['expense'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label>Profit:</label>
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $ownerProject['profit'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label>Profit Sharing:</label>
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $ownerProject['profit_sharing'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label>Investment Collected:</label>
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $ownerProject['investment_collected'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label>Profit:</label>
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $ownerProject['profit'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group {{ $errors->first('name', 'has-error') }}">
                <label>Name:</label>
                <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $ownerProject['name'] }}">
                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>
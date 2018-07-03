<div class="col-md-16">

  <form action="/" method="GET" onsubmit="return Validation()" role="form" id="create_investments">
    <div class="col-md-6">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="form-group {{ $errors->first('name', 'has-error') }}">
        <label>Name:</label>
        <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $employee['first_name'] }} {{ $employee['last_name'] }}">
        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('name', 'has-error') }}">
        <label>Email:</label>
        <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $employee['email'] }}">
        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('gender', 'has-error') }}">
        <label>Gender:</label>
        <input type="text" name="gender" id="name" class="form-control input-md" placeholder="Gender">
        {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('country', 'has-error') }}">
        <label>Country:</label>
        <input type="text" name="gender" id="gender" class="form-control input-md" placeholder="Gender">
        {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('state', 'has-error') }}">
        <label>State:</label>
        <input type="text" name="state" id="state" class="form-control input-md" placeholder="Gender">
        {!! $errors->first('state', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('city', 'has-error') }}">
        <label>City:</label>
        <input type="text" name="city" id="city" class="form-control input-md" placeholder="Gender">
        {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('address', 'has-error') }}">
        <label>Address:</label>
        <input type="text" name="address" id="city" class="form-control input-md" placeholder="Gender">
        {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('postall', 'has-error') }}">
        <label>Postall code:</label>
        <input type="text" name="postall" id="city" class="form-control input-md" placeholder="Gender">
        {!! $errors->first('postall', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-12 mar-10">
      <div class="col-xs-6 col-md-6">
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" class="btn btn-success btn-block btn-md btn-responsive">
      </div>
      <div class="col-xs-6 col-md-6">
      <a class="btn btn-danger btn-block btn-md btn-responsive" href="/owner/add-employees/{{ $ownerProject['id'] }}">
          Cancel
      </a>
      </div>
    </div>

  </form>
</div>
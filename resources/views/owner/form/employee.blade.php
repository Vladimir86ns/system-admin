{{-- <div class="col-md-16">

<form action="/owner/save-employee/{{$ownerProject['id']}}/{{ $employee['id'] }}" method="POST" onsubmit="return Validation()" role="form" id="create_investments">
    <div class="col-md-6">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="form-group {{ $errors->first('name', 'has-error') }}">
        <label>Name:</label>
        <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $employee['first_name'] }} {{ $employee['last_name'] }}">
        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('email', 'has-error') }}">
        <label>Email:</label>
        <input type="text" name="email" id="email" class="form-control input-md" readonly="readonly" value="{{ $employee['email'] }}">
        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('gender', 'has-error') }}">
        <label>Gender:</label>
        <div class="form-group {{ $errors->first('gender', 'has-error') }}">
          <select class="form-control" name="gender">
              @if($employee['gender'] == null)
                <option value="" selected disabled>Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              @elseif($employee['gender'] == 'male')
                <option value="male" selected>Male</option>
                <option value="female">Female</option>
              @else
                <option value="male">Male</option>
                <option value="female" selected >Female</option>
              @endif
          </select>
          {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('country', 'has-error') }}">
        <label>Country:</label>
        @if($employee['country'] != null)
          <input type="text" name="country" id="country" class="form-control input-md" value="{{$employee['country']}}">
        @else
          <input type="text" name="country" id="country" class="form-control input-md" placeholder="Country">
        @endif
        {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('state', 'has-error') }}">
        <label>State:</label>
        @if($employee['state'] != null)
          <input type="text" name="state" id="state" class="form-control input-md" value="{{$employee['state']}}">
        @else
          <input type="text" name="state" id="state" class="form-control input-md" placeholder="State">
        @endif
        {!! $errors->first('state', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('city', 'has-error') }}">
        <label>City:</label>
        @if($employee['city'] != null)
          <input type="text" name="city" id="city" class="form-control input-md" value="{{$employee['city']}}">
        @else
          <input type="text" name="city" id="city" class="form-control input-md" placeholder="City">
        @endif
        {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('address', 'has-error') }}">
        <label>Address:</label>
        @if($employee['address'] != null)
          <input type="text" name="address" id="address" class="form-control input-md" value="{{$employee['address']}}">
        @else
          <input type="text" name="address" id="address" class="form-control input-md" placeholder="Adress">
        @endif
        {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->first('postal', 'has-error') }}">
        <label>Postall code:</label>
        @if($employee['postal'] != null)
          <input type="text" name="postal" id="postal" class="form-control input-md" value="{{$employee['postal']}}">
        @else
          <input type="text" name="postal" id="postal" class="form-control input-md" placeholder="Postal code">
        @endif
        {!! $errors->first('postal', '<span class="help-block">:message</span>') !!}
      </div>
    </div>

    <div class="col-md-12 mar-10">
      <div class="col-xs-6 col-md-6">
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Add employee to project" class="btn btn-success btn-block btn-md btn-responsive">
      </div>
      <div class="col-xs-6 col-md-6">
      <a class="btn btn-danger btn-block btn-md btn-responsive" href="/owner/add-employees/{{ $ownerProject['id'] }}">
          Cancel
      </a>
      </div>
    </div>

  </form>
</div> --}}
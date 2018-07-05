<section class="content">
  <div class="row">
    <div class="col-md-12">

      <!-- BEGGINING ALL EMPLOYEES -->
      <div class="portlet box primary">
        <div class="portlet-title">
          <div class="caption">
            <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
              All Employees
          </div>
        </div>
        <div class="portlet-body flip-scroll">
          <table class="table table-bordered table-striped table-condensed flip-content">
              <div class="col-md-16">

                  <form action="#" method="POST" onsubmit="return Validation()" role="form" id="create_investments">
                      <div class="col-md-6">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group {{ $errors->first('name', 'has-error') }}">
                          <label>Name:</label>
                          <input type="text" name="name" id="name" class="form-control input-md" readonly="readonly" value="{{ $employeeDetails['first_name'] }} {{ $employeeDetails['last_name'] }}">
                          {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                          <label>Email:</label>
                          <input type="text" name="email" id="email" class="form-control input-md" readonly="readonly" value="{{ $employeeDetails['email'] }}">
                          {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                          <label>Gender:</label>
                          <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                            <select class="form-control" name="gender">
                                @if($employeeDetails['gender'] == null)
                                  <option value="" selected disabled>Gender</option>
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                                @elseif($employeeDetails['gender'] == 'male')
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
                          @if($employeeDetails['country'] != null)
                            <input type="text" name="country" id="country" class="form-control input-md" value="{{$employeeDetails['country']}}">
                          @else
                            <input type="text" name="country" id="country" class="form-control input-md" placeholder="Country">
                          @endif
                          {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->first('state', 'has-error') }}">
                          <label>State:</label>
                          @if($employeeDetails['state'] != null)
                            <input type="text" name="state" id="state" class="form-control input-md" value="{{$employeeDetails['state']}}">
                          @else
                            <input type="text" name="state" id="state" class="form-control input-md" placeholder="State">
                          @endif
                          {!! $errors->first('state', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->first('city', 'has-error') }}">
                          <label>City:</label>
                          @if($employeeDetails['city'] != null)
                            <input type="text" name="city" id="city" class="form-control input-md" value="{{$employeeDetails['city']}}">
                          @else
                            <input type="text" name="city" id="city" class="form-control input-md" placeholder="City">
                          @endif
                          {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->first('address', 'has-error') }}">
                          <label>Address:</label>
                          @if($employeeDetails['address'] != null)
                            <input type="text" name="address" id="address" class="form-control input-md" value="{{$employeeDetails['address']}}">
                          @else
                            <input type="text" name="address" id="address" class="form-control input-md" placeholder="Adress">
                          @endif
                          {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group {{ $errors->first('postal', 'has-error') }}">
                          <label>Postall code:</label>
                          @if($employeeDetails['postal'] != null)
                            <input type="text" name="postal" id="postal" class="form-control input-md" value="{{$employeeDetails['postal']}}">
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
                        <a class="btn btn-danger btn-block btn-md btn-responsive" href="#">
                            Cancel
                        </a>
                        </div>
                      </div>

                    </form>
                  </div>
          </table>
        </div>
      </div>
      <!-- END ALL EMPLOYEES-->

    </div>
  </div>
</section>



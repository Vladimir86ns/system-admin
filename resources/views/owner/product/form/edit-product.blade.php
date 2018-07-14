<section class="content">
  <div class="row">
    <div class="col-md-12">

      <!-- BEGGINING ALL EMPLOYEES -->
      <div class="portlet box primary">
        <div class="portlet-title">
          <div class="caption">
            <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
              Edit product
          </div>
        </div>
        <div class="portlet-body flip-scroll">
          <table class="table table-bordered table-striped table-condensed flip-content">
            <div class="col-md-16">
              <form action="/owner/product/edit/{{$product['id']}}/save" method="POST" onsubmit="return Validation()" role="form" id="product">
                <div class="col-md-6">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <div class="form-group {{ $errors->first('name', 'has-error') }}">
                    <label>Name:</label>
                    <input type="text" name="name" id="name" class="form-control input-md" value="{{ $product['name'] }}">
                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group {{ $errors->first('size', 'has-error') }}">
                    <label>Size:</label>
                    <input type="text" name="size" id="size" class="form-control input-md" value="{{ $product['size'] }}">
                    {!! $errors->first('size', '<span class="help-block">:message</span>') !!}
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group {{ $errors->first('cost', 'has-error') }}">
                    <label>Costs:</label>
                    <input type="text" name="cost" id="cost" class="form-control input-md" value="{{ $product['cost'] }}">
                    {!! $errors->first('cost', '<span class="help-block">:message</span>') !!}
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group {{ $errors->first('price', 'has-error') }}">
                    <label>Price:</label>
                    <input type="text" name="price" id="price" class="form-control input-md" value="{{ $product['price'] }}">
                    {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
                  </div>
                </div>

                <div class="col-md-6">

                  <div class="form-group {{ $errors->first('time_to_prepare', 'has-error') }}">
                    <label>Time to pripare:</label>
                    <input type="text" name="time_to_prepare" id="time_to_prepare" class="form-control input-md" value="{{ $product['time_to_prepare'] }}">
                    {!! $errors->first('time_to_prepare', '<span class="help-block">:message</span>') !!}
                  </div>

                </div>

                <div class="col-md-6">
                <div class="form-group {{ $errors->first('category', 'has-error') }}">
                  <label>Belongs to category product:</label>
                    <select class="form-control" name="category">
                      <option value="" >Not selected</option>
                      <option value="pizza">Pizza</option>
                      <option value="Palacinke">Palacinke</option>
                    </select>
                    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label></label>
                    <input type="submit" name="btnSubmit" id="btnSubmit" value="Save project details" class="btn btn-success btn-block btn-md btn-responsive">
                  </div>
                </div>
              </form>
          </table>
        </div>
      </div>
      <!-- END ALL EMPLOYEES-->
    </div>
  </div>
</section>
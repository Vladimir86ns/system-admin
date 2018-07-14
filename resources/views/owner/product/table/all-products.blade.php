{{-- DISPLAY ALL PRODUCTS --}}
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- BEGGINING OWNER PROJECT -->
        <div class="portlet box primary">
          <div class="portlet-title">
            <div class="caption">
              <i data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                Project details
            </div>
          </div>
          <div class="portlet-body flip-scroll">
            <table class="table table-bordered table-striped table-condensed flip-content">
              <thead class="flip-content">
                <tr>
                  <th>Name</th>
                  <th>Size</th>
                  <th>Cost</th>
                  <th>Price</th>
                  <th>Time to prepare</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($allProducts['data'] as $product)
                <tr>
                  <td>{{ $product['name'] }}</td>
                  <td>{{ $product['size'] }}</td>
                  <td>{{ $product['cost'] }}</td>
                  <td>{{ $product['price'] }}</td>
                  <td>{{ $product['time_to_prepare']}} </td>
                  <td>
                  <a href="#"
                    title="details">
                    <i class="fa fa-fw fa-search"></i>
                  </a>
                  <a href="/owner/product/edit/{{ $product['id'] }}"
                    title="edit">
                    <i class="fa fa-fw fa-pencil" title="edit"></i>
                  </a>
                  <a href="/owner/product/delete/{{ $product['id'] }}"
                    onclick="return confirm('This will delete the product completely. Are you sure you want to proceed?')"
                    title="delete">
                    <i class="fa fa-fw fa-eraser"></i>
                  </a>
                </td>
              </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- END BEGGINING OWNER PROJECT-->
      </div>
    </div>
  </section>
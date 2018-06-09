<section class="content">
	<div class="row">
		<div class="col-lg-6">
			<!-- Stack charts strats here-->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
							<i class="livicon" data-name="barchart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Statistic
					</h3>
					<span class="pull-right">
					<i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
					<i class="glyphicon glyphicon-remove removepanel clickable"></i>
				</span>
				</div>
				<div class="panel-body">
					<div class="app">
						{!! $pie->html() !!}
					</div>
					<!-- End Of Main Application -->
				</div>
			</div>
		</div>
	</div>
</section>

{{-- page level scripts --}}
@section('footer_scripts')
  {!! Charts::scripts() !!}
	{!! $pie->script() !!}
	<script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
@stop
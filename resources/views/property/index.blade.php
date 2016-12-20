<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>Property Search</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset("css/styles.css") }}" />

	<script type="text/javascript">
		var APP_URL = {!! json_encode(url('/property')) !!};
	</script>

</head>
<body>
	
	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header nav-logo">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand" href="#">
                    <img src="{{URL::asset('/logo.png')}}" alt="Workhouse" width="150px" height="50px">
                </a>
            </div>
            <!-- /.navbar-header -->

            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
					{!! Form::open(['class' => 'property_form']) !!}
                    <ul class="nav" id="side-menu">
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            {!! Form::label('name', 'Name:', array('class' => '')) !!}
							{!! Form::text('name', null, ['class'=>'form-control name', 'placeholder'=>'Name']) !!}
                        </li>
						
						<li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            {!! Form::label('price', 'Price:', array('class' => '')) !!}
							{!! Form::text('start_price', null, ['class'=>'form-control start_price', 'placeholder'=>'Start Price']) !!}
							{!! Form::text('end_price', null, ['class'=>'form-control end_price', 'placeholder'=>'End Price']) !!}
                        </li>
						
						<li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            {!! Form::label('bathrooms', 'Bathrooms:', array('class' => '')) !!}
							{!! Form::text('bathrooms', null, ['class'=>'form-control bathrooms', 'placeholder'=>'Bathrooms']) !!}
                        </li>
						
						<li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            {!! Form::label('bedrooms', 'Bedrooms:', array('class' => '')) !!}
							{!! Form::text('bedrooms', null, ['class'=>'form-control bedrooms', 'placeholder'=>'Bedrooms']) !!}
                        </li>
						
						<li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            {!! Form::label('storeys', 'Storeys:', array('class' => '')) !!}
							{!! Form::text('storeys', null, ['class'=>'form-control storeys', 'placeholder'=>'Storeys']) !!}
                        </li>
						
						<li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            {!! Form::label('garages', 'Garages:', array('class' => '')) !!}
							{!! Form::text('garages', null, ['class'=>'form-control garages', 'placeholder'=>'Garages']) !!}
                        </li>
					</ul>
					{{ Form::submit('Search', array('class' => 'btn btn-primary property_search')) }}
					{{ Form::button('Clear', array('class' => 'btn btn-primary clear_form')) }}
					{!! Form::close() !!}
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
			<div class="row1">
                <div class="col-lg-12">
						<h4 class="page-header">Property</h4>
					<div class="table-responsive">
						<table class="table-bordered1 data_table table" id="propertysearch">
							<thead class="thead-inverse">
							<tr class="thead">
								<th>Name</th><th>Price</th><th width="10%">Bedrooms</th><th width="10%">Bathrooms</th><th width="10%">Storeys</th><th width="10%">Garages</th>
							</tr>
							</thead>
							<tbody class="tbody">
								<!-- Fetched data iteration -->
								@if (!empty($properties))
									@foreach( $properties as $property )
										<tr>
											<td>{!! $property->name !!}</td>
											<td>{!! $property->price !!}</td>
											<td>{!! $property->bedrooms !!}</td>
											<td>{!! $property->bathrooms !!}</td>
											<td>{!! $property->storeys !!}</td>
											<td>{!! $property->garages !!}</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td class="nodata" colspan="5">No records found!!!</td>
									</tr>
								@endif
							</tbody>
						</table> 
					</div>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				@yield('section')

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
	
	<script src="{{ asset("js/jquery-latest.min.js") }}" type="text/javascript"></script>	
	<script src="{{ asset("js/bootstrap.min.js") }}" type="text/javascript"></script>	
	
	<script type="text/javascript">
		$(document).on("click", ".property_search, .clear_form", function () {
			if($(this).hasClass("clear_form"))
				$('.property_form')[0].reset();
			/* Getting the search inputs */
			var name 		= $('input.name').val();
			var start_price = $('input.start_price').val();
			var end_price 	= $('input.end_price').val();
			var bathrooms 	= $('input.bathrooms').val();
			var bedrooms 	= $('input.bedrooms').val();
			var storeys 	= $('input.storeys').val();
			var garages 	= $('input.garages').val();
			if(!$(this).hasClass("clear_form"))
				$('.property_search').val('Searching...').css('background-color','#6FB7F1');
			$.ajax({
				headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
				type: 'POST',
				data: { 'name' : name, 'start_price' : start_price, 'end_price' : end_price, 'bathrooms' : bathrooms, 'bedrooms' : bedrooms, 'storeys' : storeys, 'garages' : garages  },
				url: '{{ URL::to('/property/search') }}',
				dataType: 'json',
				encode : true,
				success: function(result){
					// Append the result to the table return from ajax
					$('#propertysearch .tbody').html(result);
					if(!$(this).hasClass("clear_form"))
						$('.property_search').val('Search').css('background-color','#337ab7');
				}
			});
			return false;
		});
	</script>
	@yield('scripts')
</body>
</html>
@if( \Session::has('warning') )
<!-- WARNING MESSAGE //-->
<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> {{ \Session::get('warning') }}
	<button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

@if( !empty( $result->id ) )
	{!! Form::model($result, [ 'route' => [ $base . '.update', $result->id . $query_string ], 'method' => 'PUT', 'id' => $base, 'class' => 'crud-form' ] ) !!}
@else
	{!! Form::open( [ 'url' => $base . $query_string, 'id' => $base, 'class' => 'crud-form'] ) !!}
@endif

<div class="row">
	<input type="hidden" name="session_id" value="{{ \Session::getId() }}" />
	<div class="col-xs-12">
		<div class="module-header">
		  <div class="row">
		    <div class="col-xs-12 module-title"><i class="fa fa-pencil"></i> {{ !empty($result->id) ? $text_edit : $text_add }} {{ $title }} {{ !empty($result->id) ? '#' . $result->id : '' }} </div>
		  </div>
		</div>

		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab" class="prevent">{{ $tab_general }}</a></li>
			<li><a href="#tab-data" data-toggle="tab" class="prevent">{{ $tab_data }}</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active in" id="tab-general">

		   		<div class="form-group required">
					{!! Form::label('name', $form_name, [ 'class' => 'col-sm-2 control-label'] ) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, [ 'class' => 'form-control' ]) !!}
						<span class="error text-danger error_name"></span>
					</div>
		    	</div>

			</div>

			<div class="tab-pane fade" id="tab-data">

			</div>
		</div>
	</div>
</div>

<div class="row footer">
	<div class="col-xs-12">
		{!! Form::submit( $text_submit, [ 'class' => 'btn btn-primary', 'data-loading-text' => $text_loading ] ) !!}
		{!! HTML::link( url( $base . $query_string ), $text_back_to, [ 'class' => 'btn btn-default', 'id'=> 'cancel'] ) !!}
	</div>
</div>
{!! Form::close() !!}
<script src="{{ \Asset::cdn('js/crud/jquery.' . $base . '-form.js') }}" type="text/javascript"></script>

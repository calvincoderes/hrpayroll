<div class="row">
	<div class="col-xs-12">

		<div class="module-header">
		  <div class="row">
		    <div class="col-xs-12 module-title"><i class="fa fa-pencil"></i> {{ !empty($result->id) ? $text_edit : $text_add }} {{ $title }} {{ !empty($result->id) ? '#' . $result->id : '' }} </div>
		  </div>
		</div>	

		<!-- Form Elements -->
		<div class="form-group">
			{!! Form::label('name', $form_name, [ 'class' => 'col-sm-2 control-label'] ) !!}
			<div class="col-sm-10">
				<div class="input-group">
					{{ $result->name }}
				</div>
			</div>
		</div>

	</div>
</div>

<div class="row footer">
	<div class="col-xs-12">
		{!! HTML::link( url( $base . $query_string ), $text_back_to, [ 'class' => 'btn btn-default', 'id'=> 'cancel'] ) !!}	
	</div>
</div>
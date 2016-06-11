@if(\Request::ajax())
  @extends('layout')

@if( \Session::has('warning') )
<!-- WARNING MESSAGE //-->
<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> {{ \Session::get('warning') }}
  <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

@if( \Session::has('success') )
<!-- SUCCESS MESSAGE //-->
<div class="alert alert-success"><i class="fa fa-check-circle"></i> {{ \Session::get('success') }}
  <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

<div class="module-header">
  <div class="row">
    <div class="col-xs-6 module-title">{{ ucwords($title) }}</div>
    <div class="col-xs-6 text-right"><a href="{{ url( $base, [ 'create' ] ) . $query_string }}" title="Add {{ ucwords($title) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add {{ ucwords($title) }}</a></div>
  </div>
</div>

<!-- Filter Form-->
{!! Form::open( [ 'url' => $base, 'class' => 'crud-form-filter' ] ) !!}
<div class="well">

  <div class="row">

    <!-- Filter Name -->
    <div class="col-sm-3">
      <div class="form-group">
        {!! Form::label('filter_name', 'Name', [ 'class' => 'control-label'] ) !!}
        {!! Form::text('filter_name', Input::get('filter_name'), [ 'class' => 'form-control', 'placeholder' => 'Name', 'autocomplete' => 'off' ]) !!}
        <ul class="dropdown-menu"></ul>
      </div>
    </div>

    <!-- Filter Created At -->
    <div class="col-sm-3">
      <div class="form-group">
        {!! Form::label('filter_created_at', 'Created At', [ 'class' => 'control-label'] ) !!}
        <div class="input-group date">
          {!! Form::text('filter_created_at', Input::get('filter_created_at'), [ 'class' => 'form-control', 'placeholder' => 'Created At', 'data-format' => 'YYYY-MM-DD' ]) !!}
          <span class="input-group-btn">
            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
          </span>
        </div>
      </div>
    </div>

    <?php
    /*
    <!-- Page Hidden Field -->
    {!! Form::hidden('page', Input::get('page') ) !!}
    */ ?>

<!-- Filter Button -->
    <div class="col-sm-3">
      {!! Form::submit($text_filter, [ 'class' => 'btn btn-primary', 'data-loading-text' => $text_loading ] ) !!}
    </div>

  </div>

</div>
{!! Form::close() !!}

<form action="#" method="post" enctype="multipart/form-data" id="form-filter">
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <td class="text-left">Name</td>
          <td class="text-right">Action</td>
        </tr>
      </thead>
      <tbody>
  @foreach( $results as $result )
        <tr>
          <td class="text-left"><a href="{{ URL::to($result->module) }}?&session_id={{ $result->session_id }}&{{ $result->query }}">{{ $result->created_at }}</a></td>
          <td class="text-right">
            <a href="{{ url( $base, [ $result->id ] ) . $query_string }}" class="btn btn-info" data-toggle="modal" title="{{ $text_show }}"><i class="fa fa-search"></i></a>
            <a href="{{ url( $base, [ $result->id, 'edit' ] ) . $query_string }}" title="{{ $text_edit }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
    <a href="{{ url( $base, [ $result->id ] ) . $query_string }}" class="btn btn-danger remove" data-toggle="modal" title="{{ $text_remove }}"><i class="fa fa-times"></i></a>
          </td>
        </tr>
  @endforeach
      </tbody>
    </table>
  </div>
</form>

<div class="row">
  <div class="col-sm-12 text-center">Showing {{ $results->currentPage() }} of {{ $results->total() }} entries</div>
  <div class="col-sm-12 text-center">{!! $results->setPath( URL::to( $base ) )->appends( Input::all() )->render() !!}</div>
</div>
@endif

@section('styles')

@stop

@section('scripts')
<script src="{{ \Asset::cdn('js/crud/jquery.' . $base . '-list.js') }}" type="text/javascript"></script>
@stop

@if(!\Request::ajax() )
	<!-- HEADER - load if non ajax //-->
	@include('partials.header')

	<!-- MENU - load if non ajax //-->
	@include('partials.menu')
	
	<!-- FOOTER - load if non ajax //-->
	@include('partials.footer')
@endif
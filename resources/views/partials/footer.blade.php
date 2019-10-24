

	<!-- Image Modal Placeholder-->
	<div class="modal fade" id="crud-content" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">              
	      <div class="modal-body">
	      	<?php /*
	      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					*/ ?>
			
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Event modal -->
	<div class="modal fade" id="general-modal" tabindex="-1" role="dialog" aria-labelledby="general-modal-label" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title" id="general-modal-label"></h4>
	            </div>
	            <div class="modal-body">

	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            </div>
	        </div><!-- /.modal-content -->
	     </div><!-- /.modal-dialog -->
	</div>	

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{{ asset('js/jquery.js') }}"></script>

	<!-- Summernote JS -->
	<script type="text/javascript" src="{{ asset('js/summernote/summernote.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/daterangepicker/moment.js') }}"></script>		
	<script type="text/javascript" src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>

	<!-- Wow Plugin -->
	<!-- script type="text/javascript" src="{{ asset('js/wow.js') }}"></script-->
	
	<!-- easing plugin ( optional ) -->
	<script src="{{ asset('js/utop/js/easing.js') }}" type="text/javascript"></script>
	
	<!-- UItoTop plugin -->
	<script src="{{ asset('js/utop/js/jquery.ui.totop.js') }}" type="text/javascript"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="{{ asset('css/bootstrap/bootstrap.min.js') }}"></script>
    
	<!-- App Scripts -->
	<script src="{{ asset('js/select2/js/select2.min.js') }}" type="text/javascript"></script>

    <!-- App Scripts -->
	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

	<!-- Custom Scripts -->
	@yield('scripts')
	<script type="text/javascript">
	// new WOW().init();
	</script> 

	</body>
</html>
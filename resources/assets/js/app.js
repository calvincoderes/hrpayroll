(function($){
	var base = $(this);

    base.data = {};

    $.extend({
    	ModalBasedCrud: function ( param ) {
    		base.data = $.extend({ url : '', linkObject : null }, param);

    		base.init();
        }
    });

    base.init = function() {

		// Render Page
		base.render();


		$('.profile-usermenu li').eq(0).addClass('active');

		if( localStorage.getItem('active-module') ) {
			$('.profile-usermenu li').removeClass('active');
			$('.profile-usermenu li').eq(localStorage.getItem('active-module')).addClass('active');
		}


		// On click of Link
    	base.data.linkObject.click(function(e) {
			// If link prevent and img-thumbnail is triggered ( excempt )
			if( $(this).hasClass('prevent') || $(this).hasClass('img-thumbnail') || $(this).hasClass('close-modal'))
				return;
			
			e.preventDefault();
			
    		// Profile User menu
    		$('.profile-usermenu li').removeClass('active');
    		$(this).parents('li').addClass('active');

    		var index = $(this).parent().index('.profile-usermenu li');

    		localStorage.setItem('active-module', index );

			// Override the value of URL
			base.data.url = $(this).attr('href');

			if( history.pushState )
				history.pushState( null, null, base.data.url );

			// Render Page
			base.render();
    	});
    }

    // Render Page
    base.render = function() {

			// Loader
			//base.data.container.html('<h1><i class="fa fa-refresh fa-spin fa-3x fa-fw margin-bottom"></i></h1>');
			//$('#loader').remove();
			base.data.container.append('<div class="row" id="loader" ><h1 id="spinner"><i class="fa fa-refresh fa-spin fa-3x fa-fw margin-bottom"></i></h1></div>');
			// Page content loading
			$.ajax({
				url: base.data.url,
				dataType: 'html',
				cache: true,
				headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
				success: function(html) {

					// Load Page
					base.data.container.html(html);

					// Load Plugins
					base.plugins();

					// Auto save Drafts
					base.drafts();

					// Manage all Form for List Filter State
					base.index();

					// Manage all Form for Create and Edit State
					base.form();


				}
			});
    }

    // Form Drafts
    base.drafts = function() {

			if( base.get('session_id') !== '' && base.get('session_id') !== undefined && base.get('session_id') !== null ) {
				$.ajax({
					url: $('base').attr('href') + '/drafts-extract?session_id=' + base.get('session_id'),
					type: 'GET',
					headers: { "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content') },
					success: function(json){
						$.each(json, function(index, row){
								console.log(row);
								if( index !== '_token' && index !== '_method' && index !== 'url' ) {
									$('input[name="' + index + '"]').val(row);
								}
						});
					}
				});
			}


			$("form.crud-form :input, form textarea, form select").change(function() {
				var form = $('.crud-form');
				var baseUrl = $('base').attr('href');

		    $.ajax({
		    	url: $('base').attr('href') + '/drafts?url=' + encodeURIComponent(document.URL.split(baseUrl)[1]),
		    	type: 'POST',
		    	data: new FormData( form[0] ),
		    	cache: false,
		    	contentType: false,
		    	processData: false,
		    	dataType: 'json',
		    	headers: { "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content') },
		    	success: function (json) {
		    		console.log(json);
		    	}
		    });
			});
    }

		// Get URL Variables
		base.get = function(name, url) {
	    if (!url) url = window.location.href;
	    name = name.replace(/[\[\]]/g, "\\$&");
	    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
	        results = regex.exec(url);
	    if (!results) return null;
	    if (!results[2]) return '';
	    return decodeURIComponent(results[2].replace(/\+/g, " "));
		}

    // Load Plugins
    base.plugins = function() {

		// Select 2
		if( $('select.form-control').size() > 0 ) {
			$('select.form-control').select2();
			$(".form-tag").select2({
				tags: true
			});
		}

		if( $('.select2').size() > 0 )
			$('.select2').css('width', '100%');
    }

    // Manage all Form for List Filter State
    base.index = function() {

		base.data.container.find('a').click(function(e) {
			e.preventDefault();
		
			// If modal is closed
			if( $(this).hasClass('close-modal') )
					history.pushState( null, null, $(this).attr('href') );

			// If link prevent and img-thumbnail is triggered ( excempt )
			if( $(this).hasClass('prevent') || $(this).hasClass('img-thumbnail') || $(this).hasClass('close-modal'))
				return;

			// If button remove was clicked
			if( $(this).hasClass('remove') )
			{
				var url = $(this).attr('href');
				var html  = '<div class="text-center">';
						html += '<p class="lead">Are you sure you want to remove this record?</p>';
						html += '<a class="btn btn-info" href="#" data-dismiss="modal" id="confirm-remove">CONTINUE</a> ';
						html += '</div>';

				$("#general-modal .modal-body").html(html);
				$("#general-modal-label").html('<span class="glyphicon glyphicon-question-sign"></span> Confirmation');
				$("#general-modal").modal('show');

				$("#confirm-remove").click(function(e) {
					e.preventDefault();

					$.ajax({
						url: url,
						type: 'POST',
						cache: true,
						data: { _method: 'delete' },
						dataType : 'json',
						headers: { "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content') },
						success: function( json) {
							base.data.url = json['url'];

							if( history.pushState )
								history.pushState( null, null, base.data.url );

							base.render();
						},
						error: function (a,b,c) {

						}
					});
				});

			} else {

				// Assign current URL based on HREF
				base.data.url = $(this).attr('href');

				// Push State
				if( history.pushState )
					history.pushState( null, null, base.data.url );

				base.render();
			}
		});

		// Manage all Form for List Filter State
		base.filter();
    }

    // Manage all Form for List Filter State
    base.filter = function() {
			base.data.container.find('.crud-form-filter').submit(function ( e ) {
				e.preventDefault();

				$(this).find('input[name="_token"]').remove();

				var url = $(this).attr('action');
						url += '?' + $(this).serialize();

				base.data.url = url;

				if( history.pushState )
					history.pushState( null, null, base.data.url );

				base.render();

			});
    }

	// Manage all Form for Create and Edit State
    base.form = function() {
			base.data.container.find('.crud-form').submit(function(e) {
				e.preventDefault();

				$('.btn').attr('disabled', true);

				// Form
				var form = $(this);

			    // Form URL
			    var url = $(this).attr('action');

			    // URI Segments of URL
			    var uri = String(url).split('/');

			    $.ajax({
			    	url: url,
			    	type: 'POST',
			    	data: new FormData( form[0] ),
			    	cache: false,
			    	contentType: false,
			    	processData: false,
			    	dataType: 'json',
			    	headers: { "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content') },
			    	success: function (json) {

						$('.error').html('');

						if ( Number( json.error.count ) > 0 ) {

							$.each(json.error.messages, function(key, row) {
								var error = '';
								$.each(row, function(index, result) {

									if ( isNaN(result.length) ) {

										// Getting Sub Error
										$.each(result, function(key_sub, row_sub) {
											var error_sub = '';

											$.each(row_sub, function(index_sub, result_sub) {
												error_sub += '<p>' + result_sub + '</p>';
											});

											$('.error_' + key + '_' + key_sub).eq( index ).html( error_sub );
										});

									} else
										error += '<p>' + result + '</p>';
								});

								$('.error_' + key).html( error );

							});

							// If there's an error
							var html  = '<div class="text-center text-danger">';
								html += '<p>Check Fields with Errors</p>';
								html += '</div>';

							$("#general-modal .modal-body").html(html);
							$("#general-modal-label").html('<span class="glyphicon glyphicon-exclamation-sign"></span> Warning');
							$("#general-modal").modal('show');
							$('.btn').attr('disabled', false);

						} else {
							$('.btn').attr('disabled', false);

							base.data.url = json['url'];

							if( history.pushState )
								history.pushState( null, null, base.data.url );

							base.render();
						}
			    	}
			    });

			    return false;
			});
    }


})(jQuery);

//Used to detect initial (useless) popstate.
//If history.state exists, assume browser isn't going to fire initial popstate.
var popped = ('state' in window.history && window.history.state !== null), initialURL = location.href;

//If Back Button Was Clicked
$(window).bind('popstate', function (event) {
	var initialPop = !popped && location.href == initialURL;
	popped = true;

	$.ModalBasedCrud({
		url : document.URL,
		linkObject : $('a'),
		container: $('.crud-content')
	});

	if (initialPop) return;
});


$(function(){
	$.ModalBasedCrud({
		url : document.URL,
		linkObject : $('a'),
		container: $('.crud-content')
	});
});

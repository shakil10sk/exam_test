	<!-- js -->
	@if (env('APP_ENV') == 'production')
	<script src="{{ asset('js/script.min.js') }}"></script>
	@else
	<script src="{{ asset('js/script.js') }}"></script>
	@endif

	<script src="{{ asset('js/jquery-ui.js')}}"></script>

    <!-- add sweet alert js & css in footer -->
	<script src="{{ asset('js/sweetalert/sweetalert2.all.min.js')}}"></script>

	<script src="{{ asset('js/sweetalert/sweet-alert.init.min.js')}}"></script>


	{{-- this is for serverside datatable --}}
  	<script src="{{ asset('js/dataTables/jquery.dataTables.min.js') }}"></script>

	<script src="{{ asset('js/dataTables/dataTables.bootstrap4.min.js') }}"></script>

	<script src="{{ asset('js/dataTables/dataTables.responsive.min.js') }}"></script>

	<script src="{{ asset('js/dataTables/responsive.bootstrap4.min.js') }}"></script>

	<!-- buttons for Export datatable -->
	<script src="{{ asset('js/dataTables/button/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('js/dataTables/button/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('js/dataTables/button/buttons.print.min.js') }}"></script>
	<script src="{{ asset('js/dataTables/button/buttons.html5.min.js') }}"></script>
	<script src=" {{ asset('js/dataTables/button/buttons.flash.min.js') }}"></script>
	<script src="{{ asset('js/dataTables/button/pdfmake.min.js') }}"></script>
	<script src="{{ asset('js/dataTables/button/vfs_fonts.js') }}"></script>

	{{-- custom js --}}
	<script src="{{ asset('js/custom.js') }}"></script>

	{{-- this is for nagorik server site applicant list --}}

    <script>
        x = $('.footer-position').height(); // +20 gives space between div and footer
        y = $(window).height();
        if (x < 200){ // 100 is the height of your footer
            $('.footer-position').css('height', y+'px'); // again 100 is the height of your footer
            $('#footer').css('position', 'relative'); // again 100 is the height of your footer
            $('#footer').css('left', '0px'); // again 100 is the height of your footer
            $('#footer').css('bottom', '0px'); // again 100 is the height of your footer
        }else{
            $('#footer').removeAttr('style');
            $('.footer-position').removeAttr('style');
        }

		$('.date').datepicker({
			language: 'en',
			autoClose: true,
			dateFormat: 'yy-mm-dd',
		});

		// sidebar active anchor
		$('#accordion-menu li').each(function(){

			if($(this).find('a').attr('href') == window.location.href ){

				$(this).find('a').addClass('active');
				let a =  $(this).find('a');
				let li =a.closest('ul').parent();

				if(li.is("li"))
					$(this).find('a').closest('ul').parent().find('a.dropdown-toggle').addClass('active');

			}
		});
    </script>

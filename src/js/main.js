$(function () {
//		PRELOADER
	const PRELOADER = $('#preloader')
	if (PRELOADER.length) {
		PRELOADER.delay(100).fadeOut('fast', function () {
			$(this).remove()
		})
	}
//	Search Form
	let searchShow = false
	$('#toggle-search').click(function (e) {
		e.stopPropagation()
		const bar = $('#navbar-search');
		if (bar.hasClass('active')) {
			bar.removeClass('active')
			searchShow = false
		} else {
			bar.addClass('active')
			searchShow = true
		}
	})
	// SLIDER
	if (typeof jQuery().slick !== 'undefined') {
		$('#v-slider').slick({
			infinite: true,
			acenterMode: false,
			variableWidth: false,
			variableHeight: true,
			autoplay: true,
			arrows: false,
			dots: true,
			slidesToShow: window.slickParams.per_page,
			slidesToScroll: window.slickParams.step,
			centerPadding: '10px',
			swipe: false,
			touchMove: false,
			vertical: window.slickParams.vertical,
			useTransform: true,
		})
	}

	// LIGHTBOX
	if (typeof jQuery().Lightbox !== 'undefined') {

		$(document).on('click', '[data-toggle="lightbox"]', function (event) {
			event.preventDefault()
			$(this).Lightbox()
		})
	}

//	End Totally
})

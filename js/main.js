;(function () {
	
	'use strict';

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	
	var fullHeight = function() {

		if ( !isMobile.any() ) {
			$('.js-fullheight').css('height', $(window).height());
			$(window).resize(function(){
				$('.js-fullheight').css('height', $(window).height());
			});
		}
	};

	// Parallax
	var parallax = function() {
		$(window).stellar();
	};

	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated-fast') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn animated-fast');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft animated-fast');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight animated-fast');
							} else {
								el.addClass('fadeInUp animated-fast');
							}

							el.removeClass('item-animate');
						},  k * 100, 'easeInOutExpo' );
					});
					
				}, 50);
				
			}

		} , { offset: '85%' } );
	};



	var goToTop = function() {

		$('.js-gotop').on('click', function(event){
			
			event.preventDefault();

			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});

		$(window).scroll(function(){

			var $win = $(window);
			if ($win.scrollTop() > 200) {
				$('.js-top').addClass('active');
			} else {
				$('.js-top').removeClass('active');
			}

		});
	
	};

	var pieChart = function() {
		$('.chart').easyPieChart({
			scaleColor: false,
			lineWidth: 4,
			lineCap: 'butt',
			barColor: '#FF9000',
			trackColor:	"#f5f5f5",
			size: 160,
			animate: 1000
		});
	};

	var skillsWayPoint = function() {
		if ($('#fh5co-skills').length > 0 ) {
			$('#fh5co-skills').waypoint( function( direction ) {
										
				if( direction === 'down' && !$(this.element).hasClass('animated') ) {
					setTimeout( pieChart , 400);					
					$(this.element).addClass('animated');
				}
			} , { offset: '90%' } );
		}

	};

	var setupAccordions = function() {
		const accordions = Array.from(document.getElementsByClassName("accordion"));
		const accordions2 = Array.from(document.getElementsByClassName("accordion-main"));
	
		accordions.forEach((acc) => {
			acc.addEventListener('click', function () {
				this.classList.toggle('active');
				const panel = this.nextElementSibling;
				panel.classList.toggle('show');
			});
		});
	
		accordions2.forEach((acc) => {
			acc.addEventListener('click', function () {
				this.classList.toggle('active');
				const panel = this.nextElementSibling;
				panel.classList.toggle('show');
			});
		});
	};
	

	// Loading page
	var loaderPage = function() {
		$(".fh5co-loader").fadeOut("slow");
	};

	
	$(function(){
		contentWayPoint();
		goToTop();
		loaderPage();
		fullHeight();
		parallax();
		// pieChart();
		skillsWayPoint();
		setupAccordions();
	});


	document.getElementById('figmaPlaceholder').addEventListener('click', function () {
    this.innerHTML = '<iframe style="border: 1px solid rgba(0, 0, 0, 0.1); position: relative;" width="480" height="360" src="https://embed.figma.com/design/ChqS2fTMUBsrs9jbTP3mew/Intranet?node-id=215-86&embed-host=share" allowfullscreen></iframe>';
	});

	document.getElementById('figmaPlaceholder-2').addEventListener('click', function () {
    this.innerHTML = '<iframe style="border: 1px solid rgba(0, 0, 0, 0.1); position: relative;" width="480" height="360" src="https://embed.figma.com/design/ChqS2fTMUBsrs9jbTP3mew/Intranet?node-id=215-88&embed-host=share" allowfullscreen></iframe>';
	});

	document.getElementById('figmaPlaceholder-3').addEventListener('click', function () {
    this.innerHTML = '<iframe style="border: 1px solid rgba(0, 0, 0, 0.1); position: relative;" width="480" height="360" src="https://embed.figma.com/design/ChqS2fTMUBsrs9jbTP3mew/Intranet?node-id=249-3&embed-host=share" allowfullscreen></iframe>';
	});
}());
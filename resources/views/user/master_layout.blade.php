<!doctype html>
<html lang="ar">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="font/ttf">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{$PUBLIC_ASSETS}}/img/forweb2.jpg" type="image/x-icon">
	<title>
		{{$title}}
	</title>
      <script src="{{$PUBLIC_ASSETS}}/js/jquery-min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{$PUBLIC_ASSETS}}/css/jquery.mCustomScrollbar.min.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/main.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/slicknav.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/color-switcher.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/responsive.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/custom.css">
	
	<link rel="stylesheet" media="screen" href="{{$PUBLIC_ASSETS}}/fonts/simple-line-icons.css">

	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/owl/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/owl/owl.theme.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/animate.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/extras/normalize.css">
	<link rel="stylesheet" type="text/css" href="{{$PUBLIC_ASSETS}}/css/colors/green.css" media="screen">
	<link rel="stylesheet" id="colors" href="{{$PUBLIC_ASSETS}}/css/colors/green.css" type="text/css">
	<link rel="stylesheet" href="{{$PUBLIC_ASSETS}}/css/color-switcher.css" type="text/css">
	
 	
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
  	
  
          <link rel="stylesheet" href="{{$PUBLIC_ASSETS}}/css/jquery.social-buttons.css">
	<script src="{{$PUBLIC_ASSETS}}/js/custom.js"></script> 
	<script src="{{$PUBLIC_ASSETS}}/js/search.js"></script>
	<script src="{{$PUBLIC_ASSETS}}/js/jquery.social-buttons.js"></script>
	<script src="{{$PUBLIC_ASSETS}}/js/jquery.cookie.js"></script>
	<script src="{{url('public/translation/jquery.translate.js')}}"></script>
	<script src="{{url('public/scrol/autoscroll.js')}}"></script>


	<!-- overlay scrollbar files start -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.6.3/css/OverlayScrollbars.min.css">
	<link rel="stylesheet" href="{{$PUBLIC_ASSETS}}/css/os-theme-block-dark.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.6.3/js/OverlayScrollbars.min.js"></script>
	<!-- overlay scrollbar files end -->

	<style type="text/css">
	

		.sweet-alert {
			border: 2px solid #83ab33 !important;
  			box-shadow: 2px 2px 15px #999 !important;
		}

		.footerDrawer {
		  width: 100%;
		  position: fixed;
		  bottom: 59px;
		  z-index: 99;
		}

		.footerDrawer .open {
		  background-color: #dc5b9c;
		  text-align: center;
		  cursor: pointer;
		}

		.footerDrawer .content {
		  background-color: #ffbfcf;
		  display: none;
		  max-height: 40vh;
		  color: #214300;
		}


		.aboveDrawer {
		  width: 100%;
		  position: absolute;
		  /* top: 173px; */
		  z-index: 99;
		}

		.aboveDrawer .open {
		  background-color: #dc5b9c;
		  text-align: center;
		  cursor: pointer;
		}

		.aboveDrawer .content {
		  height: auto;
		  background-color: #ffbfcf;
		  display: none;
		  max-height: 40vh;
		  color: #214300;
		}

		.os-theme-block-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle:before {
			background: #8fbc8f;
			border-radius: 3px;
		}
		.os-theme-block-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle:hover:before, .os-theme-block-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle.active:before,
		html.os-html > .os-host.os-host-scrolling.os-theme-block-dark > .os-scrollbar > .os-scrollbar-track > .os-scrollbar-handle:before {
			background: #5f9f5f;
		}

	</style>
	@stack('css')
</head>
<body>


	
	@include('user/header')


	@yield('data')



	@include('user/footer')


	@stack('js')
	<script type="text/javascript">
	var menuOpened = false;
	var navOpen = false;
	
	function myFunction() {
		if(!navOpen) {
		document.querySelector('#logo + .inner-tabs').style.height = '395px';
		document.querySelector('.topnav').classList.add ('responsive');
		navOpen = true;
		}
		else {
			document.querySelector('#logo + .inner-tabs').style.height = '0';
			document.querySelector('.topnav').classList.remove ('responsive');
			navOpen = false;
		}
 	}
 
	var aboveDrawerOpen = false;
	var footerDrawerOpen = false;
	$('.footerDrawer > div .triangle, .intro-footnote div:last-child').on('click', function () {

		$('.footerDrawer .content').slideToggle(350, showstate);

		function showstate() {
			if ($(this).attr('style') === "display: none;") {
				$('.footerDrawer .open').show();

			} else {
				$('.footerDrawer .open').show();
			}
		}

		if (!footerDrawerOpen) {
			$('.footerDrawer > div .triangle').css({
				'transform': 'rotate(360deg)',
				'bottom': '-31px'
			});
			footerDrawerOpen = true;
		} else {
			$('.footerDrawer > div .triangle').css({
				'transform': 'rotate(180deg)',
				'bottom': '-7px'
			});
			footerDrawerOpen = false;
		}

		if ($('.aboveDrawer .content').css('display') === 'block') {
			$('.aboveDrawer .content').hide('350ms');
			$('.aboveDrawer .triangle').css({
				'transform': 'rotate(360deg)',
				'top': '-7px'
			});
			aboveDrawerOpen = false;
		}

		// hide main menu when clicked on triangle
		if($('.topnav').hasClass('responsive'))
		{
			$('.topnav').removeClass('responsive');
			$('#logo + .inner-tabs').css('height', '0');
			navOpen = false;
		}
	});

	
	$('.aboveDrawer .triangle, .intro-footnote div:first-child').on('click', function () {

		$('.aboveDrawer .content').slideToggle(350, showstate);

		function showstate() {
			if ($(this).attr('style') === "display: none;") {
				$('.aboveDrawer .open').show();


			} else {
				$('.aboveDrawer .open').show();
			}
		}


		if (!aboveDrawerOpen) {
			$('.aboveDrawer .triangle').css({
				'transform': 'rotate(180deg)',
				'top': '-31px'
			});
			aboveDrawerOpen = true;
		} else {
			$('.aboveDrawer .triangle').css({
				'transform': 'rotate(360deg)',
				'top': '-7px'
			});
			aboveDrawerOpen = false;
		}
		if ($('.footerDrawer .content').css('display') === 'block') {
			$('.footerDrawer .content').hide('350ms');
			$('.footerDrawer .triangle').css({
				'transform': 'rotate(180deg)',
				'bottom': '-7px'
			});
			footerDrawerOpen = false;
		}
		
		// hide main menu when clicked on triangle
		if($('.topnav').hasClass('responsive'))
		{
			$('.topnav').removeClass('responsive');
			$('#logo + .inner-tabs').css('height', '0');
			navOpen = false;
		}
	});

	// close aboveDrawer content and footerDrawer content when main menu is opened
	$('.topnav a.icon').click(function(){
			if($('.topnav').hasClass('responsive')) {
				if(($('.aboveDrawer .content').css('display') === 'block')) {
					$('.aboveDrawer .content').hide('350ms');
					$('.aboveDrawer .triangle').css({
						'transform': 'rotate(360deg)',
						'top': '-7px'
					});
					aboveDrawerOpen = false;
				}

				if ($('.footerDrawer .content').css('display') === 'block') {
				$('.footerDrawer .content').hide('350ms');
				$('.footerDrawer .triangle').css({
					'transform': 'rotate(180deg)',
					'bottom': '-7px'
				});
				footerDrawerOpen = false;
			}
		}
	});
	$('.color-dropdown-toggle').click(function(){
		  $(this).siblings('div').toggleClass('inline-block, hidden');
	  });

	  $('#font-color').prev().click(function(){
      $(this).toggleClass('turn');
	 });
	 
    $('#highlight-color').prev().click(function(){
      $(this).toggleClass('turn');
    });
	</script>

	<script>
	$(document).ready(function()
	{
          $('#Norwegian').trigger('click');
	});
	


    var dict = {
   "Home": {
     no: "Hjem"
   },
   "Search": {
     no: "Søk"
   },
   
   "Invite Friend": {
     no: "Inviter venn"
   },
   
   "Bug Reporting": {
     no: "Feilrapportering"
   },
      "Bookmarks": {
     no: "Bokmerker"
   },
   "Sura / Chapter": {
     no: "Surah / Kapittel"
   },
   "Juz": {
     no: "Juz"
   },
      "From Verse": {
     no: "Fra Vers"
   },
   "To Verse": {
     no: "Til Vers"
   },

      "Ruku": {
     no: "Ruku"
   },
     "Script": {
     no: "Arabic Tekst"
   },
     "Reciter": {
     no: "Resitert av"
   },
        "Tranlation": {
     no: "Oversettelse"
   },
     "Verse Repeat": {
     no: "Repeter vers"
   },
    "Range Repeat": {
     no: "Gjenta rekkevidde"
   },
   "Auto play next sura": {
     no: "Auto spill neste sura"
   },
   "Surah introduction": {
     no: "Surah introduksjon"
   },

   "Footnotes": {
     no: "Fotnoter"
   },
   "Surah introduction": {
     no: "Surah introduksjon"
   },
   "Chapter": {
     no: "Kapittel"
   },
"All Chapters": {
     no: "All kapitler"
   },

   "Language": {
     no: "Språk"
   },
   "With Immune": {
     no: "Med immunitet"
   },
   "Without Immune": {
     no: "Uten immunitet"
   },
    
     "Search Results": {
     no: "Søkeresultat"
   },
   "Send Invitation": {
     no: "Send invitasjon"
   },
   "Your name": {
     no: "Ditt navn"
   },
   "Your email": {
     no: "Din epost"
   },
   "Friend's email": {
     no: "Vennens post"
   },
   "Message": {
     no: "Melding"
   },
"Summary": {
     no: "Sammendrag"
   },
      "Get Bookmarks": {
     no: "Mine bokmerker"
   },

   "Arabic Text": {
     no: "Arabisk tekst"
   },

   "Arabic Audio": {
     no: "Arabisk lyd"
   },
   "Norsk Translation": {
     no: "Norsk oversettelse"
   },
   "Details": {
     no: "Beskrivelse"
   },
   "Total Search Count": {
     no: "Totale Søkeresultater"
   },
   "Font": {
     no: "Skrift farge"
   },
   "Highlight": {
     no: "Markeringsfarge"
   },
 }
 var _t = $('body').translate({

        lang: "en",
        t: dict
    });
    var str = _t.g("translate");
    console.log(str);
    $(".lang_selector").click(function(ev) {

        var lang = $(this).attr("data-value");
        if(lang=='no')
        {
 
           $('.English').removeClass('lang-selected');
           $('.English').addClass('lang-not-selected');
           $('.Norwegian').removeClass('lang-not-selected');
           $('.Norwegian').addClass('lang-selected');
        }
        else
        {
            
           $('.English').removeClass('lang-not-selected');
           $('.English').addClass('lang-selected');
           $('.Norwegian').removeClass('lang-selected');
           $('.Norwegian').addClass('lang-not-selected');
        }
        
        _t.lang(lang);
        console.log(lang);
        ev.preventDefault();
    });

		document.addEventListener("DOMContentLoaded", function () {
			OverlayScrollbars(document.querySelectorAll('#tran-side, #arab-side'), {
				className: 'os-theme-block-dark',
				scrollbars: {
					clickScrolling: true
				}
		 	});
		});
	</script>
</body>


</html>
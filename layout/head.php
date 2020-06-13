<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $_SESSION['judul']; ?> | <?php echo $_SESSION['desc']; ?></title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="lte/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="lte/dist/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="lte/dist/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="assets/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/buttons.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/sweetalert2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="lte/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
		 folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="lte/dist/css/skins/_all-skins.min.css">
<!-- jQuery 2.2.0 -->
<script src="lte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<link rel="icon" href="logoptatm.png">
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="assets/jquery.mousewheel.pack.js?v=3.1.3"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="assets/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="assets/jquery.fancybox.css?v=2.1.5" media="screen"/>

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="assets/helpers/jquery.fancybox-buttons.css?v=1.0.5"/>
<script type="text/javascript" src="assets/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="assets/helpers/jquery.fancybox-thumbs.css?v=1.0.7"/>
<script type="text/javascript" src="assets/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="assets/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<script type="text/javascript">
	$(document).ready(function () {
		/*
		 *  Simple image gallery. Uses default settings
		 */
		
		$('.fancybox').fancybox();
		
		/*
		 *  Different effects
		 */
		
		// Change title type, overlay closing speed
		$(".fancybox-effects-a").fancybox({
			helpers: {
				title: {
					type: 'outside'
				},
				overlay: {
					speedOut: 0
				}
			}
		});
		
		// Disable opening and closing animations, change title type
		$(".fancybox-effects-b").fancybox({
			openEffect: 'none',
			closeEffect: 'none',
			
			helpers: {
				title: {
					type: 'over'
				}
			}
		});
		
		// Set custom style, close if clicked, change title type and overlay color
		$(".fancybox-effects-c").fancybox({
			wrapCSS: 'fancybox-custom',
			closeClick: true,
			
			openEffect: 'none',
			
			helpers: {
				title: {
					type: 'inside'
				},
				overlay: {
					css: {
						'background': 'rgba(238,238,238,0.85)'
					}
				}
			}
		});
		
		// Remove padding, set opening and closing animations, close if clicked and disable overlay
		$(".fancybox-effects-d").fancybox({
			padding: 0,
			
			openEffect: 'elastic',
			openSpeed: 150,
			
			closeEffect: 'elastic',
			closeSpeed: 150,
			
			closeClick: true,
			
			helpers: {
				overlay: null
			}
		});
		
		/*
		 *  Button helper. Disable animations, hide close button, change title type and content
		 */
		
		$('.fancybox-buttons').fancybox({
			openEffect: 'none',
			closeEffect: 'none',
			
			prevEffect: 'none',
			nextEffect: 'none',
			
			closeBtn: false,
			
			helpers: {
				title: {
					type: 'inside'
				},
				buttons: {}
			},
			
			afterLoad: function () {
				this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			}
		});
		
		
		/*
		 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
		 */
		
		$('.fancybox-thumbs').fancybox({
			prevEffect: 'none',
			nextEffect: 'none',
			
			closeBtn: false,
			arrows: false,
			nextClick: true,
			
			helpers: {
				thumbs: {
					width: 50,
					height: 50
				}
			}
		});
		
		/*
		 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
		*/
		$('.fancybox-media')
		.attr('rel', 'media-gallery')
		.fancybox({
			openEffect: 'none',
			closeEffect: 'none',
			prevEffect: 'none',
			nextEffect: 'none',
			
			arrows: false,
			helpers: {
				media: {},
				buttons: {}
			}
		});
		
		/*
		 *  Open manually
		 */
		
		$("#fancybox-manual-a").click(function () {
			$.fancybox.open('1_b.jpg');
		});
		
		$("#fancybox-manual-b").click(function () {
			$.fancybox.open({
				href: 'iframe.html',
				type: 'iframe',
				padding: 10
			});
		});
		
		$("#fancybox-manual-c").click(function () {
			$.fancybox.open([
				{
					href: '1_b.jpg',
					title: 'My title'
				}, {
					href: '2_b.jpg',
					title: '2nd title'
				}, {
					href: '3_b.jpg'
				}
			], {
				helpers: {
					thumbs: {
						width: 75,
						height: 50
					}
				}
			});
		});
		
		
	});
</script>
<style type="text/css">
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}
	
	.disabled.day {
		background-color: rgba(0, 0, 0, 0.1);
	}
</style>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
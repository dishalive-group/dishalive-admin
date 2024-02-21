<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	@stack('meta')
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="/favicon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="assets/dashboard/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/dashboard/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/dashboard/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/dashboard/css/atlantis.css">
    
</head>

<body>
<!-- <div class="header">
        <div class="">
            <div class="col-md-5 mx-auto bg-light">
                <img src="/images/logo.png" alt="DishaLive Logo text-center" class="img-fluid w-25">
            </div>
        </div>
    </div>
</div> -->



@yield("main-section")
<!-- <div class="footer my-3">

</div> -->
<script src="assets/dashboard/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/dashboard/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/dashboard/js/core/popper.min.js"></script>
	<script src="assets/dashboard/js/core/bootstrap.min.js"></script>
	<script src="assets/dashboard/js/atlantis.min.js"></script>
</body>
</html>
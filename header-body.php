<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once("functions.php");
function putHeaderInfo() {
  $rows = fetchData("General-Info")->table->rows;
  $row = $rows[1];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php cell($row, 0) ?></title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta content="Handyman in Las Vegas Nevada" name="description">
		<meta content="handyman, contractor" name="keywords">
		<meta content="Polysemic Services" name="author">
		<!-- CSS -->    
		<link href="style/bootstrap.css" rel="stylesheet">
		<link href="style/font-awesome.min.css" rel="stylesheet">
		<link href="style/style.css" rel="stylesheet">
		<link href="style/handyman.css" rel="stylesheet">
		<link href="style/blueimp-gallery.min.css" rel="stylesheet">
<!--		<link href="img/favicon/favicon.png" rel="icon">
		<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>-->
		
		<!-- JS -->
<!--		<script src="js/jquery.js"></script>
		<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/jquery.anchor.js"></script>
		<script src="js/bootstrap.min.js"></script>
<!-<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>->
		<script src="js/jquery.blueimp-gallery.min.js"></script>
		<script src="js/bootstrap-image-gallery.min.js"></script>
<!-<script src="js/portfilter.js"></script>->
		<script src="js/servicesFilter.js"></script>
		<script src="js/mask.js"></script>
		<script src="js/custom.js"></script>-->

		<script src="js/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
		<!-- <script src="js/jquery-ui-1.8.10.custom.min.js" type="text/javascript"></script> -->
		<script src="js/jquery.anchor.js"></script>
		<script src="js/bootstrap.min.js"></script>
<!--<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>-->
		<script src="js/jquery.blueimp-gallery.min.js"></script>
		<script src="js/bootstrap-image-gallery.min.js"></script>
<!--<script src="js/portfilter.js"></script>-->
		<script src="js/mask.js"></script>
		<script src="js/servicesFilter.js"></script>

	</head>
	<body>
		<!-- Header -->
		<a id="homey"></a>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<!-- Logo or Name section -->
						<div class="logo">
							<h1 class="lmain"><?php cell($row, 0) ?></h1>
							<h2 class="lsub"><?php cell($row, 1) ?></h2>
						</div>
            <div id="contact-info-affixed">
						<div class="col-md-4 col-xs-12">
								<h1>My Business Name</h1>
						</div>
						<div class="col-md-8 col-xs-12">
							<div class="cta">
								<a href="tel:+1-123-456-7890"><i class="fa fa-phone"></i> 123-456-7890</a> <!-- Button to trigger modals --> <a class="" data-toggle="modal" data-target="#pageModal" href="contact.php"><i class="fa fa-money"></i> Free Estimate</a> <a href="http://dcgold.net/r/schedule/"><i class="fa fa-calendar"></i> Schedule Service</a>
							</div>
						</div>
					</div>
					</div>
				</div>
        
				<div class="row">
					<div class="carousel-container">
						<div class="carousel slide" id="carousel-example-captions">
							<div class="carousel-inner">
								<div class="item active">
									<img alt="900x500" src="img/photos/handyman-1.jpg">
									<div class="item-bg">
										<div class="carousel-caption-1">
											<h3><span class="fa fa-check-square-o"></span> First slide label</h3>
											<h4>First slide short statement</h4>
										</div>
										<div class="carousel-caption-2">
											<h5><span class="fa fa-check-square-o"></span> First slide sublabel</h5>
											<!-- <h6>Nulla vitae elit libero, a pharetra augue mollis interdum.</h6> -->
										</div>
										<div class="carousel-caption-3">
											<h5><span class="fa fa-check-square-o"></span> First slide sublabel</h5>
											<!-- <h6>Nulla vitae elit libero, a pharetra augue mollis interdum.</h6> -->
										</div>
                    
                    <div class="carousel-caption-3" id="vcard">
					<div id="contact-info">
						<div class="col-sm-12">
							<div class="cta">
								<a href="tel:+1-123-456-7890"><i class="fa fa-phone"></i> <?php cell($row, 5) ?></a> <!-- Button to trigger modals --> <a class="" data-toggle="modal" data-target="#pageModal" href="contact.php"><i class="fa fa-money"></i> Free Estimate</a>
							</div>
						</div>
					</div>
                    
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</header>
		<div class="modal fade" id="pageModal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<!-- navigation -->
		<nav class="navigation">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="navs">
							<!-- Navigation #1 -->
							<div class="box box-left">
								<a class="" data-toggle="modal" data-target="#pageModal" href="services.php">
									<div class="box-r box-d">
										<h3 class="top">My Services</h3>
										<p class="bor"></p>
										<h4 class="bot">How May I Help You?</h4>
									</div>
								</a>
								<div class="clearfix"></div>
							</div>
							<!-- Navigation #2 -->
							<div class="box box-right">
								<div class="box-r box-d">
									<a class="" data-toggle="modal" data-target="#pageModal" href="previous-jobs.php">
										<h3 class="top">Previous Jobs</h3>
										<p class="bor"></p>
										<h4 class="bot">Testimonials &amp; Images</h4>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<!-- Navigation #3 -->
							<div class="box box-left">
								<div class="box-r box-d">
									<a class="" data-toggle="modal" data-target="#pageModal" href="coupons.php">
										<h3 class="top">Coupons</h3>
										<p class="bor"></p>
										<h4 class="bot">Save Money!</h4>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<!-- Navigation #4 -->
							<div class="box box-last box-right">
								<div class="box-r box-d">
									<a class="" data-toggle="modal" data-target="#pageModal" href="about.php">
										<h3 class="top">About Me</h3>
										<p class="bor"></p>
										<h4 class="bot">Business &amp; Personal Info</h4>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>
    		<script>
			$("a[data-target=#pageModal]").click(function(ev) {
				ev.preventDefault();
				ev.stopPropagation();
				var target = $(this).attr("href");
				$("#pageModal").load("static.php?page=" + target.replace(/\.php$/, ""), function() {
					$("#pageModal").modal("show");
				});
			});
		</script>
<?php
}
?>
<div>
<?php putHeaderInfo() ?>
</div>


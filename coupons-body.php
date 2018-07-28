<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once("functions.php");
include("services_list.php");
function putCoupons() {
  $infoRows = fetchData("General-Info")->table->rows;
  $infoRow = $infoRows[1];
	$data = fetchData("Coupons");
    $i = 0;
	foreach($data->table->rows as $row) {
		if($i++ < 0)	//skip headers
			continue;
      putCoupon($row, $infoRow);
	}
		
	}

function putCoupon($row, $infoRow) {
?>
					<div class="col-sm-4 col-xs-12 col-xs-12" data-tag="all <?php cell($row, 0) ?>">
						<div class="img-wrapper padd">
							<!-- <img alt="one" class="img-responsive" src="/images/portfolio/400x300-3.gif"> -->
							<div class="post" id="printableArea<?php cell($row, 4) ?>">
								<div class="center">
									<div class="coupon-border">
									<div class="coupon"> 
										<div class="couponheader-print"><h1><?php cell($infoRow, 0) ?></h1></div>
										<div class="couponheader bluecoupon"><?php cell($row, 1) ?></div>
										<div class="coupondiscount"><?php cell($row, 2) ?></div>
										<div class="couponbody"><?php cell($row, 3) ?></div>
										<div class="couponphone"><?php cell($infoRow, 5) ?></div>
										<div class="couponcode"><small>Your Coupon Code:</small><br /><?php cell($row, 4) ?>-000-0000</div>
										<div class="couponterms"><?php cell($row, 5) ?><br /> EXPIRES: <?php cell($row, 6) ?></div> 
										<input type="button" class="btn btn-success btn-block" onclick="printDiv('printableArea<?php cell($row, 4) ?>')" value="Print Coupon" />
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
<?php
}
?>
      <div class="modal-dialog">
        <div class="modal-content">
<div class="modal-body">
	<article class="content-r content-d" id="div3">
		<div class="row">
			<div class="col-xs-11">
				<h1>Coupons and Discounts</h1>
			</div>
			<div class="col-xs-1 col-centered">
				<a class="anchorLink showSingle fa fa-minus-square-o fa-2x" data-dismiss="modal"></a>
			</div>
		</div>
		<div class="border"></div>
                <div class="row skills">
                    <div class="col-sm-2 col-xs-4">
                        <button class="skill btn btn-primary" data-target="all" data-toggle="servicesFilter">All</button>
                    </div>
                    <?php require_once('services_list.php'); ?>
                    <?php foreach ($my_services as $key => $service) { ?>
                        <div class="col-sm-2 col-xs-4">
                            <button class="skill btn btn-primary" data-toggle="servicesFilter" data-target="<?php echo $service ?>"> <?php echo $service ?></button>
                        </div>
                    <?php } ?>
                </div>
		<div class="border"></div>
		<div class="resume">
			<div id="links">
				<div id="coupons" data-delegate="#test" data-toggle="services-gallery" data-target="#services-gallery">	
<?php putCoupons() ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="border"></div>
<?php
readfile("contact-row.html");
?>
		</div>
	</article>
</div>
</div></div>
<script>
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
    window.location.reload();
    window.focus();
		window.print();
    window.close();
		document.body.innerHTML = originalContents;
	}
</script>

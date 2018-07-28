<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once("functions.php");
function putAboutMyBusiness() {
	$rows = fetchData("About")->table->rows;
  $row = $rows[1];
  $infoRows = fetchData("General-Info")->table->rows;
  $infoRow = $infoRows[1];
?>

	<article class="content-r content-d" id="div4">
		<div class="row">
			<div class="col-xs-11">
				<h1>About <?php cell($infoRow, 0) ?></h1>
			</div>
			<div class="col-xs-1 col-centered">
				<a class="anchorLink showSingle fa fa-minus-square-o fa-2x" data-dismiss="modal"></a>
        
			</div>
		</div>
		<div class="border"></div>
    
		<div class="resume">
<!-------------- I HOPE THIS SECTION CAN BE LOOPED AS MANY TIMES AS THERE ARE ROWS ----------------------->
		<?php for($i=1 ;$i<sizeof($rows);$i++) :?>  
			<div>
				<img alt="" class="profile" src="<?php cell($rows[$i], 0) ?>"> <!-- Social media icons -->
				<div class="social-icons">
					<i><?php cell($rows[$i], 2) ?></i> 
						<a href="<?php cell($rows[$i], 3) ?>" data-original-title="Facebook" class="tip"><i class="fa fa-facebook"></i></a>
						<a href="<?php cell($rows[$i], 4) ?>" data-original-title="Twitter" class="tip"><i class="fa fa-twitter"></i></a>
						<a href="<?php cell($rows[$i], 5) ?>" data-original-title="Linkedin" class="tip"><i class="fa fa-linkedin"></i></a>
						<a href="<?php cell($rows[$i], 6) ?>" data-original-title="Google Plus" class="tip"><i class="fa fa-google-plus"></i></a>
				</div>
				<!-- Content -->
				<p class="justified"><?php cell($rows[$i], 7) ?></p>
			</div>
		<?php endfor; ?>
<!-------------- END OF THE LOOPED SECTION, THE REST OF THE PAGE CAN BE GENERATED NORMALLY ------------------------>      
			<div class="clearfix"></div>
			<div class="border"></div>
			<div class="contact">
				<div class="row">
					<div class="col-md-7 col-sm-7">
						<div class="panel-body">
							<div class="address">
								<div class="row">
									<div class="col-md-7 col-sm-7">
										<address>
											<h3 class="color bold company"><?php cell($infoRow, 0) ?></h3>
											<?php cell($infoRow, 2) ?><br>
											<?php cell($infoRow, 3) ?><br>
										</address>
									</div>
									<div class="col-md-5 col-sm-5">
										<address>
											<h3 class="color bold company"><?php cell($infoRow, 4) ?></h3>
                      <abbr title="Phone">P:</abbr> <?php cell($infoRow, 5) ?> <br />
											<a href="mailto:<?php cell($infoRow, 6) ?>"><?php cell($infoRow, 6) ?></a>
										</address>
									</div>
									<div>
         								<div class="row">
									<div class="col-md-6 col-sm-6">           
<div style="width:200px; height:100px; padding:5px; text-align:center; border: 5px solid #787878">
<div style="width:150px; height:50px; padding:7px; text-align:center; border: 3px solid #787878">
       <span>Certificate of Completion</span>
</div>
</div>
</div>
									<div class="col-md-6 col-sm-6">
<div style="width:200px; height:100px; padding:20px; text-align:center; border: 10px solid #787878">
<div style="width:150px; height:50px; padding:20px; text-align:center; border: 5px solid #787878">
       <span>Certificate of Completion</span>
</div>
</div>
</div></div><br>
										Payments I Accept:<br>
<!-------------- PLEASE FIX THESE IF FUNCTIONS, SHOULD BE IF CELL IS NO, DO NOT SHOW ----------------------->                    
                    <?php
                    if(KUBAhub($row, 19) == 'Yes') {
										echo '<a data-original-title="I Accept Cash" class="tip"><img alt="Cash" src="img/payments/cash.png"></a>';
                    }
                    if(KUBAhub($row, 20)  == "Yes") {
										echo '<a data-original-title="I Accept Checks" class="tip"><img alt="Check" src="img/payments/check.png"></a>';  
                    }
                    if(KUBAhub($row, 21)  == "Yes") {
										echo '<a data-original-title="I Accept Visa" class="tip"><img alt="Visa" src="img/payments/visa.png"></a>';
                    }
                    if(KUBAhub($row, 22)  == "Yes") {
										echo '<a data-original-title="I Accept Mastercard" class="tip"><img alt="Mastercard" src="img/payments/mastercard.png"></a> ';
                    }
                    if (KUBAhub($row, 23) == "Yes") {
										echo '<a data-original-title="I Accept American Express" class="tip"><img alt="American Express" src="img/payments/amex.png"></a> ';
                    }
                    if (KUBAhub($row, 24)  == "Yes") {
										echo '<a data-original-title="I Accept Discover" class="tip"><img alt="Discover" src="img/payments/discover.png"></a>';
                    }
                    if (KUBAhub($row, 25)  == "Yes") {
										echo '<a data-original-title="I Accept Paypal" class="tip"><img alt="Paypal" src="img/payments/paypal.png"></a>';
                    }
                    if (KUBAhub($row, 26)  == "Yes") {
										echo '<a data-original-title="I Accept Google Wallet" class="tip"><img alt="Google Wallet" src="img/payments/google-wallet.png"></a>';
                    }?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5 col-sm-5">
						<div class="panel-body">
							<table class="table">
								<thead>
									<tr>
										<th>Day</th>
										<th>Hours</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Monday</td>
										<td><?php cell($row, 11) ?></td>
									</tr>
									<tr>
										<td>Tuesday</td>
										<td><?php cell($row, 12) ?></td>
									</tr>
									<tr>
										<td>Wednesday</td>
										<td><?php cell($row, 13) ?></td>
									</tr>
									<tr>
										<td>Thursday</td>
										<td><?php cell($row, 14) ?></td>
									</tr>
									<tr>
										<td>Friday</td>
										<td><?php cell($row, 15) ?></td>
									</tr>
									<tr>
										<td>Saturday</td>
										<td><?php cell($row, 16) ?></td>
									</tr>
									<tr>
										<td>Sunday</td>
										<td><?php cell($row, 17) ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		<div class="row">
			<div class="col-xs-12">
				<h2>My Service Area</h2>
			</div>
		</div>
		<div class="border"></div>
			<section class="row">
				<div class="panel-body">
					<div class="gmap col-sm-12">
						<a href="https://www.google.com/maps/d/edit?mid=z_BNNxXoiONw.k_nuyWTwvbMk&usp=sharing" target="_blank"><img alt="one" class="img-responsive" src="/templates/p6/img/service-area.jpg"></a>
					</div>
			<?php
readfile("contact-row.html");
?>
					</div>
				</div>
			</section>
		</div>
	</article>
  <script>
  // Tooltip
$('.tip').tooltip();
  </script>
<?php
}
?>
      <div class="modal-dialog">
        <div class="modal-content">
<div class="modal-body">
<?php putAboutMyBusiness() ?>
</div>
</div></div>


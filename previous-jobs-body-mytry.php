<?php ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
	
	require_once("functions.php");
	$listr='';
	$i = 0;
	$data1 = fetchData("Previous-Jobs");
	$my_services1 = array("Interior", "Exterior", "Plumbing", "Electrical", "Garages", "Fiverr");	
	foreach ($my_services1 as $tag1) {
		if (!empty($data1->table->rows)) {	
			foreach ($data1->table->rows as $row1) {
			  if($i++ < 2)	//skip headers
			  continue;
				if ($row1->c && $row1->c[0] && $row1->c[0]->v == $tag1) {
					$name = preg_replace("/-+/", "-", preg_replace("/[^-a-z0-9]+/", "", str_replace(array(" ", "/"), "-", strtolower($row1->c[1]->v))));
					$page1 = "previous/$name.html";
					$url1 = "previous/$name";
					if(file_exists($url1.".html")){
						$listr.="{title: '".$row1->c[1]->v."',href: 'detail-modal.php?page=".$url1."',type: 'text/html'},";
					}
				}
			}
		}
	}
	
	function putServices() {
		$data = fetchData("Previous-Jobs");
		include("services_list.php");
		
		//$my_services = array("Interior", "Exterior", "Plumbing", "Electrical", "Garages", "Fiverr");
		foreach ($my_services as $tag) {
			putService($tag, $data);
		}
		
	}
	
	function putService($tag, $data) {
	?>
    <section class="row" data-tag="<?php echo $tag ?>" id="<?php echo strtolower($tag) ?>">
        <div class="col-md-2 col-sm-2">
            <h3><?php echo $tag ?></h3>
		</div>
        <div class="col-md-10 col-sm-10">
            <div class="rcontent">
                <div class="row skills">
                    <ul class="searchable">
						
                        <?php $listr1='';
							if (!empty($data->table->rows)) {
								
								foreach ($data->table->rows as $row) {
									
									if ($row->c && $row->c[0] && $row->c[0]->v == $tag) {
										$page = $row->c[2]->v;
										$url = "#";
										
											$name = preg_replace("/-+/", "-", preg_replace("/[^-a-z0-9]+/", "", str_replace(array(" ", "/"), "-", strtolower($row->c[1]->v))));
											$page = "previous/$name.html";
											$url = "previous/$name";

											$str = "<div class=\"modal-dialog\">
	                                              <div class=\"modal-content\">
	                                                <div class=\"modal-body\">
	                                                  <div class=\"row\">
	                                                    <div class=\"col-xs-11\">
	                                                      <h1>"
	                                                        . $row->c[1]->v .
	                                                      "</h1>
	                                                    </div>
	                                                    <div class=\"col-xs-1 col-centered\">
	                                                      <a class=\"anchorLink showSingle fa fa-minus-square-o fa-2x\" data-dismiss=\"modal\"></a>
	                                                    </div>
	                                                  </div>
	                                                  <div class=\"border\"></div>
	                                                  <div class=\"row\">
	                                                  <div class=\"col-xs-12\">
                                                    <div class=\"slider\">";
               for($i = 1, $a = 1; $i < 7; $i++, $a+=2) {  
			   if($i == 1){$checked='checked=\"checked\"';}
                $str.="<input type=\"radio\" name=\"slide_switch\" id=\"id".$i ."\"" . $checked ."/><label for=\"id".$i ."\"><img src=\"" . cell($row, 7+$i+$a) . "\" width=\"100\"/></label><img src=\"". cell($row, 7+$i+$a) ."\"/>
                <span>" . cell($row, 6+$i+$a) . "</span>";
                 } 
               $str.="</div>
                <blockquote cite=\" \" class=\"test-bub\">
                <p>" . cell($row, 7) . "</p><p class=\"test-quote\">" . cell($row, 3) . "</p></blockquote>\""
                                                     .
	                                                    @$row->c[1]->v .
	                                                    @$row->c[2]->v .
	                                                    @$row->c[3]->v .
	                                                    @$row->c[4]->v .
	                                                    @$row->c[5]->v .
	                                                  "</div>
	                                                </div>
	                                              </div> 
	                                            </div></div>";
	                                            $fp = fopen(getcwd() . "/$page", 'w');
	                                            fwrite($fp, $str);
	                                            fclose($fp);										
											
										
										$listr1="{title: '".$row1->c[1]->v."',href: 'detail-modal.php?page=".$url."',type: 'text/html'},";
										
										echo "<li class=\"col-md-6 col-sm-6\"><a href='javascript:'  data-toggle=\"modal\" data-target=\"#servicesModal\" data-title=\"" . $url . "\" name=" . $url . ">" . $row->c[1]->v . "</a></li>\n";
										
							
									}
								}
							}
						?>
					</ul> 
				</div>
			</div>
		</div>
	</section>
	
    <div class="border" data-tag="<?php echo $tag ?>"></div>
    <?php
	}
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <article class="content-r content-d" id="div1">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-11">
                        <h1>My Services</h1>
					</div>
                    <div class="col-md-1 col-sm-1 col-xs-1 col-sm-push-8 col-centered">
                        <a class="anchorLink showSingle fa fa-minus-square-o fa-2x" data-dismiss="modal"></a>
					</div>
                    <div class="col-md-8 col-sm-8 col-xs-12 col-sm-pull-1">
                        <div class="service-input">
                            <label class="fa fa-search flatui" for="problem"></label><input class="form-control filter feedback-input" id="problem" placeholder="Search the services I provide..." type="text">
						</div>
					</div>
				</div>
                <div class="border"></div>
                <div class="row skills">
                    <div class="col-sm-2 col-xs-4">
                        <button class="skill btn btn-primary" data-target="allServices" data-toggle="servicesFilter">All</button>
					</div>
                    <?php require_once('services_list.php'); ?>
                    <?php foreach ($my_services as $key => $service) { ?>
                        <div class="col-sm-2 col-xs-4">
                            <button class="skill btn btn-primary" data-toggle="servicesFilter" data-target="<?php echo $service ?>"> <?php echo $service ?></button>
						</div>
					<?php } ?>
				</div>
                <div class="border"></div>
                <!-- Content -->
                <div class="resume">
                    <?php putServices() ?>
                    <?php readfile("contact-row.html"); ?>
				</div>
			</article>
		</div>
	</div>
</div>






<script>
	
	blueimp.Gallery.prototype.textFactory = function (obj, callback) {
		var $element = $('<div>')
		.addClass('text-content')
		.attr('title', obj.title);
		$.get(obj.href)
        .done(function (result) {
            $element.html(result);
            callback({
                type: 'load',
                target: $element[0]
			});
		})
        .fail(function () {
            callback({
                type: 'error',
                target: $element[0]
			});
		});
		return $element[0];
	};
	
	var flag=1;
    
	$("a[data-target=#servicesModal]").click(function (e) {
		e.preventDefault();
		//if(flag==1){
		if($(this).attr("data-title")!="#")
		{
		var gallery=blueimp.Gallery([		
		<?php if($listr){?>
			<?php echo $listr;?>
		<?php }?>
		], $('#blueimp-gallery').data());
			//flag=0;
			//}
			if($(this).attr("name")!=0){
				gallery.slide($(this).attr("name"));
			}
		}
	});
	$(".anchorLink").click(function (e) {
	gallery.close();
	});
	
	
	// Filter 
    $(document).on("click", ".filter", function (event) {
        (function ($) {
            $('.filter').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                $('.searchable li').hide();
                $('.searchable li').filter(function () {
                    return rex.test($(this).text());
				}).show();
			})
		}(jQuery));
	});
    
</script>










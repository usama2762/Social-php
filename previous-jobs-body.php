<?php
	error_reporting(0);
	session_start();
	require_once("functions.php");
	$listr='';
	$data1 = fetchData("Previous-Jobs");
	$my_services1 = array("Interior", "Exterior", "Plumbing", "Electrical", "Garages", "Fiverr");	
	foreach ($my_services1 as $tag1) {
		if (!empty($data1->table->rows)) {	
			foreach ($data1->table->rows as $row1) {
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
	$i=0;
	unset($_SESSION['i']);
	function putPreviousJobs() {
		$data = fetchData("Previous-Jobs");
		$i = 0;
		foreach($data->table->rows as $row) {
			if($i++ < 2)	//skip headers
				continue;
			putPreviousJob($row);
		}
	}
	
	function putPreviousJob($row)
	{
        $listr1='';
        if($_SESSION['i']){
        	$i=$_SESSION['i'];
        }
        else{
	        $i=0;
	    }
		if (!empty($row))
		{
			$name = preg_replace("/-+/", "-", preg_replace("/[^-a-z0-9]+/", "", str_replace(array(" ", "/"), "-", strtolower($row->c[1]->v))));
			$page = "previous/$name.html";
			$url = "previous/$name";
			$str='<div class="col-sm-4 col-xs-12 col-xs-12 flexbox" data-tag="'.$row->c[0]->v. '">
				<div class="img-wrapper padd col">
					<a href="'.$row->c[4]->v. '" rel="gallery" title="'.$row->c[1]->v. '" 
		              data-description="<div class="slider">';
			            	for($i = 1, $a = 1; $i < 7; $i++, $a+=2)
			            	{
					            $str.='<input type="radio" name="slide_switch" id="id'.$row->c[$i]->v.'"';
				                if($i == 1)
				                {
					                $str.=' checked="checked"';
					            }
				            	$str.='/>'.
				            	'<label for="id'.$row->c[1]->v.'">'.
				                	'<img src="'.$row->c[7+$i+$a]->v.'" width="100"/>
				                </label>
				                <img src="'.$row->c[7+$i+$a]->v.'"/>
				                <span>'.$row->c[6+$i+$a]->v. '</span>';
				            }
			        	$str.='</div>
			            <blockquote cite="" class="test-bub">
				            <p>'.$row->c[7]->v.'</p>
				            <p class="test-quote">'.
				            $row->c[3]->v.
				            '</p>
			            </blockquote>">
			        </a>
		            <div class="imgClip"><img alt="one" class="img-responsive" src="'.$row->c[4]->v.'"/></div>
		            <h3><a href="#project-link">'.$row->c[1]->v.'</a></h3>
		            <blockquote cite="" class="test-bub">
			            <p>... '.$row->c[2]->v.' ...<a href="#">more</a></p>
			            <p class="test-quote">'.$row->c[3]->v.'</p>
		            </blockquote>
		        </div>
		    </div>';

            $fp = fopen(getcwd() . "/$page", 'w');
            fwrite($fp, $str);
            fclose($fp);

			$listr1='{title: "'.$row1->c[1]->v.'",href: "detail-modal.php?page='.$url.'",type: "text/html"},';
		
			if(file_exists($url.".html")){
				$_SESSION['i']=$i;
			}
			?>
			<div class="col-sm-4 col-xs-12 col-xs-12 flexbox" data-tag="<?php cell($row, 0) ?>">
				<div class="img-wrapper padd col">
					<a href="<?php cell($row, 4) ?>" rel="gallery" title="<?php cell($row, 1) ?>" 
		              data-description="
			            <div class='slider'>
			            	<?php for($i = 1, $a = 1; $i < 7; $i++, $a+=2) { ?>
			                <input type='radio' name='slide_switch' id='id<?php echo $i ?>'<?php if($i == 1) echo ' checked=\'checked\'' ?>/>
			                <label for='id<?php echo $i ?>'>
			                	<img src='<?php cell($row, 7+$i+$a) ?>' width='100'/>
			                </label>
			                <img src='<?php cell($row, 7+$i+$a) ?>'/>
			                <span><?php cell($row, 6+$i+$a) ?></span>
			                <?php } ?>
			        	</div>
			            <blockquote cite='' class='test-bub'>
				            <p><?php cell($row, 7) ?></p>
				            <p class='test-quote'>
				            <?php cell($row, 3) ?>
				            </p>
			            </blockquote>">
			        </a>
		            <div class="imgClip"><img alt="one" class="img-responsive" src="<?php cell($row, 4) ?>"/></div>
		            <h3><a href="#project-link"><?php cell($row, 1) ?></a></h3>
		            <blockquote cite="" class="test-bub">
			            <p>... <?php cell($row, 2) ?> ...<a href="#">more</a></p>
			            <p class="test-quote"><?php cell($row, 3) ?></p>
		            </blockquote>
		        </div>
		    </div>
			<?php
			if(file_exists($url.".html")){
				$i++;
			}
		}
	}?>

<div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-body">
			<article class="content-r content-d" id="div2">
				<div class="row">
					<div class="col-xs-11">
						<h1>Previous Jobs and Testimonials</h1>
					</div>
					<div class="col-xs-1 col-centered">
						<a class="anchorLink showSingle fa fa-minus-square-o fa-2x" data-dismiss="modal"></a>
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
                        <button class="skill btn btn-primary" data-toggle="servicesFilter" data-target="<?php echo $service; ?>" > <?php echo $service; ?></button>
                    </div>
                    <?php } ?>
                </div>
				<div class="resume">
					<div id="links">
						<div id="Grid" data-delegate="#Grid" data-toggle="services-gallery" data-target="#services-gallery">
						<?php putPreviousJobs(); ?>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="border"></div>
					<?php readfile("contact-row.html");?>
				</div>
			</article>
		</div>
	</div>
</div>
<script type="text/javascript">
	
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
		<?php if( $listr )
		{ 
			echo $listr;
		}?>
		], $('#blueimp-gallery').data());
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
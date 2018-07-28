$(function() {

    //Console logging (html)
    if (!window.console)
        console = {};
    
    var console_out = document.getElementById('console_out');
    var output_format = "jpg";

    console.log = function(message) {
        console_out.innerHTML += message + '<br />';
        console_out.scrollTop = console_out.scrollHeight;
    }
	
    //Slider init
    $("#slider-range-min").slider({
        range: "min",
        value: 40,
        min: 1,
        max: 100,
        slide: function(event, ui) {
            $("#jpeg_encode_quality").val(ui.value);
        }
    });
    $("#jpeg_encode_quality").val($("#slider-range-min").slider("value"));

    /** DRAG AND DROP STUFF WITH FILE API **/
    var holder = document.getElementById('holder');
    
    holder.ondragover = function() {
        this.className = 'is_hover';
        return false;
    };
    holder.ondragend = function() {
        this.className = '';
        return false;
    };
    holder.ondrop = function(e) {
        this.className = '';
        e.preventDefault();
        
        document.getElementById("holder_helper").removeChild(document.getElementById("holder_helper_title"));
        
        var file = e.dataTransfer.files[0],              
        reader = new FileReader();
        reader.onload = function(event) {
            var i = document.getElementById("source_image");
           	 	i.src = event.target.result;
           	 	i.onload = function(){
           	 		image_width=$(i).width(),
	                image_height=$(i).height();
	
	                if(image_width > image_height){
	                	i.style.width="320px";
	                }else{
	                	i.style.height="300px";
	                }
	                i.style.display = "block";
	                console.log("Image loaded");

           	 	}
                
        };
        
        if(file.type=="image/png"){
            output_format = "png";
        }

        console.log("Filename:" + file.name);
        console.log("Filesize:" + (parseInt(file.size) / 1024) + " Kb");
        console.log("Type:" + file.type);
        
        reader.readAsDataURL(file);
        
        return false;
    };
    
    var encodeButton = document.getElementById('jpeg_encode_button');
   
    //HANDLE UPLOAD BUTTON
    var uploadButton = document.getElementById("jpeg_upload_button");
    uploadButton.addEventListener('click', function(e) {
        
        //----------------------------------------------------------------
        
        var inval = $('input[type=file]').val();
        //alert(inval);
        
        var full_name = $('input[id=full_name]');
        var phone = $('input[id=phone]');
        var email = $('input[id=email]');
        var comments = $('textarea[id=comments]');
        
        //---------------------------------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------------------------------
        
        var full_nam = full_name;
        var phn = phone;
        var eml = email;
        var comts = comments;
        var email_re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
        var phone_re = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;

        //Simple validation to make sure user entered something
        //If error found, add hightlight class to the text field
        if (full_nam.val() == '') {
            $('.fname-div').addClass('hightlight');
            document.getElementById('incomplete-fname').style.display = '';
            document.getElementById('complete-fname').style.display = 'none';
            $('#full_name').removeAttr('placeholder');
            return false;
        } else
            $('.fname-div').removeClass('hightlight');
        document.getElementById('incomplete-fname').style.display = 'none';
        document.getElementById('complete-fname').style.display = '';

        if (phn.val() == '' || !phone_re.test(phone.val())) {
            $('.phone-div').addClass('hightlight');
            document.getElementById('incomplete-phone').style.display = '';
            document.getElementById('complete-phone').style.display = 'none';
            $('#phone').removeAttr('placeholder');
            return false;
        } else
            $('.phone-div').removeClass('hightlight');
        document.getElementById('incomplete-phone').style.display = 'none';
        document.getElementById('complete-phone').style.display = '';

        if (eml.val() == '' || !email_re.test(email.val())) {
            $('.email-div').addClass('hightlight');
            document.getElementById('incomplete-email').style.display = '';
            document.getElementById('complete-email').style.display = 'none';
            $('#email').removeAttr('placeholder');
            return false;
        } else
            $('.email-div').removeClass('hightlight');
        document.getElementById('incomplete-email').style.display = 'none';
        document.getElementById('complete-email').style.display = '';

        if (comts.val() == '') {
            $('.comments-div').addClass('hightlight');
            document.getElementById('incomplete-comments').style.display = '';
            document.getElementById('complete-comments').style.display = 'none';
            $('#comments').removeAttr('placeholder');
            return false;
        } else
            $('.comments-div').removeClass('hightlight');
        document.getElementById('incomplete-comments').style.display = 'none';
        document.getElementById('complete-comments').style.display = '';


        //disabled all the text fields
        $('.text').attr('disabled', 'true');
        
        //------------------------------------------------------------------------------------------------------------------
        //----------------------------------------------------------------
        
	var filesAdded = false;
       	jQuery('.filesInput').each(function(item){
		if(jQuery(this).val()) filesAdded = true;
	});

// -- djrc old code        if(inval == "")
        if(!filesAdded)
        {
            jic.dtls(full_name, phone, email, comments);
        }
        else 
        {

            var encodeQuality = document.getElementById('jpeg_encode_quality');

            var quality = parseInt(encodeQuality.value);
	
		var imagesToSend=Array();
		jQuery(".sourceImages").each(function(e){
			var key = jQuery(this).attr("id");
			key  = key.replace(/^source_image_(File.*)$/,"$1");
			var filetype = jQuery(this).attr("src").replace(/^data:(.+)\;/,"$1");
			jQuery("#result_image"+key)[0].src = jic.compress(jQuery("#source_image_"+key)[0],quality,filetype).src;
			imagesToSend.push(jQuery("#result_image"+key)[0]);
		});

            var callback= function(response){
                    console.log("image uploaded successfully! :)");
                    console.log(response);        	
            }

            var fnam = full_name.val();

            jic.upload(imagesToSend, 'send_formPHPMailer.php', 'file', fnam, full_name, phone, email, comments,callback);
        
        }
        
       
    }, false);

/*** END OF DRAG & DROP STUFF WITH FILE API **/

});



/*!
 * JIC JavaScript Library v1.1
 * https://github.com/brunobar79/J-I-C/
 *
 * Copyright 2012, Bruno Barbieri
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Date: Sat Mar 24 15:11:03 2012 -0200
 */



/**
 * Create the jic object.
 * @constructor
 */

var jicImp = {
        /**
         * Receives an Image Object (can be JPG OR PNG) and returns a new Image Object compressed
         * @param {Image} source_img_obj The source Image Object
         * @param {Integer} quality The output quality of Image Object
         * @param {String} output format. Possible values are jpg and png
         * @return {Image} result_image_obj The compressed Image Object
         */

        compress: function(source_img_obj, quality, output_format){
             
             var mime_type = "image/jpeg";
             if(typeof output_format !== "undefined" && output_format=="png"){
                mime_type = "image/png";
             }
             

             var cvs = document.createElement('canvas');
             cvs.width = source_img_obj.naturalWidth;
             cvs.height = source_img_obj.naturalHeight;
             var ctx = cvs.getContext("2d").drawImage(source_img_obj, 0, 0);
             var newImageData = cvs.toDataURL(mime_type, quality/100);
             var result_image_obj = new Image();
             result_image_obj.src = newImageData;
             return result_image_obj;
        },

        /**
         * Receives an Image Object and upload it to the server via ajax
         * @param {Image} compressed_img_obj The Compressed Image Objects
         * @param {String} The server side url to send the POST request
         * @param {String} file_input_name The name of the input that the server will receive with the file
         * @param {String} filename The name of the file that will be sent to the server
         * @param {function} successCallback The callback to trigger when the upload is succesful.
         * @param {function} (OPTIONAL) errorCallback The callback to trigger when the upload failed.
         * @param {function} (OPTIONAL) duringCallback The callback called to be notified about the image's upload progress.
         * @param {Object} (OPTIONAL) customHeaders An object representing key-value  properties to inject to the request header.
         */

        upload: function(compressed_img_objects, upload_url, file_input_name, filename, fnam, phn, eml, cmts, successCallback, errorCallback, duringCallback, customHeaders){
            
          //------------------------------------------------------------------------------------------------------------------------------------
          
          
        var full_name = fnam;
        var phone = phn;
        var email = eml;
        var comments = cmts;
        var email_re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
        var phone_re = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;

        //Simple validation to make sure user entered something
        //If error found, add hightlight class to the text field
        if (full_name.val() == '') {
            $('.fname-div').addClass('hightlight');
            document.getElementById('incomplete-fname').style.display = '';
            document.getElementById('complete-fname').style.display = 'none';
            $('#full_name').removeAttr('placeholder');
            return false;
        } else
            $('.fname-div').removeClass('hightlight');
        document.getElementById('incomplete-fname').style.display = 'none';
        document.getElementById('complete-fname').style.display = '';

        if (phone.val() == '' || !phone_re.test(phone.val())) {
            $('.phone-div').addClass('hightlight');
            document.getElementById('incomplete-phone').style.display = '';
            document.getElementById('complete-phone').style.display = 'none';
            $('#phone').removeAttr('placeholder');
            return false;
        } else
            $('.phone-div').removeClass('hightlight');
        document.getElementById('incomplete-phone').style.display = 'none';
        document.getElementById('complete-phone').style.display = '';

        if (email.val() == '' || !email_re.test(email.val())) {
            $('.email-div').addClass('hightlight');
            document.getElementById('incomplete-email').style.display = '';
            document.getElementById('complete-email').style.display = 'none';
            $('#email').removeAttr('placeholder');
            return false;
        } else
            $('.email-div').removeClass('hightlight');
        document.getElementById('incomplete-email').style.display = 'none';
        document.getElementById('complete-email').style.display = '';

        if (comments.val() == '') {
            $('.comments-div').addClass('hightlight');
            document.getElementById('incomplete-comments').style.display = '';
            document.getElementById('complete-comments').style.display = 'none';
            $('#comments').removeAttr('placeholder');
            return false;
        } else
            $('.comments-div').removeClass('hightlight');
        document.getElementById('incomplete-comments').style.display = 'none';
        document.getElementById('complete-comments').style.display = '';

        //organize the data properly
        var data_1 = 'fist_name=' + full_name.val() + '&phone=' + phone.val() + '&email='
                + email.val() + '&comments=' + encodeURIComponent(comments.val());

        //disabled all the text fields
        $('.text').attr('disabled', 'true');

        //show the loading sign
        $('#loading').show();

        $("button#go-back").click(function () {
            location.reload();
        });
          
          
          
          
          
          
          //-------------------------------------------------------------------------------------------------------------------------------------
            var bodyData ="";
            var boundary = 'someboundary';
	var counter = 0;
	jQuery.each(compressed_img_objects,function(key,compressed_img_obj){
	    counter++;
            
            var cvs = document.createElement('canvas');
            cvs.width = compressed_img_obj.naturalWidth;
            cvs.height = compressed_img_obj.naturalHeight;
            var ctx = cvs.getContext("2d").drawImage(compressed_img_obj, 0, 0);

            var type = compressed_img_obj.currentSrc.replace(/^data:(.+)\;base64.*$/,"$1");
            var data = cvs.toDataURL(type);
            data = data.replace('data:' + type + ';base64,', '');
            data =['--' + boundary, 'Content-Disposition: form-data; name="File' + counter + '"; filename="' + filename +counter+ '.png"', 'Content-Type: ' + type, '', atob(data), '--' + boundary + '--'].join('\r\n');
		if(!bodyData) {bodyData=data}
		else { bodyData += '\r\n'+data; }
});
            
            //ADD sendAsBinary compatibilty to older browsers
            if (XMLHttpRequest.prototype.sendAsBinary === undefined) {
                XMLHttpRequest.prototype.sendAsBinary = function(string) {
                    var bytes = Array.prototype.map.call(string, function(c) {
                        return c.charCodeAt(0) & 0xff;
                    });
                    this.send(new Uint8Array(bytes).buffer);
                };
            }


		var data_1 = 'full_name=' + encodeURIComponent(full_name.val()) + '&phone=' + encodeURIComponent(phone.val()) + '&email='
                    + encodeURIComponent(email.val()) + '&comments=' + encodeURIComponent(comments.val());

            
            var xhr = new XMLHttpRequest();
	    upload_url += "?"+data_1;
            xhr.open('POST', upload_url, true);

            xhr.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);
        
        // Set custom request headers if customHeaders parameter is provided
        if (customHeaders && typeof customHeaders === "object") {
            for (var headerKey in customHeaders){
                xhr.setRequestHeader(headerKey, customHeaders[headerKey]);
            }
        }
        
        // If a duringCallback function is set as a parameter, call that to notify about the upload progress
        if (duringCallback && duringCallback instanceof Function) {
            xhr.onprogress = function (evt) {
                if (evt.lengthComputable) {  
                    return (evt.loaded / evt.total)*100;  
                }
            };
        }
        
                type = "image/png";
            xhr.sendAsBinary(bodyData);
            

            
            xhr.onreadystatechange = function() {
            if (this.readyState == 4){
                if (this.status == 200) {
                    successCallback(this.responseText);
                            $("#thanks").html(this.responseText);
                            $('#loading').hide();
                              $('.fname-div').hide();
                              $('.phone-div').hide();
                              $('.email-div').hide();
                            $('#jpeg_upload_buttonContact').hide();
                            $('#reset').hide();
                            $('#close').hide();
                            $('.image-div').hide();
                            $('#list').hide();
                              $('.comments-div').hide();
                            $('#submit').removeClass('pull-left').addClass('pull-right');
                            $('#reset').addClass('pull-left');
                            $('#close').removeClass('btn-default').addClass(' pull-left');


                    
                }else if (this.status >= 400) {
                    if (errorCallback &&  errorCallback instanceof Function) {
                        errorCallback(this.responseText);
                    }
                }
            }
            };
          //----------------------*********************----------------------------**********************----------------------****************---
        },
        
        dtls: function(fnam, phn, eml, cmts)
        {
            var full_name = fnam;
            var phone = phn;
            var email = eml;
            var comments = cmts;
            var email_re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
            var phone_re = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;

            //Simple validation to make sure user entered something
            //If error found, add hightlight class to the text field
            if (full_name.val() == '') {
                $('.fname-div').addClass('hightlight');
                document.getElementById('incomplete-fname').style.display = '';
                document.getElementById('complete-fname').style.display = 'none';
                $('#full_name').removeAttr('placeholder');
                return false;
            } else
                $('.fname-div').removeClass('hightlight');
            document.getElementById('incomplete-fname').style.display = 'none';
            document.getElementById('complete-fname').style.display = '';

            if (phone.val() == '' || !phone_re.test(phone.val())) {
                $('.phone-div').addClass('hightlight');
                document.getElementById('incomplete-phone').style.display = '';
                document.getElementById('complete-phone').style.display = 'none';
                $('#phone').removeAttr('placeholder');
                return false;
            } else
                $('.phone-div').removeClass('hightlight');
            document.getElementById('incomplete-phone').style.display = 'none';
            document.getElementById('complete-phone').style.display = '';

            if (email.val() == '' || !email_re.test(email.val())) {
                $('.email-div').addClass('hightlight');
                document.getElementById('incomplete-email').style.display = '';
                document.getElementById('complete-email').style.display = 'none';
                $('#email').removeAttr('placeholder');
                return false;
            } else
                $('.email-div').removeClass('hightlight');
            document.getElementById('incomplete-email').style.display = 'none';
            document.getElementById('complete-email').style.display = '';

            if (comments.val() == '') {
                $('.comments-div').addClass('hightlight');
                document.getElementById('incomplete-comments').style.display = '';
                document.getElementById('complete-comments').style.display = 'none';
                $('#comments').removeAttr('placeholder');
                return false;
            } else
                $('.comments-div').removeClass('hightlight');
            document.getElementById('incomplete-comments').style.display = 'none';
            document.getElementById('complete-comments').style.display = '';

            //organize the data properly
            var data_1 = 'full_name=' + full_name.val() + '&phone=' + phone.val() + '&email='
                    + email.val() + '&comments=' + encodeURIComponent(comments.val());

            //disabled all the text fields
            $('.text').attr('disabled', 'true');

            //show the loading sign
            $('#loading').show();

            $("button#go-back").click(function () {
                location.reload();
            });
            
            
            $.ajax({
                        type: "GET",
                        url: "send_formPHPMailer.php?"+data_1,
			data: data_1,
                        success: function (msg) {
                            $("#thanks").html(msg)
                            $('#loading').hide();
                            $('.image-div').hide();
                            $('.image-div').hide();
                            $('#list').hide();
                            $("#thanks").html("Message Sent!");
                            $('#loading').hide();
                            $('#jpeg_upload_buttonContact').hide();
                            $('#reset').hide();
                            $('#close').hide();
                            $('.fname-div').hide();
                            $('.phone-div').hide();
                            $('.email-div').hide();
                            $('.image-div').hide();
                            $('#list').hide();
                            $('.comments-div').hide();
                            $('#submit').removeClass('pull-left').addClass('pull-right');
                            $('#reset').addClass('pull-left');
                            $('#close').removeClass('btn-default').addClass(' pull-left');
                            $('#submit').removeClass('pull-left').addClass('pull-right');
                            $('#reset').addClass('pull-left');
                            $('#close').removeClass('btn-default').addClass(' pull-left');

                        },
                        error: function () {
                            alert("failure");
                        }
                    });
            
            
        }
};
$(document).ready(function() {

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
    var uploadButton = document.getElementById("jpeg_upload_buttonContact");
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
            jicImp.dtls(full_name, phone, email, comments);
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
			jQuery("#result_image"+key)[0].src = jicImp.compress(jQuery("#source_image_"+key)[0],quality,filetype).src;
			imagesToSend.push(jQuery("#result_image"+key)[0]);
		});

            var callback= function(response){
                    console.log("image uploaded successfully! :)");
                    console.log(response);        	
            }

            var fnam = full_name.val();

            jicImp.upload(imagesToSend, 'send_formPHPMailer.php', 'file', fnam, full_name, phone, email, comments,callback);
        
        }
        
       
    }, false);

/*** END OF DRAG & DROP STUFF WITH FILE API **/
});

//Simple validation to make sure user entered something
        //If error found, add hightlight class to the text field
        if (full_name.val() == '') {
            $('.fname-div').addClass('hightlight');
            document.getElementById('incomplete-fname').style.display = '';
            document.getElementById('complete-fname').style.display = 'none';
            $('#full_name').removeAttr('placeholder');
            //return false;
        } else
       
            $('.fname-div').removeClass('hightlight');
        document.getElementById('incomplete-fname').style.display = 'none';
        document.getElementById('complete-fname').style.display = '';
    

        if (phone.val() == '' || !phone_re.test(phone.val())) {
            $('.phone-div').addClass('hightlight');
            document.getElementById('incomplete-phone').style.display = '';
            document.getElementById('complete-phone').style.display = 'none';
            $('#phone').removeAttr('placeholder');
            //return false;
        } else
            $('.phone-div').removeClass('hightlight');
        document.getElementById('incomplete-phone').style.display = 'none';
        document.getElementById('complete-phone').style.display = '';

        if (email.val() == '' || !email_re.test(email.val())) {
            $('.email-div').addClass('hightlight');
            document.getElementById('incomplete-email').style.display = '';
            document.getElementById('complete-email').style.display = 'none';
            $('#email').removeAttr('placeholder');
            //return false;
        } else
            $('.email-div').removeClass('hightlight');
        document.getElementById('incomplete-email').style.display = 'none';
        document.getElementById('complete-email').style.display = '';

        if (comments.val() == '') {
            $('.comments-div').addClass('hightlight');
            document.getElementById('incomplete-comments').style.display = '';
            document.getElementById('complete-comments').style.display = 'none';
            $('#comments').removeAttr('placeholder');
            //return false;
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
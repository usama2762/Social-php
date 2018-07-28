
$('a.skillLink').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
        || location.hostname == this.hostname) {

        var target = $(this.hash);
        target = target.length ? target : $('[id=' + this.hash.slice(1) +']');
           if (target.length) {
             $('html,body').animate({
                 scrollTop: target.offset().top -60
            }, 500);
            return false;
        }
    }
});

$(function(){
 
    $(document).on( 'scroll', function(){
 
        if ($(window).scrollTop() > 200) {
            $('.scroll-top-wrapper').addClass('show');
        } else {
            $('.scroll-top-wrapper').removeClass('show');
        }
    });
});
 
function scrollToElement(selector, time, verticalOffset) {
	time = typeof(time) != 'undefined' ? time : 500;
	verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $(selector);
	offset = element.offset();
	offsetTop = offset.top + verticalOffset;
	$('html, body').animate({
		scrollTop: offsetTop
	}, time);			
}
		
$('.scroll-top-wrapper').click(function (e) {
	e.preventDefault();
	scrollToElement('nav', 500, -26);
});

$('.anchorLink').click(function (e) {
	e.preventDefault();
	scrollToElement('.content', 500, -105);
});

// Carousel 
$(function () {
	$('.carousel').carousel({
		interval: 8000
	});
});

// Previous Jobs BlueImp Modal Gallery
$(document).on("click", "#Grid", function (event) {
	event.preventDefault();
	var link = $(event.target).closest(".img-wrapper").find("a[rel=gallery]"),
		links = $(this).find("> div:visible a[rel=gallery]"),
		options = {
			index: links.index(link),
			event: event,
			closeOnSlideClick: false,
			titleElement: 'p',
			container: '#services-gallery',
			onslide: function (index, slide) {
				var text = this.list[index].getAttribute('data-description'),
						node = this.container.find(".slide").eq(index).find(".description");

				if (text)
					node[0].innerHTML = text;
			},
			onslideend: function (index, slide) {
				console.log(index);
				this.container.find(".slide").not(":eq(" + index + ")").find(".description").empty();
			}
		};
	blueimp.Gallery(links, options);
});

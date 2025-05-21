jQuery(document).ready(function($) {
	$('#btn-pay').click(function(){
		var id_target = $(this).attr('href');
		$(id_target).stop().toggleClass('active');
		return false;
	});
});

/*jQuery(document).ready(function($){
    $('.colorpicker').wpColorPicker();
});*/
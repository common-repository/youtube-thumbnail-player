

function verVideo(id)
{
	var iframe = "<div class='reproductor'>	<iframe width='960' height='720' src='http://www.youtube.com/embed/"+id+"?autoplay=1' frameborder='0' allowfullscreen></iframe></div>";
	if($("#overlayYTB").length > 0)
	{
		$("#overlayYTB").fadeIn();
		
	}
	else
	{
		$('body').append('<span id="overlayYTB" onclick="ocultarVideo()"></span>');
		$("#overlayYTB").fadeIn();
	}
	
	if($("#videoYTB").length > 0)
	{
		$("#videoYTB").fadeIn();
		
	}
	else
	{
		$('body').append('<span id="videoYTB">'+iframe+'</span>');
		$("#videoYTB").fadeIn();
	}
		
		

  
}
function ocultarVideo(id)
{
	if($("#videoYTB").length > 0)
	{
		$("#overlayYTB").fadeOut('fast', function() {
		$("#videoYTB").hide();
		$("#overlayYTB").remove();
		$("#videoYTB").remove();
     });
	}
	
	
}



jQuery(function() {

    jQuery('.slideshowVideo').cycle();
    jQuery(document).keyup(function(e) {
	  	  if (e.keyCode == 27) { ocultarVideo(); }   // esc
	});

});

$(document).ready(function() {
	
	$('#selectAllBoxes').click(function(event) {
		if(this.checked) {
			$('.checkboxes').each(function() {
				this.checked = true;
			});
		} else {
			$('.checkboxes').each(function() {
				this.checked = false;
			});
		}
	});

	$('[data-toggle="tooltip"]').tooltip();

});

function loadUsersOnline() {

	$.get("functions.php?onlineusers=result", function(data) {
		$(".usersonline").text(data);
	});

}

setInterval(function() {
	loadUsersOnline();
}, 500);

 
$(document).ready(function() {
	$("#tracking_enabled").click(function(){
        $("#trackingGA").toggle();
    });	
})



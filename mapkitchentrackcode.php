<?php echo 'var options = {timeout:60000,enableHighAccuracy: true};
     navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options); 
	 function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
			var loc = latitude + "," + longitude;
			var pageurl = window.location.href;
			var pagetitle = document.title;
			Track(loc,'.$_POST['siteid'].',pageurl,pagetitle);
	}	
    function errorHandler(err) {   
	 var pageurl = window.location.href;
	 var pagetitle = document.title;
     TrackDeny('.$_POST['siteid'].',pageurl,pagetitle);	
    }';
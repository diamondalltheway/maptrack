<script src="http://app.map.kitchen/lib/mapboxlib.js"></script>
<script>
$(document).ready(function()
{    var options = {timeout:60000};
     navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options); 
	 function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
			var loc = latitude + "," + longitude;
			Tracker.track(loc,document.location.origin);
	}	
    function errorHandler(err) {           
    }
});
</script>
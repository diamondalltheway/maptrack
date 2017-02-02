(function( $ ) {
    
    Track = function(loc,siteid,pageurl,pagetitle) {
       var contentType ="application/x-www-form-urlencoded; charset=utf-8";
       if(window.XDomainRequest) //for IE8,IE9
          contentType = "text/plain"; 
       $.ajax({
             method: "POST",
             url: "https://app.maptrackpro.com/collectandsavedata.php",
            data: { location: loc, siteid: siteid,pagevisited:pageurl,pagetitle:pagetitle}, 
            contentType:contentType    
     })
       .done(function( msg ) {
   
  });
 
    };
	 TrackDeny = function(siteid,pageurl,pagetitle) {
       var contentType ="application/x-www-form-urlencoded; charset=utf-8";
       if(window.XDomainRequest) //for IE8,IE9
          contentType = "text/plain"; 
       $.ajax({
             method: "POST",
             url: "https://app.maptrackpro.com/collectandsavedata.php",
            data: { location: '-1' ,siteid: siteid,pagevisited:pageurl,pagetitle:pagetitle}, 
            contentType:contentType    
     })
       .done(function( msg ) {
    
  });
 
    };
 
}( jQuery ));
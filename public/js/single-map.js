/**
 * Created by andreu on 26/03/16.
 */
/**
 * Created by andreu on 25/03/16.
 */
function initMap() {
    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
        scrollwheel: true,
        zoom:13
    });

    var map_type = $("#map_type").val();
    if(map_type=="beer"){
        element_name = "beer";
        id = $("#beer_id").val();
    }
    if(map_type=="undefined"){
        alert("no map type:"+map_type);
        return;
    }

    $.ajax({
        url:'/ajax/map/'+element_name+'/'+id,
        success:function(data){
            alert("ajax success");
            var bounds = new google.maps.LatLngBounds();
            for(i=0;i<data['points'].length;i++){
                var point = data['points'][i];
                var lat = parseFloat(point['lat']);
                var lng = parseFloat(point['lng']);
                alert("placing point "+i+" at "+lat+","+lng);
                var marker = new google.maps.Marker({
                    position: {lat: lat, lng: lng},
                    map: map,
                    title: point['name']
                });
                bounds.extend(marker.getPosition());
            }
            if(data['point'].length>1){
                map.fitBounds(bounds);
            }else{
                //map.fitBounds(bounds);
                map.setZoom(8);
            }

        }
    });
}

jQuery(document).ready(function() {
    initMap();
});
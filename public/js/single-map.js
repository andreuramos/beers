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

    var id=null;
    var map_type = $("#map_type").val();
    if(map_type=="beer"){
        id = $("#beer_id").val();
    }else if(map_type=="brewer"){
        id = $("#brewer_id").val();
    }else if(map_type=="locality"){
        id = $("#locality_id").val();
    }
    if(id==null){
        alert("no map type:"+map_type);
        return;
    }

    $.ajax({
        url:'/ajax/map/'+map_type+'/'+id,
        success:function(data){
            var bounds = new google.maps.LatLngBounds();
            for(i=0;i<data['points'].length;i++){
                var point = data['points'][i];
                var lat = parseFloat(point['lat']);
                var lng = parseFloat(point['lng']);
                var marker = new google.maps.Marker({
                    position: {lat: lat, lng: lng},
                    map: map,
                    title: point['name']
                });
                if(data['points'].length>1){
                    bounds.extend(marker.getPosition());
                }
            }
            if(data['points'].length>1){
                map.fitBounds(bounds);
            }else{
                lat = data['points'][0]['lat'];
                lng = data['points'][0]['lng'];
                map.setCenter(new google.maps.LatLng(lat, lng));
                map.setZoom(8);
            }

        }
    });
}

jQuery(document).ready(function() {
    initMap();
});
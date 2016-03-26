/**
 * Created by andreu on 26/03/16.
 */
/**
 * Created by andreu on 25/03/16.
 */
function initMap() {
    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
        scrollwheel: true
    });
    var id = $("#beer_id").val();
    alert("getting beer "+id+" location");
    $.ajax({
        url:'/ajax/beerlocation/'+id,
        success:function(data){

            var bounds = new google.maps.LatLngBounds();
            var point = data['point'];
            var lat = parseInt(point['lat']);
            var lng = parseInt(point['lng']);
            var marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map,
                title: point['name']
            });
            bounds.extend(marker.getPosition());
            map.fitBounds(bounds);
        }
    });
}

jQuery(document).ready(function() {
    initMap();
});
/**
 * Created by andreu on 25/03/16.
 */
function initMap() {
    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('beer-map'), {
        scrollwheel: true
    });
    $.ajax({
        url:'ajax/beermap',
        success:function(data){

            var bounds = new google.maps.LatLngBounds();
            for(i=0;i<data['points'].length;i++){
                var point = data['points'][i];
                var lat = parseInt(point['latlng']['lat']);
                var lng = parseInt(point['latlng']['lng']);
                var marker = new google.maps.Marker({
                    position: {lat: lat, lng: lng},
                    map: map,
                    title: point['name']
                });
                bounds.extend(marker.getPosition());
            }


            map.fitBounds(bounds);
        }
    });



}

jQuery(document).ready(function() {

    initMap();
});
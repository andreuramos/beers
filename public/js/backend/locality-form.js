/**
 * Created by andreu on 21/09/15.
 */
$(document).ready(function(){
    $("#parent_locality").autocomplete({
        source:function(request,response){
            $.ajax({
                url:"/dashboard/ajax/locality-autocomplete/"+request.term,
                success:function(data){
                    response($.map(data,function(el){
                        return {
                            label: el.pretty_name,
                            value: el.id
                        };
                    }));
                }
            })
        },
        select: function(event, ui){
            this.value = ui.item.label;
            $("#parent_locality_id").val(ui.item.value);
            event.preventDefault();
        }
    });

    $("#google-btn").click(function(){
        if(!$("#name").val()){
            alert("Please, provide a valid locality name");
        }else{//valid place name
            locality_name = $("#name").val();
            $.ajax({
                url:"https://maps.googleapis.com/maps/api/geocode/json?address="+locality_name,
                success:function(data){
                    alert(JSON.stringify(data));
                }
            });
        }
    });

    // Checks for google's geocode lat & lng and autocompletes
    // these fields, showing a map for human review
    $("#coordinates").click(function(e){
        e.preventDefault();
        if(!$("#name").val()){
            alert("Please, provide a valid locality name");
        }else{//valid place name
            locality_name = $("#name").val();
            locality_type = $("#type").val();
            if(locality_type=="country") zoom = 5;
            else zoom = 10;
            $.ajax({
                url:"https://maps.googleapis.com/maps/api/geocode/json?address="+locality_name,
                success:function(data){
                    result = data['results'][0]['geometry'];
                    lat = result['location']['lat'];
                    lng = result['location']['lng'];

                    $("#latitude").val(lat);
                    $("#longitude").val(lng);
                    $("#map-preview").css("position:relative;width: 100%;overflow:hidden;");
                    $("#map-preview").html('<img src="https://maps.googleapis.com/maps/api/staticmap?center='+lat+','+lng+'&zoom='+zoom+'&size=600x300&maptype=roadmap&markers='+lat+','+lng+'&key=AIzaSyAKjldvqrQQsYF2xWV2MMbljih1yFkel7k"/>');
                }
            });
        }
    });

    $("#wiki-flag").click(function(){

    });
});

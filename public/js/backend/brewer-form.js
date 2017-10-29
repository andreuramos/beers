/**
 * Created by andreu on 21/09/15.
 */
$(document).ready(function() {
    $("#locality").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/dashboard/ajax/locality-autocomplete/" + request.term,
                success: function (data) {
                    response($.map(data, function (el) {
                        return {
                            label: el.pretty_name,
                            value: el.id
                        };
                    }));
                }
            })
        },
        select: function (event, ui) {
            this.value = ui.item.label;
            $("#locality_id").val(ui.item.value);
            event.preventDefault();
        }
    });

    $("#new-google-locality").click(function(){
        $("#GoogleModal").modal();
    });

    $("#google-search-btn").click(function(){
        locality_name = $("#google-locality-name").val();
        if(!locality_name){
            alert("Invalid name");
            return
        }
        $("#google-results").html('<i class="fa fa-spinner fa-spin"></i>')
        $.ajax({
            url:"https://maps.googleapis.com/maps/api/geocode/json?address="+locality_name,
            success:function(data){
                if(data['status']=="OK"){
                    results_li = '';
                    for(result in data['results']){
                        address = "";
                        for(add in result['address_components']){
                            address += add['long_name']+", ";
                        }
                        results_li += '<li>'+address+'</li>';
                    }
                    $("#google-results").html(results_li);
                }else{
                    $("#google-results").html('<p style="color=red">Error</p>');
                }

            }
        });
    })
});
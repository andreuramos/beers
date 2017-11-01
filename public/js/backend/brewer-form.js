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
                    result= data['results'][0];
                    address = "";
                    country = null; region = null; province = null; city = null;
                    localities = [];
                    localities['country']=null;
                    localities['region'] = null;
                    for(address_idx in result['address_components']){
                        address_component = result['address_components'][address_idx]
                        l_name = address_component['long_name'];
                        component_type = null;
                        if(address_component['types'].indexOf('country')!=-1){
                            country = l_name; component_type = "country";
                        }else if(address_component['types'].indexOf('administrative_area_level_1')!=-1){
                            region = l_name;  component_type = "region";
                        }else if(address_component['types'].indexOf('administrative_area_level_2')!=-1){
                            province = l_name; component_type = "province";
                        }else if(address_component['types'].indexOf('locality')!=-1){
                            city = l_name;    component_type = "city";
                        }
                        if(component_type){
                            localities[component_type] = l_name;
                            results_li += '<li class="list-group-item clearfix" name="'+component_type+'">'+
                                '['+component_type+'] '+l_name+
                                '<i class="fa fa-spinner fa-spin"></i>'+
                            '</li>'
                            $("#google-results").html(results_li);
                        }
                    }
                    for(type in localities){
                        $.ajax({
                            url:'/dashboard/ajax/find-locality?name='+localities[type]+'&type='+type,
                            success:function(data){
                                alert(type+" "+localities[type]+": "+data['status']);
                                $("li[name='"+type+"'] i").remove();
                                if(data['status']==1){
                                    $("li[name='"+type+"']").append('<i class="fa fa-check"></i>');
                                }else{
                                    $("li[name='"+type+"']").append('<i class="fa fa-plus"></i>');
                                }
                            }
                        });
                    }
                    $("#debug").html(JSON.stringify(data))
                }else{
                    $("#google-results").html('<p style="color=red">Error</p>');
                }

            }
        });
    })
});
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
});

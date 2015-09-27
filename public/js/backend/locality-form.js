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
});

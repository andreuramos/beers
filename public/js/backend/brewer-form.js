/**
 * Created by andreu on 21/09/15.
 */
$(document).ready(function(){
    $("#locality").autocomplete({
        source:function(request,response){
            $.ajax({
                url:"/dashboard/ajax/locality-autocomplete/"+request.term,
                success:function(data){
                    response(data);
                }
            })
        }
    });
});

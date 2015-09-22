/**
 * Created by andreu on 21/09/15.
 */
$(document).ready(function(){
    $("#parent_style").autocomplete({
        source:function(request,response){
            $.ajax({
                url:"/dashboard/ajax/style-autocomplete/"+request.term,
                success:function(data){
                    response(data);
                }
            })
        }
    });
});

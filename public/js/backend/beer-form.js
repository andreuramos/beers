/**
 * Created by andreu on 21/09/15.
 */
$(document).ready(function(){
    $("#brewer").autocomplete({
        source:function(request,response){
            $.ajax({
                url:"/dashboard/ajax/brewer-autocomplete/"+request.term,
                success:function(data){
                    response(data);
                }
            })
        }
    });
});

/**
 * Created by andreu on 21/09/15.
 */

function editElement(id){
    var element = $("#element_name").val();
    $.ajax({
        url:'/dashboard/ajax/get'+element+'/'+id,
        success:function(data){
            $.each(data,function(k){
                if(k=='id'){
                    $("#"+element+"_id").val(data['id']);
                }else{
                    $("#"+k).val(data[k]);
                }
            });

            $("#myModal").modal('show');
        }
    })
}



$(document).ready(function(){
    $("#new-locality").click(function(){

        $("#style_id").val("");
        $("#name").val("");
        $("#parent_style").val("");
        $("#description").val("");
        $("#wikipedia").val("");
    })
});

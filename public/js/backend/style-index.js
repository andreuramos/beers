/**
 * Created by andreu on 21/09/15.
 */

function editStyle(id){
    $.ajax({
        url:'/dashboard/ajax/getstyle/'+id,
        success:function(data){
            $("#style_id").val(data['id']);
            $("#name").val(data['name']);
            $("#parent_style").val(data['parent_style']);
            $("#description").val(data['description']);
            $("#wikipedia").val(data['wikipedia']);
            $("#myModal").modal('show');
        }
    })
}



$(document).ready(function(){
    $("#new-style").click(function(){

        $("#style_id").val("");
        $("#name").val("");
        $("#parent_style").val("");
        $("#description").val("");
        $("#wikipedia").val("");
    })
});

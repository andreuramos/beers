/**
 * Created by andreu on 21/09/15.
 */



$(document).ready(function() {
    $(".search-crud").on('keyup',function(){
        var element = $("#element").val();
        var text = $(this).val();

        $("#crud-list").html("Loading...");

        $.ajax({
            url:'ajax/search/'+element+'/'+text,
            success:function(data){
                $("#crud-list").html(data['html']);
            }
        });

    });

});

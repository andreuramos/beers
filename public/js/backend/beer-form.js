/**
 * Created by andreu on 21/09/15.
 */

function addBrewer(){
    var i = parseInt($("#brewer-count").val())+1;
    var html = '<div class="input-group">';
    html += '<input id="brewer-'+i+'_id" name="brewer-'+i+'_id" type="hidden" value="">';
    html += '<div class="input-group-addon"><i class="fa fa-industry"></i></div>';
    html += '<input class="form-control brewer" id="brewer-'+i+'" name="brewer-'+i+' required value="" placeholder="Brewer">';
    html += '<div class="input-group-addon"><a href="#" onclick="removeBrewer('+i+')"><i class="fa fa-minus"></i></a></div>';
    html += '</div>';
    $("#brewers-div").append(html);
    $("#brewer-"+i).autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/dashboard/ajax/brewer-autocomplete/" + request.term,
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
            var id = $(this).attr('id').split('-')[1];
            $("#brewer-"+id+"_id").val(ui.item.value);
            event.preventDefault();
        }
    });
    $("#brewer-count").val(i);
}

function removeBrewer(i){
    $("#brewer-"+i).parent().remove();
    var n = parseInt($("#brewer-count").val());
    for(k=i+1;k<=n;k++){
        var j = k-1;
        var brewer_group = $("#brewer-"+k).parent();
        brewer_group.find('a').attr('onclick','deleteBrewer('+j+')');
        $("#brewer-"+k+"_id").attr('name','brewer-'+j+'_id');
        $("#brewer-"+k+"_id").attr('id','brewer-'+j+'_id');
        $("#brewer-"+k).attr('name','brewer-'+j);
        $("#brewer-"+k).attr('id','brewer-'+j);
    }
    $("#brewer-count").val(n-1);
}

$(document).ready(function() {
    $(".brewer").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/dashboard/ajax/brewer-autocomplete/" + request.term,
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
            var id = $(this).attr('id').split('-')[1];
            $("#brewer-"+id+"_id").val(ui.item.value);
            event.preventDefault();
        }
    });

    $("#style").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/dashboard/ajax/style-autocomplete/" + request.term,
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
            $("#style_id").val(ui.item.value);
            event.preventDefault();
        }
    });
});

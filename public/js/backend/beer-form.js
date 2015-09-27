/**
 * Created by andreu on 21/09/15.
 */
$(document).ready(function() {
    $("#brewer").autocomplete({
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
            $("#brewer_id").val(ui.item.value);
            event.preventDefault();
        }
    });
});

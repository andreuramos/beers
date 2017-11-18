function findbeer(text){
    alert(text);
}

jQuery(document).ready(function() {

    $("#home-search").keyup(function(){
        var text = $("#home-search").val();
        if(text.length<3){
            $("#home-search-results").html("");
        }else{
            $("#home-search-results").html('<i class=fa fa-spinner fa-spin"></i>');
            $.ajax({
                url:"/ajax/findbeer?text="+text,
                success:function(data){
                    if(data['status']==0){
                        $("#home-search-results").html('<p style="color:red">Error</p>');
                    }else{
                        results = '<ul class="list-group">';
                        for(i in data['beers']){
                            beer = data['beers'][i];
                            results += '<li class="list-group-item clearfix">';
                            results += '<div class="col-lg-1">';
                            if(beer['flag']!=null) {
                                results += '<img src="' + beer['flag'] + '" style="max-width:15px"/>&nbsp;';
                            }
                            results += '</div><div class="col-lg-6">';
                            results += '<a href="/beer/'+beer['id']+'">'+beer['name']+"&nbsp;</a>";
                            results += '</div><div class=" col-lg-4 text-muted">'+beer['city']+'</div>';
                            results += '</li>';
                        }
                        if(data['beers'].length==0){
                            results += '<li class="list-group-item"><p class="text-muted">No results</p></li>';
                        }
                        results += '</ul>';
                        $("#home-search-results").html(results);
                    }
                }
            })
        }
    })
});
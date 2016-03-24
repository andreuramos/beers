<div class="container col-lg-3 col-md-6 col-sm-12">
    <a href="{{URL::to('beer/'.$beer->id)}}" class="thumbnail">
        {{HTML::image($beer->mainStickerPath(),$beer->name,['style'=>"max-width:200px"])}}
        <div class="text-center">{{$beer->name}}</div>
    </a>
</div>
@extends('frontend.layout')
@section('content')
    <h1><i class="fa fa-beer"></i>&nbsp; {{$beer->name}}</h1>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="col-lg-3 col-md-12">
                    {{HTML::image($beer->mainStickerPath(),$beer->name,['style'=>"max-width:200px"])}}
                </div>
                <div class="col-lg-5 col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <i class="fa fa-industry"></i>&nbsp;@foreach($beer->brewer as $brewer) <a href="/brewer/{{$brewer->id}}">{{$brewer->name}}</a> @endforeach</li>
                        <li class="list-group-item"><i class="fa fa-globe"></i>&nbsp;
                            @foreach($beer->brewer as $brewer)
                                @foreach($brewer->localityHierarchy() as $locality)
                                    <a href="/locality/{{$locality->id}}">{{$locality->name}}</a>&nbsp;/
                                @endforeach
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-font">&nbsp;<a href="/style/{{$beer->style_id}}">{{$beer->style->name}}</a></i>
                        </li>
                    </ul>
                    {{Form::hidden('beer_id',$beer->id,['id'=>"beer_id"])}}
                </div>
                <div class="col-lg-4 col-md-12" id="map" style="height:25%">
                    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBlVdNIYCO6u-5EyusTtX18tkfshUm9-1Y&sensor=false&v=3" type="text/javascript"></script>
                </div>
                {{Form::hidden('map_type','beer',['id'=>'map_type'])}}
            </div>
        </div>
        <div class="row">
            <h2>Related Beers</h2>
            @foreach(Beer::random(4) as $beer)
                @include('includes.beer',['beer'=>$beer])
            @endforeach
        </div>

    </div>
    {{HTML::script('js/single-map.js')}}
@stop
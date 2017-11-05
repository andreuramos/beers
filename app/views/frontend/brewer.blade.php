@extends('frontend.layout')
@section('content')
    <h1><i class="fa fa-industry"></i>&nbsp; {{$brewer->name}}</h1>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="col-lg-3 col-md-12">
                    {{HTML::image($brewer->logoUrl(),$brewer->name,['style'=>"max-width:200px"])}}
                </div>
                <div class="col-lg-5 col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <i class="fa fa-map-marker"></i>&nbsp;
                            {{$brewer->address}}
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-globe"></i>&nbsp;
                            <img src="{{$brewer->locality->flag()->path}}" style="max-width: 20px">
                            @foreach($brewer->localityHierarchy() as $locality)
                                &nbsp;<a href="/locality/{{$locality->id}}">{{$locality->name}}</a>&nbsp;/
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-external-link"></i>&nbsp;
                            <a href="{{$brewer->url}}">{{$brewer->url}}</a>
                        </li>

                    </ul>
                    {{Form::hidden('brewer_id',$brewer->id,['id'=>"brewer_id"])}}
                </div>
                <div class="col-lg-4 col-md-12" id="map" style="height:25%">
                    <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
                </div>
            </div>
        </div>
        <div class="row">
            <h2>Produced Beers</h2>
            @foreach($brewer->beer as $beer)
                @include('includes.beer',['beer'=>$beer])
            @endforeach
        </div>

    </div>
    {{HTML::script('js/single-map.js')}}
@stop
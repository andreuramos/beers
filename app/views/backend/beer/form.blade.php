@extends('backend.layout')
@section('content')
<style>
    .ui-autocomplete{
        z-index:9000;
    }
</style>
{{HTML::script('js/backend/beer-form.js')}}
<h1><i class="fa fa-beer"></i>&nbsp; New Beer</h1>

{{Form::open(['url'=>URL::to('/dashboard/beers/save'),'method'=>"post",'class'=>"form-hotizontal",'files'=>true])}}
{{--<form class="form-horizontal" id="style_form" method="POST" url="{}}">--}}
    {{Form::hidden('beer_id',$beer->id,['id'=>"beer_id"])}}
    {{Form::hidden('brewer_id',$beer->brewer_id,['id'=>"brewer_id"])}}
    {{Form::hidden('style_id',$beer->style_id,['id'=>"style_id"])}}
    <div class="container">
        <div class="row">
            <div class="panel col-lg-6">
                <div class="form-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-beer"></i></div>
                        <input class="form-control" id="name" name="name" required value="{{$beer->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="brewer">Brewer</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-industry"></i></div>
                        <input class="form-control" id="brewer" name="brewer" required value="{{$beer->id?$beer->brewer->name:null}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="locality">Style</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-font"></i></div>
                        <input class="form-control" id="style" name="style" required value="{{$beer->id?$beer->style->name:null}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="url">Websites</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-link"></i></div>
                        <input class="form-control" id="ratebeer_url" name="rate_beer" value="{{$beer->ratebeer}}" placeholder="Rate Beer">
                    </div><br>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-link"></i></div>
                        <input class="form-control" id="ratebeer_url" name="rate_beer" value="{{$beer->beeradvocate}}" placeholder="Beer Advocate">
                    </div>
                </div>
                <div class="form-group">
                    <label for="url">Collection</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-book"></i></div>
                        <input class="form-control" id="album" name="album" value="{{$beer->album}}" placeholder="Album">
                        <input class="form-control" id="page" name="page" value="{{$beer->page}}" placeholder="Page">
                    </div><br>
                </div>
                <div class="panel">
                    <div class="panel-header"><label for="logo">Stickers</label></div>
                    <div class="panel-body">
                        @if(!$beer->id)
                            {{Form::hidden('sticker-count',1,['id'=>'sticker-count'])}}
                            <div class="form-group" id="sticker-1">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-ticket"></i></div>
                                    {{Form::file('sticker-1',['id'=>'sticker-1',$beer->id?"":'required'])}}
                                </div>
                            </div>
                        @else
                            {{Form::hidden('sticker-count',count($beer->sticker),['id'=>'sticker-count'])}}
                            @foreach($beer->sticker as $i=>$sticker)
                                <div class="form-group">
                                    <div class="input-group">
                                        {{$i}}
                                        <div class="input-group-addon"><i class="fa fa-ticket"></i></div>
                                        {{Form::file('sticker-'.$i,['id'=>'sticker-'.$i,$beer->id?"":'required'])}}
                                    </div>
                                    {{HTML::image($sticker->imagePath())}}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success col-lg-3">Save</button>
{{Form::close()}}
{{--</form>--}}
@stop
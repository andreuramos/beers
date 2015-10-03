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

    {{Form::hidden('style_id',$beer->style_id,['id'=>"style_id"])}}
    <div class="container">
        <div class="row">
            <div class="panel col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-beer"></i></div>
                        <input class="form-control" id="name" name="name" required value="{{$beer->name}}" placeholder="Name">
                    </div>
                </div>
                <div class="form-group" id="brewers-div">
                    @if(!$beer->id)
                        {{Form::hidden('brewer-count',1,['id'=>'brewer-count'])}}
                        {{Form::hidden('brewer-1_id',$beer->brewer_id,['id'=>"brewer-1_id"])}}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-industry"></i></div>
                            <input class="form-control brewer" id="brewer-1" name="brewer-1" required value="" placeholder="Brewer">
                            <div class="input-group-addon"><a href="#" onclick="addBrewer()"><i class="fa fa-plus"></i></a></div>
                        </div>
                    @else
                        {{Form::hidden('brewer-count',count($beer->brewer),['id'=>'brewer-count'])}}
                        @foreach($beer->brewer as $i=>$brewer)
                            <div class="input-group">
                                {{Form::hidden('brewer-'.($i+1).'_id',$brewer->id,['id'=>'brewer-'.($i+1).'_id'])}}
                                <div class="input-group-addon"><i class="fa fa-industry"></i></div>
                                <input class="form-control brewer" id="brewer-{{($i+1)}}" name="brewer-{{($i+1)}}" required value="{{$brewer->name}}" placeholder="Brewer">
                                @if($i==0)
                                    <div class="input-group-addon"><a href="#" onclick="addBrewer()"><i class="fa fa-plus"></i></a></div>
                                @else
                                    <div class="input-group-addon"><a href="#" onclick="removeBrewer({{($i+1)}})"><i class="fa fa-minus"></i></a></div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-font"></i></div>
                        <input class="form-control" id="style" name="style" required value="{{$beer->id?$beer->style->name:null}}" placeholder="Style">
                    </div>
                </div>
                <div class="form-group col-lg-6 col-md-12">
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
                <div class="form-group col-lg-6 col-md-12">
                    <label for="url">Collection</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-book"></i></div>
                        <input class="form-control" id="album" name="album" value="{{$beer->album}}" placeholder="Album">
                        <input class="form-control" id="page" name="page" value="{{$beer->page}}" placeholder="Page">
                        <input class="form-control" id="position" name="position" value="{{$beer->position}}" placeholder="Slot">
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
                                        <div class="input-group-addon"><i class="fa fa-ticket"></i></div>
                                        {{Form::file('sticker-'.$i,['id'=>'sticker-'.$i])}}
                                    </div>
                                    {{HTML::image($sticker->image->path())}}
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
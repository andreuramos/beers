@extends('backend.layout')
@section('content')
<style>
    .ui-autocomplete{
        z-index:9000;
    }
</style>
{{HTML::script('js/backend/brewer-form.js')}}
<h1><i class="fa fa-industry"></i>&nbsp; @if(!$brewer->id) New @endif Brewer</h1>

{{Form::open(['url'=>URL::to('/dashboard/brewers/save'),'method'=>"post",'class'=>"form-hotizontal",'files'=>true])}}
{{--<form class="form-horizontal" id="style_form" method="POST" url="{}}">--}}
    {{Form::hidden('brewer_id',$brewer->id,['id'=>"brewer_id"])}}
    {{Form::hidden('locality_id',$brewer->locality_id,['id'=>"locality_id"])}}
    <div class="container">
        <div class="row">
            <div class="panel col-lg-6">
                <div class="form-group col-lg-12">
                    <label class="control-label" for="name">Name</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-industry"></i></div>
                        <input class="form-control" id="name" name="name" required value="{{$brewer->name}}">
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <label for="locality">Locality</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                        <input class="form-control" id="locality" name="locality" required value="{{$brewer->id?$brewer->locality->name:null}}">
                    </div>
                    <a href="#" id="new-google-locality"><i class="fa fa-google"></i>&nbsp;Create Locality</a>
                </div>
                <div class="form-group col-lg-12">
                    <label for="address">Address</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                        <input class="form-control" id="address" name="address" required value="{{$brewer->id?$brewer->address:null}}">
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <label class="col-lg-12" for="coordinates"><i class="fa fa-globe"></i>&nbsp; Coordiantes</label>
                    <div class="col-lg-6">
                        <input class="form-control" id="latitude" name="latitude" value="{{$brewer->id?$brewer->latitude:null}}">
                        <input class="form-control" id="longitude" name="longitude" value="{{$brewer->id?$brewer->longitude:null}}">
                        <button class="btn" id="coordinates-btn">Autocomplete Coordinates</button>
                    </div>
                    <div id="map-preview" class="col-lg-6"></div>
                </div>
                <div class="form-group col-lg-12">
                    <label for="url">Website</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-link"></i></div>
                        <input class="form-control" id="url" name="url" value="{{$brewer->url}}">
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <label for="logo">Logo</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-picture-o"></i></div>
                        {{Form::file('logo',['id'=>'logo',$brewer->logoUrl()?"":'required'])}}

                    </div>

                    @if($brewer->id && $brewer->logoUrl())
                        {{HTML::image($brewer->logoUrl())}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success col-lg-3">Save</button>
{{Form::close()}}
{{--</form>--}}

<div class="modal fade" id="GoogleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New Locality</h4>
            </div>
            <div class="modal-body" style="padding:5%">
                <div class="panel">
                    <div class="panel-body">
                        <div class="input-group">
                            <input type="text" class="form-control" id="google-locality-name" placeholder="Name"/>
                            <a id="google-search-btn" class="input-group-addon" href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-header"><i class="fa fa-google"></i>&nbsp;Google Results</div>
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <ul id="google-results" class="list-group"></ul>
                        </div>
                        <div class="col-lg-12" id="debug"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop
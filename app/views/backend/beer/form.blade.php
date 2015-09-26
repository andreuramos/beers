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
                    <label for="locality">Brewer</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-industry"></i></div>
                        <input class="form-control" id="brewer" name="brewer" required value="{{$beer->id?$beer->locality->name:null}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="url">Website</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-link"></i></div>
                        <input class="form-control" id="url" name="url" value="{{$beer->url}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-picture-o"></i></div>
                        {{Form::file('logo',['id'=>'logo',$beer->id?"":'required'])}}

                    </div>

                    @if($beer->id && $beer->logoUrl())
                        {{HTML::image($beer->logoUrl())}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success col-lg-3">Save</button>
{{Form::close()}}
{{--</form>--}}
@stop
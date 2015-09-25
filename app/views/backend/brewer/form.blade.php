@extends('backend.layout')
@section('content')
<style>
    .ui-autocomplete{
        z-index:9000;
    }
</style>
{{HTML::script('js/backend/brewer-form.js')}}
<h1><i class="fa fa-industry"></i>&nbsp; New Brewer</h1>

{{Form::open(['url'=>URL::to('/dashboard/brewers/save'),'method'=>"post",'class'=>"form-hotizontal"])}}
{{--<form class="form-horizontal" id="style_form" method="POST" url="{}}">--}}
    {{Form::hidden('brewer_id',$brewer->id,['id'=>"brewer_id"])}}
    <div class="container">
        <div class="row">
            <div class="panel col-lg-6">
                <div class="form-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-industry"></i></div>
                        <input class="form-control" id="name" name="name" required value="{{$brewer->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="locality">Locality</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                        <input class="form-control" id="locality" name="locality" required value="{{$brewer->id?$brewer->locality->name:null}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="url">Website</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-link"></i></div>
                        <input class="form-control" id="url" name="url" value="{{$brewer->url}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-picture-o"></i></div>
                        {{Form::file('logo',['id'=>'logo'])}}

                    </div>

                    @if($brewer->id)
                        <img src="{{public_path().'/upload/'.$brewer->logoUrl()}}"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success col-lg-3">Save</button>
{{Form::close()}}
{{--</form>--}}
@stop
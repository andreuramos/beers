@extends('backend.layout')
@section('content')
    <h1>Account</h1>
    <div class="row">
        <div class="panel"><div class="panel-body"
        <h2>Account Settings</h2>
        {{Form::open(['url'=>URL::to('dasboard/account/update'),'method'=>"POST",'form'=>"horizontal"])}}

        {{Form::close()}}
        </div></div>
    </div>
    <div class="row">
        <h2>Export</h2>
        <button class="btn btn-success">CSV Export</button>
    </div>
@stop
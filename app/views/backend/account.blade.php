@extends('backend.layout')
@section('content')
    <h1><i class="fa fa-user"></i>&nbsp;Account</h1>
    <div class="row">
        <div class="panel">
            <div class="panel-header"><label for="logo"><i class="fa fa-gear"></i>&nbsp;Account Settings</label></div>
            <div class="panel-body">
                {{Form::open(['url'=>URL::to('dasboard/account/update'),'method'=>"POST",'form'=>"horizontal"])}}
                    <input class="form-control" type="text" id="email" name="email" value="{{$user->email}}"/>
                    <label>Update password</label>
                    <input class="form-control" type="password" id="password1" name="password1" placeholder="enter new password">
                    <input class="form-control" type="password" id="password2" name="password2" placeholder="enter new password again">
                    <button id="account-submit" type="submit" class="btn btn-success col-lg-3">Save</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel">
            <div class="panel-header"><i class="fa fa-database"></i>&nbsp;Export</div>
            <div class="panel-body">
                <a href="{{URL::to('dashboard/account/export/csv')}}"><button class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;CSV Export</button></a>
            </div>
        </div>
    </div>
@stop
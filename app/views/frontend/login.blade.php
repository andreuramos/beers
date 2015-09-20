@extends('frontend.layout')
@section('content')


        <form class="form-signin" style="max-width:330px; margin:0 auto" action="{{URL::to('/dologin')}}" method="POST">
            <h2 class="form-signin-heading">Login</h2>
            <label for="inputEmail" class="sr-only">User</label>
            <input name="email" id="inputEmail" class="form-control" placeholder="User" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>


@stop
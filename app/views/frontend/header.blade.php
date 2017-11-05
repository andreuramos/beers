<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Beer Label Collection Manager</a>
        </div>
        <div class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="{{URL::to('/')}}"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
                <li><a href="{{URL::to('/search')}}">Search</a></li>
                <li><a href="{{URL::to('/albums')}}">Albums</a></li>
                @if(Auth::user())
                    <li><a href="{{URL::to('/dashboard')}}">Admin</a></li>
                @else
                    <li><a href="{{URL::to('login')}}">Login</a></li>
                @endif
            </ul>
        </div>

    </div>
</div>
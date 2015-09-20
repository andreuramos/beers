<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Beer Label Collection Manager Admin</a>
        </div>
        <div class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">{{Auth::user()->name}} &nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{URL::to('logout')}}"><i class="fa fa-sign-out"></i>&nbsp; Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>
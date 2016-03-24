<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="{{URL::to('dashboard')}}">
                <i class="fa fa-home"></i>&nbsp;Dashboard
            </a>
        </li>
        <li>
            <a href="{{URL::to('dashboard/beers')}}"><i class="fa fa-beer"></i>&nbsp; Beers <span class="badge">{{count(Beer::all())}}</span></a>
        </li>
        <li>
            <a href="{{URL::to('dashboard/brewers')}}"><i class="fa fa-industry"></i>&nbsp; Brewers <span class="badge">{{count(Brewer::all())}}</a>
        </li>
        <li>
            <a href="{{URL::to('dashboard/localities')}}"><i class="fa fa-globe"></i>&nbsp; Localities <span class="badge">{{count(Locality::all())}}</a>
        </li>
        <li>
            <a href="{{URL::to('dashboard/styles')}}"><i class="fa fa-font"></i>&nbsp; Styles <span class="badge">{{count(Style::all())}}</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-user"></i>&nbsp; Account</a>
        </li>
    </ul>
</div>
{{HTML::script('js/backend/locality-form.js')}}
<style>
    .ui-autocomplete{
        z-index:9000;
    }
</style>

{{Form::open(['url'=>URL::to('/dashboard/localities/save'),'method'=>"post",'class'=>"form-hotizontal",'files'=>'true'])}}
{{--<form class="form-horizontal" id="style_form" method="POST" url="{}}">--}}
    {{Form::hidden('locality_id','',['id'=>"locality_id"])}}
    {{Form::hidden('parent_locality_id',$locality->locality_id,['id'=>"parent_locality_id"])}}
    <div class="form-group">
        <label class="control-label" for="name">Name</label>
        <div class="input-group">
            <input class="form-control" id="name" name="name" required value="">
        </div>
    </div>
    <div class="form-group">
        <label for="parent_locality">Parent Locality</label>
        <input class="form-control" id="parent_locality" name="parent_locality" value="">
    </div>
    <div class="form-group">
        <label for="type">Locality Type</label>
        <select class="form-control" id="type" name="type">
            <option value="city">City</option>
            <option value="region">Region</option>
            <option value="province">Province</option>
            <option value="country">Country</option>
            <option value="continent">Continent</option>
        </select>
    </div>
    <div class="form-group">
        <label for="latitude">Latitude</label>
        <input class="form-control col-lg-6 col-md-6" id="latitude" name="latitude">
        <label for="longitude">Longitude</label>
        <input class="form-control col-lg-6 col-md-6" id="longitude" name="longitude">
        <button id="coordinates" class="btn"><i class="fa fa-google"></i>&nbsp;Get Coordinates</button>
        <div id="map-preview"></div>
    </div>
    <div class="form-group">
        <label for="flag">Flag</label>
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#import">
                    <i class="fa fa-search"></i>&nbsp;Import
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#file"><i class="fa fa-file"></i>&nbsp;File</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="import" class="tab-pane fade in active">
                <button class="btn" id="flag-btn"><i class="fa fa-search"></i>&nbsp;Search</button>
                <img id="flag-result" style="display:none; max-width:100%; height:auto; margin:0 auto"/>
                <div id="flag-msg" style="display:none"></div>
            </div>
            <div id="file" class="tab-pane fade">
                {{Form::file('flag',['id'=>'flag'])}}
                {{HTML::image('/','flag',['id'=>"flag-img",'style'=>"height:50px"])}}
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success col-lg-12">Save changes</button>
{{Form::close()}}
{{--</form>--}}
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
        <input class="form-control" id="name" name="name" required value="">
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
        <input class="form-control" id="latitude" name="latitude">
        <label for="longitude">Longitude</label>
        <input class="form-control" id="longitude" name="longitude">
    </div>
    <div class="form-group">
        <label for="flag">Flag</label>
        {{Form::file('flag',['id'=>'flag'])}}
        {{HTML::image('/','flag',['id'=>"flag-img",'style'=>"height:50px"])}}
    </div>
    <button type="submit" class="btn btn-success col-lg-12">Save changes</button>
{{Form::close()}}
{{--</form>--}}
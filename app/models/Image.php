<?php

class Image extends \Eloquent {
	protected $table="image";
	protected $fillable = ['path','beer_id','brewer_id'];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Style extends Model
{

	protected $table = "styles";
	protected $primaryKey = "id";
	public $incrementing = true;
	public $keyType = "int";
    protected $guarded = ["id"];
    public $timestamps = false; 

    //
}

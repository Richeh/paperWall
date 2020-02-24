<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Leaf extends Model
{

	protected $table = "leaves";
	protected $primaryKey = "id";
	public $incrementing = true;
	public $keyType = "int";
    protected $guarded = ["id"];
    public $timestamps = false; 


    public function Style(){
    	return $this->belongsTo("\App\Style");
    }    

}

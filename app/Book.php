<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $table = "books";
	protected $primaryKey = "id";
	public $incrementing = true;
	public $keyType = "int";
    protected $guarded = ["id"];
    public $timestamps = false; 

    //

    public function Leafs(){
    	return $this->hasMany("\App\Leaf");
    }

}

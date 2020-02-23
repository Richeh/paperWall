<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string("styleString");
        });

        $sql="INSERT INTO paperWall.styles (created_at,updated_at,styleString) VALUES 
(NULL,NULL,'yellow'),(NULL,NULL,'blue'),(NULL,NULL,'green'),(NULL,NULL,'red')
;";

        DB::connection()->getPdo()->exec( $sql ); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('styles');
    }
}

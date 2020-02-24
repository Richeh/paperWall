<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text("content");
            $table->integer("xPos")->default(0);
            $table->integer("yPos")->default(0);
            $table->integer("zPos")->default(0);
            $table->integer("book_id");
            $table->integer("style_id")->default(1);
        });

        $sql="INSERT INTO paperWall.leaves (created_at,updated_at,content,xPos,yPos,zPos,book_id,`style_id`) VALUES 
(NULL,NULL,'<p>Test Content1</p>',600,300,1,1,2),(NULL,NULL,'<p>Test Content2</p>',300,100,1,1,1)
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
        Schema::dropIfExists('leaves');
    }
}

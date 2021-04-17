<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();//auto primary key id increment
            //$table->integer('user_id')->unsigned()->index();//unsigned ensures positive integer, index offers speed in db
            //the above and below lines both do the same, below is easier
            $table->foreignId('user_id')->constrained()->onDelete('cascade');//Eloquent reads "user_id" as the user table and id column. Constrained means we have a constrained foreign key. onDelete means if we delete a user, all that users posts will be deleted as well
            $table->text('body');
            $table->timestamps(); //auto created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

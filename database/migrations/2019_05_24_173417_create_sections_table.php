<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->unsignedInteger('parent_id')->nullable();

         $table->string('title');
         $table->string('slug')->nullable()->unique();
         $table->text('description')->nullable();

         $table->string('image')->nullable();
         $table->string('icon')->nullable();

         $table->boolean('is_active')->default(true);
         $table->unsignedInteger('position')->default(0);

         $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_uuid');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::table('categories', function (Blueprint $table) {

            $sm = Schema::getConnection()->getDoctrineSchemaManager();

            $doctrineTable = $sm->listTableDetails('categories');

            if ($doctrineTable->hasIndex('categories__lft__rgt_parent_id_index')) {
                $table->dropIndex('categories__lft__rgt_parent_id_index');
            }

        });

        Schema::dropIfExists('categories');
    }
}

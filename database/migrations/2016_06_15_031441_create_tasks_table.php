<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('assigned_to');
            $table->integer('created_by');
            $table->string('name');
            $table->text('description');
            $table->enum('status', ['hold', 'backlog', 'selected', 'started', 'submitted', 'accepted', 'rejected', 'completed'])->default('hold');
            $table->decimal('duration', 10, 2)->nullable();
            $table->dateTime('due_at');
            $table->dateTime('start_at');
            $table->json('outcomes')->default('[]');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}

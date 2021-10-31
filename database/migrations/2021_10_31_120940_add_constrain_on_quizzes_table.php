<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstrainOnQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreignId('category_id')->change()->constrained()->cascadeOnDelete();
            $table->timestamp('published_at')->nullable();
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
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign('category_id');
            $table->dropColumn('published_at');
            $table->dropSoftDeletes();
        });
    }
}

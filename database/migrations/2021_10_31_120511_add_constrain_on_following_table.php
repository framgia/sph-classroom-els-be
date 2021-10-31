<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstrainOnFollowingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('following', function (Blueprint $table) {
            $table->foreignId('follower_id')->change()->constrained('users')->cascadeOnDelete();
            $table->foreignId('followed_id')->change()->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('following', function (Blueprint $table) {
            $table->dropForeign('follower_id');
            $table->dropForeign('followed_id');
        });
    }
}

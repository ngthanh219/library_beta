<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUserIdToRequestIdInBookRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_request', function (Blueprint $table) {
            $table->renameColumn('user_id', 'request_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_request', function (Blueprint $table) {
            $table->renameColumn('request_id', 'user_id');
        });
    }
}

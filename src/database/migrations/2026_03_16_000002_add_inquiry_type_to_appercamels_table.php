<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInquiryTypeToAppercamelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appercamels', function (Blueprint $table) {
            $table->string('inquiry_type', 20)->default('other')->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appercamels', function (Blueprint $table) {
            $table->dropColumn('inquiry_type');
        });
    }
}

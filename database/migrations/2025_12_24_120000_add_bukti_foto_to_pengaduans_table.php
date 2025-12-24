<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuktiFotoToPengaduansTable extends Migration
{
    public function up()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('bukti_foto')->nullable()->after('isi');
        });
    }

    public function down()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn('bukti_foto');
        });
    }
}

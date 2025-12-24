<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerluPerhatianToPengaduansTable extends Migration
{
    public function up()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->boolean('perlu_perhatian')->default(false)->after('bukti_foto');
            $table->text('catatan_perhatian')->nullable()->after('perlu_perhatian');
        });
    }

    public function down()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn(['perlu_perhatian', 'catatan_perhatian']);
        });
    }
}

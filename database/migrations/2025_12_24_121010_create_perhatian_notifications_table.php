<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerhatianNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('perhatian_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaduan_id');
            $table->unsignedBigInteger('ketua_id')->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('pengaduan_id')->references('id')->on('pengaduans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('perhatian_notifications');
    }
}

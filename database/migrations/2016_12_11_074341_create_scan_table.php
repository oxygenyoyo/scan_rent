<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('scans')) {
            Schema::dropIfExists('scans');
        }

        Schema::create('scans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('scan_id');
            $table->string('scan_ip');
            $table->boolean('status')->default(0);
            $table->unsignedInteger('order_id')->nullable();
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
        Schema::dropIfExists('scans');
    }
}

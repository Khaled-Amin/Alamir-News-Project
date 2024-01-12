<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameWebsite' , 30);
            $table->string('linkWebsite' , 128);
            $table->longText('Keywords')->nullable();
            $table->longText('Description');
            $table->string('socialMidiaFacebook' , 128)->nullable();
            $table->string('socialMidiaTelegram' , 128)->nullable();
            $table->string('socialMidiaInstagram' , 128)->nullable();
            $table->string('socialMidiaLinkedin' , 128)->nullable();
            $table->string('socialMidiaTwitter' , 128)->nullable();
            $table->string('favicon' , 128)->nullable();
            $table->string('meta_image' , 128)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

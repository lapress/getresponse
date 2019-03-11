<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('intro')->nullable();
            $table->mediumText('body')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->boolean('perfect_timing')->default(false);
            $table->boolean('time_travel')->default(false);
            $table->tinyInteger('status')->default(0);
            $table->string('sender')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->nullable();
            $table->unsignedInteger('sender_id')->nullable();
            $table->string('key');
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
        Schema::dropIfExists('campaigns');
    }
}

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
        Schema::create('newsletter_campaigns', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');

            $table->string('title')->nullable();
            $table->text('intro')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('sender')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->nullable();
            $table->unsignedInteger('sender_id')->nullable();
            $table->boolean('perfect_timing')->default(false);
            $table->boolean('time_travel')->default(false);
            $table->string('vars')->nullable();
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
        Schema::dropIfExists('newsletter_campaigns');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterTransationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('newsletter_campaign_id')->index();
            $table->boolean('perfect_timing')->default(false);
            $table->boolean('time_travel')->default(false);
            $table->string('provider_id');
            $table->boolean('test')->default(true);
            $table->string('provider_status')->nullable();
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
        Schema::dropIfExists('newsletter_transactions');
    }
}

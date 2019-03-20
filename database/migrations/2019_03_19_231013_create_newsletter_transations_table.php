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
            $table->uuid('uuid');
            $table->primary('uuid');

            $table->unsignedInteger('newsletter_campaign_id')->index();
            $table->unsignedInteger('provider_campaign_id')->index();
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

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

            $table->uuid('newsletter_campaign_id')->index();
            $table->string('provider_id')->index();
            $table->boolean('test')->default(true);
            $table->string('sender')->nullable();
            $table->string('provider_status')->nullable();
            $table->integer('sent')->nullable();
            $table->integer('total')->nullable();
            $table->dateTime('sent_on')->nullable();
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

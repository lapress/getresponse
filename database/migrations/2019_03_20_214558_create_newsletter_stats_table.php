<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_stats', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->primary('uuid');

            $table->uuid('transaction_uuid')->index();

            $table->integer('sent')->default(0);
            $table->integer('totalOpened')->default(0);
            $table->integer('uniqueOpened')->default(0);
            $table->integer('totalClicked')->default(0);
            $table->integer('uniqueClicked')->default(0);
            $table->integer('goals')->default(0);
            $table->integer('uniqueGoals')->default(0);
            $table->integer('forwarded')->default(0);
            $table->integer('unsubscribed')->default(0);
            $table->integer('bounced')->default(0);
            $table->integer('complaints')->default(0);

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
        Schema::dropIfExists('newsletter_stats');
    }
}

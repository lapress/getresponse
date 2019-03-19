<?php

namespace LaPress\GetResponse;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendCampaignToProviderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var NewsletterCampaign
     */
    private $campaign;

    /**
     * Create a new job instance.
     *
     * @param NewsletterCampaign $campaign
     */
    public function __construct(NewsletterCampaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        app(Manager::class)->create($this->campaign);

        if ($this->campaign->status === NewsletterCampaign::STATUS_DRAFT) {
            $this->campaign->update(['status' => NewsletterCampaign::STATUS_SENT]);
        }
    }
}

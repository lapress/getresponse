<?php

namespace LaPress\GetResponse;

use Carbon\Carbon;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class Manager
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Repository
     */
    private $cache;

    /**
     * @param Request    $request
     * @param Repository $cache
     */
    public function __construct(Request $request, Repository $cache)
    {
        $this->request = $request;

        $this->client = new Client(config('services.getresponse.key'));
        $this->cache = $cache;
    }

    /**
     * @param string $email
     * @param string $campaignId
     * @return mixed
     */
    public function subscribe(string $email, string $campaignId)
    {
        return $this->client->addContact([
            'email'    => $email,
            'campaign' => [
                'campaignId' => $campaignId,
            ],
            'ip'       => $this->request->ip(),
        ]);
    }

    /**
     * @return Collection
     */
    public function getCampaigns(): Collection
    {
        $response = $this->client->getCampaigns();

        if (!empty($response->httpStatus) && $response->httpStatus == 401) {
            return collect([
                [
                    'name'  => 'Brak kampanii',
                    'value' => '',
                ],
            ]);
        }

        return collect($response)->map(function ($campaign) {
            return [
                'name' => $campaign->name,
                'id'   => $campaign->campaignId,
            ];
        });
    }

    /**
     * @return Collection
     */
    public function getSenders(): Collection
    {
        return collect($this->client->getFromFields());
    }

    /**
     * @param NewsletterCampaign $campaign
     * @return mixed
     */
    public function create(NewsletterCampaign $campaign)
    {
        $now = Carbon::now()->addMinutes(2);
        $sendOn = $now;

        if ($campaign->sent_at && $campaign->sent_at->isFuture()) {
            $sendOn = $campaign->sent_at;
        }

        return $this->client->sendNewsletter([
            'name'         => $campaign->title,
            'subject'      => $campaign->title,
            'editor'       => 'custom',
            'campaign'     => [
                'campaignId' => $campaign->provider_id,
            ],
            'sendOn'       => $sendOn->format('Y-m-d\TH:i:sO'),
            'fromField'    => [
                'fromFieldId' => $campaign->sender,
            ],
            'content'      => [
                'html'  => stripcslashes($campaign->body),
                'plain' => null,
            ],
            'flags'        => ['openrate', 'clicktrack', 'google_analytics'],
            'sendSettings' => [
                'selectedCampaigns' => [$campaign->provider_id],
                'timeTravel'        => (bool)$campaign->time_travel,
                'perfectTiming'     => (bool)$campaign->perfect_timing,
            ],
        ]);
    }
}

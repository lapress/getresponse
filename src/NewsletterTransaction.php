<?php

namespace LaPress\GetResponse;

use Illuminate\Database\Eloquent\Model;
use Spatie\BinaryUuid\HasBinaryUuid;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class NewsletterTransaction extends Model
{
    use HasBinaryUuid;

    protected $guarded = [];

    protected $hidden = ['newsletter_campaign_id'];

    protected $with = ['stats'];

    protected $casts = [
        'test' => 'boolean'
    ];

    /**
     * Campaign
     * Define a relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign()
    {
        return $this->belongsTo(NewsletterCampaign::class, 'newsletter_campaign_id', 'newsletter_campaign_id');
    }

    /**
     * Stats
     * Define a relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stats()
    {
        return $this->hasOne(NewsletterStats::class, 'transaction_uuid', 'uuid');
    }

}

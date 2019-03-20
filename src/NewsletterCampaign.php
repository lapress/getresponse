<?php

namespace LaPress\GetResponse;

use Illuminate\Database\Eloquent\Model;
use Spatie\BinaryUuid\HasBinaryUuid;

/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class NewsletterCampaign extends Model
{
    use HasBinaryUuid;

    protected $guarded = [];
    protected $hidden = ['body'];

    const STATUS_DRAFT = 0;
    const STATUS_TESTED = 1;
    const STATUS_SENT = 2;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($campaign) {
            if (empty($campaign->key)) {
                $campaign->key = str_random(20);
            }
        });
    }
}

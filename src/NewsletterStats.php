<?php

namespace LaPress\GetResponse;

use Illuminate\Database\Eloquent\Model;
use Spatie\BinaryUuid\HasBinaryUuid;
/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class NewsletterStats extends Model
{
    use HasBinaryUuid;

    /**
     * @var string
     */
    protected $table = 'newsletter_stats';

    /**
     * @var array
     */
    protected $hidden = ['transaction_uuid'];

    /**
     * @var array
     */
    protected $guarded = [];


}

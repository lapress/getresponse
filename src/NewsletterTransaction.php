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
}

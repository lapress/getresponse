<?php

namespace LaPress\GetResponse;

use App\Models\Post;
use Carbon\Carbon;
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
    protected $casts = [
        'vars'    => 'collection',
        'sent_at' => 'datetime',
    ];

    protected $with = ['transactions'];

    const STATUS_DRAFT = 0;
    const STATUS_TESTED = 1;
    const STATUS_SENT = 2;

    /**
     * @var string
     */
    private $env;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($campaign) {
            if (empty($campaign->key)) {
                $campaign->key = str_random(20);
            }
        });
    }

    public function toDecoratedArray()
    {
        $postsCollection = Post::find($this->vars->get('posts'))->mapWithKeys(function ($post) {
            return [$post->ID => $post];
        });
        $posts = collect($this->vars->get('posts'))->map(function ($id) use ($postsCollection) {
            return $postsCollection->get($id);
        });

        return array_merge(
            $this->toArray(),
            [
                'vars' => $this->vars->put('posts', $posts),
            ]);
    }

    /**
     * Transations
     * Define a relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(NewsletterTransaction::class, 'newsletter_campaign_id', 'uuid')->latest();
    }
}

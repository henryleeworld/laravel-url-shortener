<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ShortUrls extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'short_urls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'code',
        'expired_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expired_at',
    ];

    public function couldExpire(): bool
    {
        return $this->expired_at !== null;
    }

    /**
     * Return whether an url has expired.
     *
     * @return bool
     */
    public function hasExpired(): bool
    {
        if (! $this->couldExpire()) {
            return false;
        }
        $expiredAt = new Carbon($this->expired_at);
        return ! $expiredAt->isFuture();
    }
}

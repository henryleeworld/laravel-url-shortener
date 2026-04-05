<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
     * @var list<string>
     */
    protected $fillable = [
        'url',
        'code',
        'expired_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
        ];
    }

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

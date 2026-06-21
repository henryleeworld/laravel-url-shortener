<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

#[Fillable(['url', 'code', 'expired_at'])]
#[Table('short_urls')]
class ShortUrls extends Model
{
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

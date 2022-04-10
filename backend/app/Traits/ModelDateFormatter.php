<?php

declare(strict_types=1);

namespace App\Traits;

use Carbon\Carbon;

trait ModelDateFormatter
{
    private string $format = 'Y-m-d H:i:s';

    /**
     * Format created_at attribute.
     * 
     * @return string
     */
    public function getCreatedAtAttribute(): string
    {
        return Carbon::parse($this->attributes['created_at'])->format($this->format);
    }

    /**
     * Format updated_at attribute.
     * 
     * @return string
     */
    public function getUpdatedAtAttribute(): string
    {
        return Carbon::parse($this->attributes['updated_at'])->format($this->format);
    }

}
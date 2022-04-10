<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Client;
use App\Traits\ModelDateFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory, ModelDateFormatter;

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}

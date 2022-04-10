<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Payment;
use App\Traits\ModelDateFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory, ModelDateFormatter;
   
    public function latestPayment(): HasOne
    {
        return $this->hasOne(Payment::class)->latest();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}

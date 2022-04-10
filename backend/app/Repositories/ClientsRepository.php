<?php
namespace App\Repositories;

use App\Interfaces\ClientsRepositoryInterface;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ClientsRepository implements ClientsRepositoryInterface
{
    public function getAllClientWithLastPayment(): Builder
    {
        return Client::with('latestPayment');
    }

    public function getAllClientWithLastPaymentBetween(Carbon $startDate, Carbon $endDate): Builder
    {
        return $this->getAllClientWithLastPayment()
        ->whereHas('latestPayment', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('payments.created_at', [$startDate, $endDate]);
        });
    }

    public function getLastInDays(Carbon $endDate, int $days): Builder
    {
        $startDate = $endDate->copy()->subDays($days);
        return $this->getAllClientWithLastPaymentBetween($startDate, $endDate);
    }
}
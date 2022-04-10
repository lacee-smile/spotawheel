<?php

declare(strict_types=1);

namespace App\Interfaces;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

interface ClientsRepositoryInterface
{
  /**
   * Get all client with last payment.
   *
   * @return Builder
   */
  public function getAllClientWithLastPayment(): Builder;

  /**
   * Get client who has last payment between start and end date.
   *
   * @param Carbon $startDate
   * @param Carbon $endDate
   * @return Builder
   */
  public function getAllClientWithLastPaymentBetween(Carbon $startDate, Carbon $endDate): Builder;

  /**
   * Get clients who has last payment in the last days from end date.
   *
   * @param Carbon $endDate
   * @param integer $days
   * @return Builder
   */
  public function getLastInDays(Carbon $endDate, int $days): Builder;
}
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\ClientsRepositoryInterface;
use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClientController extends Controller
{
    /**
     * Client repository.
     *
     * @var ClientsRepositoryInterface
     */
    private ClientsRepositoryInterface $clientsRepository;

    /**
     * Constructor.
     *
     * @param ClientsRepositoryInterface $clientsRepository
     */
    public function __construct(ClientsRepositoryInterface $clientsRepository)
    {
        $this->clientsRepository = $clientsRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        if($request->has('start_date') and $request->has('end_date')) {
            $clients = $this->handleDateFiltered($request);
        } else {
            $clients = $this->clientsRepository->getAllClientWithLastPayment();
        }
        return response()->json($clients->get());   
        return response()->json($clients->get()->map(function(Client $client) {
            $client->created_at->format('Y-m-d');
            $client->updated_at->format('Y-m-d');
            if ($client->latest_payment) {
                $client->latest_payment->created_at->format('Y-m-d');
                $client->latest_payment->updated->format('Y-m-d');
            }
            return $client;
        }));
    }

    private function handleDateFiltered(Request $request): Builder
    {
        $request->validate([
            'start_date' => [
                'required',
                'date',
                'before:' . $request->get('end_date'),
            ],
            'end_date' => [
                'required',
                'date',
                'after:' . $request->get('start_date'),
            ],
        ]);
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
        return $this->clientsRepository->getAllClientWithLastPaymentBetween($startDate, $endDate);
    }
}

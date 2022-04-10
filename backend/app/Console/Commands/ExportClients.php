<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Interfaces\ClientsRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class ExportClients extends Command
{
    /**
     * The default days back from start date.
     * 
     * @var int
     */
    private const DAYS = 30;

    /**
     * The default exported filename.
     * 
     * @var string
     */
    private const DEFAULT_FILENAME = 'clients.csv';

    /**
     * The exported file header.
     * 
     * @var array
     */
    private const FILE_HEADER = [
        'Name',
        'Surname',
        'Amount',
        'Payment date',
    ];

    /**
     * Client repository.
     *
     * @var ClientsRepositoryInterface
     */
    private ClientsRepositoryInterface $clientsRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:clients
                            {--filename=' . self::DEFAULT_FILENAME . ' : The filename to export to}
                            {--days=' . self::DAYS . ' : The number of days to export}
                            {--date= : The end date to export in format YYYY-MM-DD}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command exports all clients with their latest payment';

    /**
     * Constructor.
     *
     * @param ClientsRepositoryInterface $clientsRepository
     */
    public function __construct(ClientsRepositoryInterface $clientsRepository)
    {
        parent::__construct();
        $this->clientsRepository = $clientsRepository;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $filename = $this->option("filename") ?: self::DEFAULT_FILENAME;
        $days = $this->option("days") ?: self::DAYS;
        $endDate = $this->option("date") ? Carbon::parse($this->option("date")) : Carbon::now();

        $resource = fopen($filename, 'w');

        $clients = $this->clientsRepository->getLastInDays($endDate, (int) $days)->get();

        $this->writeHeader($resource);

        $this->writeData($resource, $clients);

        fclose($resource);
    }

    /**
     * Write the header into the CSV.
     *
     * @param resource $resource
     * @return void
     */
    private function writeHeader($resource): void
    {
        fputcsv($resource, self::FILE_HEADER);
    }

    /**
     * Write the data into the CSV.
     *
     * @param resource $resource
     * @param Collection $data
     * @return void
     */
    private function writeData($resource, Collection $data): void
    {
        foreach ($data as $item) {
            fputcsv($resource, [
                $item->name,
                $item->surname,
                $item->latestPayment->amount,
                $item->latestPayment->created_at,
            ]);
        }
    }
}

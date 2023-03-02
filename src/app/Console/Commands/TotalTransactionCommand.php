<?php

namespace App\Console\Commands;

use App\Repository\TransactionRepository;
use Illuminate\Console\Command;

class TotalTransactionCommand extends Command
{
    public function __construct(private readonly TransactionRepository $transaction_repository)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'financial:total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Total Transactions';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->table(
            $this->tableHeader(),
            $this->calculateRow(),
        );
    }

    private function tableHeader(): array
    {
        return [
            'date'         => 'Date',
            'total_amount' => 'Total Amount',
            'total_count'  => 'Total Count',
        ];
    }

    private function calculateRow(): array
    {
        return [
            [
                'date'         => now()->toDateTimeString(),
                'total_amount' => $this->transaction_repository->total(),
                'total_count'  => $this->transaction_repository->count(),
            ]
        ];
    }
}

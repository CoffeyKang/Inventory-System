<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;

class FillUpSO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FillUpSO:fillupSO';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is to fill up so every minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        renewFillUp();
        InventoryExcelFile();
        calculateCustomerOnorder();
        
    }
}

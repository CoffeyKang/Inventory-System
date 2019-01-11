<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;

class InventoryExcelForWeb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InventoryExcelForWeb:InventoryExcelForWeb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating inventory excel files for gla web every day, so that the dealers can download from web';

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
        InventoryExcelFile();
        LOG::useFiles(storage_path('logs/Generating InventoryExcelFile.log'));
        LOG::info("Generat successfully, date('Y-m-d')");
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MonthlySetPTD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MonthlySetPTD:MonthlySetPTD';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MonthlySetPTD';

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
        setPtd();
        /** double check customer ytd sls and on order and item ytd and ptd*/
        calculateCustomerOnorder();
        itemYTD();
        LOG::useFiles(storage_path('logs/SetPTD0.log'));
        LOG::info("Successfully, date('Y-m-d')");
    }
}

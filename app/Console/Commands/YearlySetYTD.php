<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class YearlySetYTD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'YearlySetYTD:YearlySetYTD';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'YearlySetYTD 0';

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
        setYTD();
        LOG::useFiles(storage_path('logs/SetYtd0.log'));
        LOG::info("Successfully, date('Y-m-d')");
    }
}

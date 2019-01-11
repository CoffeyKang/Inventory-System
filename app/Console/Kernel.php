<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\TestLog::class,
        Commands\FillUpSO::class,
        Commands\InventoryExcelForWeb::class,
        Commands\MonthlySetPTD::class,
        Commands\YearlySetYTD::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {   
        //** business status  */
        $schedule->command('TestLog:james')
                 ->monthlyOn(date('t'), '23:23');
        
        $schedule->command('FillUpSO:fillupSO')
                 ->everyMinute();     
                 
        $schedule->command('InventoryExcelForWeb:InventoryExcelForWeb')
                 ->dailyAt('23:45');   
                  
        $schedule->command('MonthlySetPTD:MonthlySetPTD')
                 ->monthlyOn(date('t'), '23:23');
        
        $schedule->command('YearlySetYTD:YearlySetYTD')
                 ->dailyAt('23:45')
                 ->when(function(){
                     return date('Y-m-d') == date('Y-12-31'); 
                 });
        
    }   

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

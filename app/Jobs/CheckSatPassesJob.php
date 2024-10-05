<?php

namespace App\Jobs;

use App\Services\LandSatServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckSatPassesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $landSatServices=new LandSatServices();
        
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $landSatServices=new LandSatServices();

        $landSatServices->checkSatPasses();
        //
    }
}

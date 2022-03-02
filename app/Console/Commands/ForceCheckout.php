<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Checkin;

class ForceCheckout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkout:force';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forces opencheckouts to checkout at spesified time';

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
     * @return int
     */
    public function handle()
    {
        $checkins = Checkin::whereNull('checkout_at');
        foreach ($checkins as $checkin) {
            $checkin->checkout_at = now();
            $checkin->forced_checkout = true;
            $checkin->save();
        }

        $this->info('Forced all active checkins to checkout');
    }
}

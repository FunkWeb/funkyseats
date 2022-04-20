<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;

class DeleteOldBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Bookings:DeleteOld';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes bookings that are over a year old';

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
        $bookings = Booking::where('from', '<=', now()->subYear(1))->get();
        foreach ($bookings as $booking) {
            $booking->delete();
        }

        $this->info('Delete bookings that are over a year old from the database');
    }
}

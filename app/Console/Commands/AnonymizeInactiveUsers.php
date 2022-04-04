<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class AnonymizeInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'User:Anonymize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Anonymize users that have been inactive';

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
        //gets users who have been inactive for a month and anonymizes them
        $users = User::where('last_active_at', '<=', now()->subMonth(1))->get();

        foreach ($users as $user) {
            $user->anonymize();
        }

        $this->info('Anonymized inactive users');
    }
}

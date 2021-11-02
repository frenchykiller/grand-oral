<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DisableUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disables:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable unauthorized users (email different from @viacesi.fr)';

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
        $results = DB::table('users')->whereRaw("email NOT LIKE '%@viacesi.fr'")->update(['active' => 0]);

        return $results;
    }
}

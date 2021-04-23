<?php

namespace App\Console\Commands;

use App\Http\Controllers\BotController;
use Illuminate\Console\Command;

class UpdateBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking for updates in bot feed';

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
        BotController::botUpdate();
    }
}

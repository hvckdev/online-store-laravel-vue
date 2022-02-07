<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:admin {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the admin role from user by id.';

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
    public function handle(): int
    {
        $user = User::find($this->argument('user'));

        if ($user->hasRole('admin')) {
            $user->removeRole('admin');

            $this->info("{$user->name} is no longer admin.");
        }

        return 0;
    }
}

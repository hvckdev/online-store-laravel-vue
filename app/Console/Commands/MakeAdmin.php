<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give the admin role for user by id';

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

        if (!empty($user->roles->first())) {
            $user->removeRole($user->roles->first());
        }

        $user->assignRole(Role::findByName('admin'));

        return 0;
    }
}

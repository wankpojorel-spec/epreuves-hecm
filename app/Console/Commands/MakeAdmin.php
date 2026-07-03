<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    protected $signature = 'user:make-admin {email}';
    protected $description = "Promeut un utilisateur existant au rôle d'administrateur";

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error("Aucun utilisateur trouvé avec l'email : " . $this->argument('email'));
            return self::FAILURE;
        }

        $user->role = 'admin';
        $user->save();

        $this->info("{$user->name} ({$user->email}) est maintenant administrateur.");
        return self::SUCCESS;
    }
}
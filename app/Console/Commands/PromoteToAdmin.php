<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:promote-to-admin {email}')]
#[Description('Promote an existing user to the admin role')]
class PromoteToAdmin extends Command
{
    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (! $user) {
            $this->error("No user found with email {$this->argument('email')}");

            return self::FAILURE;
        }

        // role is intentionally excluded from $fillable to prevent privilege
        // escalation via mass assignment from web requests; forceFill() bypasses
        // that guard for this trusted, CLI-only admin promotion path.
        $user->forceFill(['role' => 'admin'])->save();

        $this->info("{$user->email} is now an admin.");

        return self::SUCCESS;
    }
}

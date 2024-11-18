<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Password;

class SendResetLink implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public string $email;

    public function __construct(string $email)
    {
        //
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Password::sendResetLink(['email' => $this->email]);
    }
}

<?php

namespace App\Console\Commands\Api\User;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveExpiredAccessTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-expired-access-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired access tokens';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredTokens = DB::table('oauth_access_tokens')
            ->where('expires_at', '<', now())
            ->get();

        foreach ($expiredTokens as $expiredToken) {
            DB::table('oauth_access_tokens')
                ->where('id', $expiredToken->id)
                ->delete();
        }

        $this->info('Expired access tokens cleared successfully.');
    }
}

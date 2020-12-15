<?php

namespace Akoshodi\GSuite\Commands;

use Illuminate\Console\Command;
use Akoshodi\GSuite\Actions\DeleteAccountAction;

class DeleteAccount extends Command
{
    protected $signature = 'gsuite:delete-account';

    protected $description = 'Delete a G-Suite account';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(DeleteAccountAction $deleteAccountAction)
    {
        $email = $this->ask('What is the primary email address of the account you would like to delete?');

        if (!$this->confirm("Are you sure your would like to delete the following account: {$email}", false)) {
            return;
        }

        $this->info('Deleting account...');

        try {
            $deleteAccountAction->execute($email);

            $this->line('');

            $this->info('Account deleted!');
        } catch (\Exception $e) {
            logger($e);

            $this->error('An error has occured and was logged, please try again later, or talk to an admin.');
        }
    }
}

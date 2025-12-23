<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\InventoryReminderMail;
use Illuminate\Support\Facades\Mail;

class SendInventoryRemminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commands:send-inventory-remminder-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $recipient = "carljustinem984@gmail.com";

        Mail::to($recipient)->send(new InventoryReminderMail());

        $this->info('Inventory reminder email sent successfully to ' . $recipient);
    }
}

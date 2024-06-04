<?php

namespace App\Console\Commands;

use App\Models\Qrcode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TrashQrCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:trash-qr-code';

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
        Qrcode::truncate();
    }
}

<?php

namespace App\Console\Commands;

use App\Mail\MailBirthdayCustomer;
use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try{
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $customers = DB::table('customers')->select('*')
                ->whereRaw("MONTH(date_of_birth) = MONTH(NOW()) AND DAY(date_of_birth) = DAY(NOW())")
                ->get();

            if (!count($customers) == 0) {

                foreach ($customers as $customer) {
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }

                    DB::table('vouchers')->insert([
                        'voucher' => $randomString,
                    ]);

                    $mailData = [
                        'title' => 'Happy birthday to ' . $customer->name,
                        'body' => "Dear $customer->name",
                        'voucher' => $randomString
                    ];
                        Mail::to($customer->email)->send(new MailBirthdayCustomer($mailData));
                }
                return 0;
            }
            return 1;

        }catch(\Exception $e){
            Log::error('errors ' . $e->getMessage() . 'getLine ' . $e->getLine());
            return 1;
        }

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\Customer\CustomerServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    protected $customerService;


    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;

    }

    public function redirect($provider)

    {

        return Socialite::driver($provider)->redirect();

    }



    public function callback($provider)

    {



        $getInfo = Socialite::driver($provider)->user();



        $customer = $this->createUser($getInfo,$provider);



       return auth('api')->login($customer);






    }

    function createUser($getInfo,$provider){



     $customer = Customer::where('provider_id', $getInfo->id)->first();



     if (!$customer) {

         $customer = $this->customerService->create([

            'name'     => $getInfo->name,

            'password'     => Hash::make(12345678),

            'email'    => $getInfo->email,

            'provider' => $provider,

            'provider_id' => $getInfo->id

        ]);

      }

      return $customer;

    }
}

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
    protected $authController;


    public function __construct(CustomerServiceInterface $customerService,AuthController $authController)
    {
        $this->customerService = $customerService;
        $this->authController= $authController;

    }

    public function redirect($provider)

    {
        $this->middleware('cors');
        $res=Socialite::driver($provider)->redirect()->getTargetUrl();

        return  response()->json($res,200);

    }



    public function callback($provider)

    {
        $this->middleware('cors');

        $getInfo = Socialite::driver($provider)->stateless()->user();

        $customer = $this->createUser($getInfo,$provider);


      $token= auth('api')->login($customer);
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('api')->factory()->getTTL() * 60,
        'user' =>$customer
      ],200);






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

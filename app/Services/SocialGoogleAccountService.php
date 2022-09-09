<?php 
	
	namespace App\Services;
	
	use App\Modules\Users\Models\SocialFacebookAccount;
	use App\Modules\Users\Models\User;
	
	use Laravel\Socialite\Contracts\User as ProviderUser;

	class SocialGoogleAccountService
	{
	    public function createOrGetUser(ProviderUser $providerUser)
	    {
	        try {
	            $user = $providerUser;
	        } catch (\Exception $e) {
	            return redirect()->route('actionUsersSignIn');
	        }

	        $CheckUser = User::whereEmail($user->email)->first();

	        if($CheckUser){
	            return $CheckUser;
	        } else {

	        	$UserData = User::create([
                    'email' => $user->email,
                    'name' => explode(' ', $user->name)[0],
                    'lastname' => explode(' ', $user->name)[1],
                    'password' => md5(rand(1,10000)),
                    'google_id' => $user->email,
                ]);

                return $UserData;
	        }
	    }
	}
<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use Exception;
use App\User;
use Session;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
class GoogleLoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirect($service) 
    {
        return Socialite::driver ( $service )->redirect ();
    }

    public function callback($service) 
    {
        $user = Socialite::with ( $service )->user ();
        try 
        {
            //$user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser)
            {
                //echo "Already exist";
                if($userlog=DB::table('users')->where('id',$finduser->id)->where('status',1)->first())
                {
                    $user_type = $userlog->user_type;
                    if($user_type==3)
                    {
                        Auth::login($userlog);
                        //session()->put('logged_user',$userlog);
                        return redirect('/');
                    }
                    else
                    {
                        Auth::login($userlog);
                        //session()->put('logged_user',$userlog);
                        return redirect('/welcome-seller');
                    }
                }
            }
            else
            {
                //echo "New User";
                $buyer = 'BUYER';
                $random_str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $shuffle_str = str_shuffle($random_str);
                $u_id = $buyer.substr($shuffle_str,0,6);//die;
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id
                ]);
                $lastuserid = DB::getPdo()->lastInsertId();
                $updateData = array(
                    'u_id'=>$u_id,
                    'user_type'=>3,
                    'is_admin'=>2,
                    'status'=>1,
                    'google_id'=>$user->id
                );
                DB::table('users')->where('id',$lastuserid)->update($updateData);
                $buyer_data = [
                "uid" =>$u_id,
                ];
                DB:: table('buyers')->insertGetId($buyer_data);
                if($userlog=DB::table('users')->where('id',$lastuserid)->where('status',1)->first())
                {
                    $user_type = $userlog->user_type;
                    if($user_type==3)
                    {
                        Auth::login($newUser);
                        //session()->put('logged_user',$userlog);
                        return redirect('/');
                    }
                    else
                    {
                        Auth::login($newUser);
                        //session()->put('logged_user',$userlog);
                        return redirect('/welcome-seller');
                    }
                }
                //Auth::login($newUser);
                //return view ( '/front/go' )->withDetails ( $user )->withService ( $service );
            }
        }
        catch (Exception $e) 
        {
            return redirect($service);
        }
    }

    /*public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }*/

    /*public function handleGoogleCallback()
    {
        try 
        {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser)
            {
                Auth::login($finduser);
                return redirect('/home');
            }
            else
            {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id
                ]);
                Auth::login($newUser);
                return redirect()->back();
            }
        } 
        catch (Exception $e) 
        {
            return redirect('google');
        }
    }*/
}
?>
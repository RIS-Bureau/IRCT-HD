<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\EmailService;

class LoginController extends Controller
{
    protected $request;

    function __construct(Request $request){
        $this->request = $request;
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function existEmail(){
        $email = $this->request->input('email');
        $user = User::where('email', $email)
                ->first();
            $response="";
                ($user) ? $response = "exist" : $response = "not_exist";
                return response()->json([
                'response' => $response
                ]);

    }
    public function activationCode($token)
    {
        $user = User::where('activation_token', $token)->first();
        if(!$user){
            return redirect()->route('login')->with('danger', 'Cette page \'URL\' n\'existe pas.');
        }
        if($this->request->isMethod('post')){
            $code = $user->activation_code;
            $activation_code = $this->request->input('activation-code');
            if($code != $activation_code){
                return back()->with([
                    'danger' => 'le code saisi ne correspond pas au code envoyer!',
                    'activation_code' => $activation_code
                ]);
            }else{
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'is_verified' => 1,
                        'activation_code' => '',
                        'activation_token' => '',
                        'email_verified_at' => new \DateTimeImmutable,
                        'updated_at' => new \DateTimeImmutable
                    ]);
                    return redirect()->route('login')->with('success', 'Votre adresse e-mail est vérifiée');
            }
        }
        return view('auth.activation_code', ['token' => $token]);
    }
    public function userChecker(){
            $activation_token = Auth::user()->activation_token;
            $is_verified = Auth::user()->is_verified;
            if($is_verified == 0){
                Auth::logout();
            }
            if($is_verified != 1)
            {
                Auth::logout();
                return redirect()->route('app_activation_code', ['token' => $activation_token ])
                ->with('warning', 'Your account is not activated yet, Please check your mail-box and activate the account by coping the code or resend the message again.');
            }else{
                return redirect()->route('app_dashboad');
            }
    }
    public function resendActivationCode($token){
        $user = User::where('activation_token', $token)->first();
        $email = $user->email;
        $name = $user->name;
        $activation_token = $user->activation_token;
        $activation_code = $user->activation_code;
        $emailSend = new EmailService;
        $subject = "Veuillez activer votre compte IRCT";
        $emailSend->sendEmail($subject, $email, $name, true, $activation_code, $activation_token);
        return redirect()->route('app_activation_code', ['token'=>$token]) ->with('success', 'Le code d\'activation a été renvoyé avec succès.');
    }
    public function activationAccountLink($token){
        $user = User::where('activation_token', $token)->first();
        if(!$user){
            return redirect()->route('login')->with('danger', 'Cette page \'URL\' n\'existe pas.');
        }
        DB::table('users')
        ->where('id', $user->id)
        ->update([
            'is_verified' => 1,
            'activation_code' => '',
            'activation_token' => '',
            'email_verified_at' => new \DateTimeImmutable,
            'updated_at' => new \DateTimeImmutable
        ]);
        return redirect()->route('login')->with('success', 'Votre adresse e-mail est vérifiée');

    }
    public function ActivationAccountChangeEmail ($token){
        $user = User::where('activation_token', $token)->first();
        if($this->request->isMethod('post')){
            $new_email = $this->request->input('new-email');
            $user_existe = User::where('email', $new_email)->first();
            if($user_existe){
                return back()->with([
                    'danger' => 'Adresse e-mail déjà utilisée!',
                    'new_email' => $new_email
                ]);
            }else{
                DB::table('users')
                ->where('id', $user->id)
                ->update(['email' => $new_email,
                        'updated_at' => new \DateTimeImmutable
            ]);
                $activation_code = $user->activation_code;
                $activation_token = $user->activation_token;
                $name = $user->name;

                $emailSend = new EmailService;
                $subject = "Veuillez activer votre compte IRCT";
                $emailSend->sendEmail($subject, $new_email, $name, true, $activation_code, $activation_token);
                return redirect()->route('app_activation_code', ['token'=>$token]) ->with('success', 'Le code d\'activation a été renvoyé avec succès.');
            }
        }else{
            return view('auth.activation_account_change_email', ['token' => $token]);
        }



    }



}

<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\EmailService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        /*Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();*/
        $email = $input['email'];
        //les token de l'activation des compte utilisateur
        $activation_token = md5(uniqid()) . $email . sha1($email);
        $activation_code = "";
        $length_code = 6;

    for($x = 0; $x < $length_code; $x++)
    {
        $activation_code .=mt_rand(0,9);
    }
        $name = $input['firstname'] . ' ' . $input['lastname'];

        $emailSend = new EmailService;
        $subject = "Veuillez activer votre compte IRCT";
        $emailSend->sendEmail($subject, $email, $name, true, $activation_code, $activation_token);

        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($input['password']),
            'activation_code' => $activation_code,
            'activation_token' => $activation_token,
        ]);
    }
}

<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function signinForm()
    {
        return view('auth/signin'); 
    }

    public function signupForm()
    {
        return view('auth/signup', [
            'validation' => \Config\Services::validation()
        ]);
    }

    public function signin()
{
    ini_set('display_errors', '1');
    error_reporting(E_ALL);

    $model = new \App\Models\UserModel();
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $model->where('email', $email)->first();

    
    if (!$user) {
        die("DEBUG: User not found in database for email: " . $email);
    }

    
    if (!password_verify($password, $user['password'])) {
        die("DEBUG: Password mismatch. Stored hash: " . $user['password']);
    }

    
    session()->set(['isLoggedIn' => true, 'userId' => $user['id']]);
    
    
    return view('home/index'); 
}

    public function signup()
    {
        $rules = [
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[8]',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/signup', ['validation' => $this->validator]);
        }

        $model = new \App\Models\UserModel();
        $model->save([
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/sign-in')->with('message', 'Account created! Please login.');
    }

    public function logout()
{
    session()->destroy();
    return redirect()->to('/sign-in')->with('message', 'You have been signed out.');
}
}
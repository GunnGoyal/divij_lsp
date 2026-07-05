<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function update()
    {
        $userId = session()->get('userId');
        $model = new UserModel();
        
        $updateData = ['username' => $this->request->getPost('username')];

        // Only update password if provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->update($userId, $updateData);
        return redirect()->to('/profile')->with('success', 'Profile updated.');
    }

    public function deleteAccount()
    {
        $model = new UserModel();
        $model->delete(session()->get('userId'));
        
        session()->destroy();
        return redirect()->to('/')->with('message', 'Account deleted.');
    }

    public function index()
{
    $model = new UserModel();
    $user = $model->find(session()->get('userId'));
    return view('profile/index', ['user' => $user]);
}
}
<?php

namespace App\Controllers;

// use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        //
    }

    public function login()
    {
        helper('form');
        $session = session();
        $userModel = new UserModel();
        $post     = $this->request->getPost(null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = $this->request->getPost('username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = $this->request->getPost('password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (! $this->request->is('post')) {
            return view('login');
        }

        if (! $this->validateData($post, [
            'username' => 'required|max_length[255]|min_length[3]',
            'password'  => 'required|max_length[400]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return view('login');
        }


        $data = $userModel->where('username', $username)->first();
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'username'  => $data['username'],
                    'email'     => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/admin/dashboard');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Username does not exist.');
            return redirect()->to('/login');
        }

       
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }


    public function store()
    {
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];
          
        if($this->validate($rules)){
            $userModel = new UserModel();
            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $userModel->save($data);
            return redirect()->to('/register');
        }else{
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
          
    }
}

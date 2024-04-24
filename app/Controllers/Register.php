<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\UserModel;
 
class Register extends Controller
{
    public function index()
    {
        //include helper form
        helper(['form']);
        $data = [];
        echo view('ub/register', $data);
    }
 
    public function save()
    {
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'name'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];
         
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'user_name'     => $this->request->getVar('name'),
                'user_email'    => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('ub/');
        }else{
            $data['validation'] = $this->validator;
            echo view('ub/register', $data);
        }
         
    }
 

    public function gantiPassword()
    {
        
		
		//include helper form
        helper(['form']);
        //set rules validation form
        $data = [
			'title' => 'Ganti Password',
			'validation' => $this->validator ];
			
            return view('ub/changePassword', $data);
         
    }
 


 
    public function simpanPassword()
    {
        
		$id=session()->get('user_id');
		//include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
			'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];
         
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->updateUser($id,$data);
            return redirect()->to('ub/');
        }else{
            $data['validation'] = $this->validator;
			$data['title'] = 'Ganti Password';
            echo view('ub/changePassword', $data);
        }
         
    }
 
 
 
}
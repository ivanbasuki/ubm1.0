<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model{
    protected $table = 'users';
    protected $allowedFields = ['user_id','user_name','user_email','user_password','user_created_at'];


public function listUser($id = false)
    {
        if($id == false)
        {
            $builder = $this->db->table('users')->select('*');
            $query   = $builder->get();
        } else
            {
                $builder = $this->db->table('users')->select('*')->where('user_id',$id);
                $query   = $builder->get();
        
            } 
    if ($query->getNumRows() > 0) {
       foreach ($query->getResult() as $row) {
           $data[] = $row;
       }
       return $data;
    }
    return false;
    }
	
	
    

public function insertUser($data)
{
    return $this->insert($data, false);
}

public function updateUser($id,$data)
{
   $builder= $this->db->table('users')->where('user_id',$id)->update($data);
   return $builder;
}

public function deleteUser($id,$data)
{
   return $this->delete($id,$data);
}
}
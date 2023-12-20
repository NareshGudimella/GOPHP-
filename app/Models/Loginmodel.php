<?php
namespace App\Models; 
use \CodeIgniter\Model;



class Loginmodel extends Model{

    public function verfyEmail($email){
        $builder=$this->db->table("user");
        $builder->select("uniid,status,username,password");
        $builder->where("email",$email);
        $result=$builder->get();
        if(count($result->getResultArray())==1){
            return $result->getRowArray();
        }



    }
    
    public function savelogininfo($data){
        $builder=$this->db->table("login_activity");
        $builder->insert($data);
        if($this->db->affectedRows()==1)
        {
            return $this->db->insertID();
        }
        else
        {
            return false;
        }

    }
    public function updatedat($id){
        $builder = $this->db->table('user');
        $builder->where('uniid',$id);
        $builder->update(['updated_at'=>date('Y-m-d H:i:s')]);
        if($this->db->affectedRows()==1){
            return true;
        }
        else{
            return false;
        }
    }
    public function verfytoken($token)
    {
        $builder=$this->db->table("user");
        $builder->select("uniid,username,updated_at,profile_pic");
        $builder->where("uniid",$token);
        $result=$builder->get();
        if(count($result->getResultArray())==1){
            return $result->getRowArray();
        }
        else {
            return false;
        }
    }
    public function updatepassword($id,$pwd){
        $builder = $this->db->table('user');
        $builder->where('uniid',$id);
        $builder->update(['password'=>$pwd]);
        if($this->db->affectedRows()==1){
            return true;
        }
        else{
            return false;
        }
    }


}
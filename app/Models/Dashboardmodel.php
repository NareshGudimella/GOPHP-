<?php 
namespace App\Models;

use \CodeIgniter\Model;

class DashboardModel extends Model  {

public function getLoggedinuserdata($id)
    {
         
        $builder = $this->db->table('user');
        $builder->where('uniid',$id);
        $result=$builder->get();

        if(count($result->getResultArray())==1){
            return $result->getRowArray();
        }else{
        return false;
        }
    }
            public function updatelogouttime($la_id){
                $builder = $this->db->table('login_activity');
                $builder->where('id',$la_id);
                $builder->update(['logout'=>date('Y-m-d H:i:s')]);
                if($this->db->affectedRows()> 0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            public function getLoginuserinfo($id){
                $builder = $this->db->table('login_activity');
               
                $builder->where('uniid',$id);
                $builder->orderBy('id','desc');
                $builder->limit(10);
                $result=$builder->get();
                
                if(count($result->getResultArray())> 0)
                {
                        return $result->getResult();
                }
                else
                {
                    return false;
                }
                

            }
            public function updateAvatar($path,$id){

                $builder = $this->db->table('user');
                $builder->where('uniid',$id);
                $builder->update(['profile_pic'=>$path]);
                if($this->db->affectedRows()> 0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            public function verfypwd($id){
                $builder=$this->db->table("user");
                $builder->select("password");
                $builder->where("uniid",$id);
                $result=$builder->get();
                if(count($result->getResultArray())==1)
                {
                    return $result->getRowArray();
                }
                else
                {
                    return false;
                }
            }
            public function updatepassword($password,$id){

                $builder = $this->db->table('user');
                $builder->where('uniid',$id);
                $builder->update(['password'=>$password]);
                if($this->db->affectedRows()> 0){
                    return true;
            }else{
                return false;
            }
        }
        public function updateinfo($data, $id) {
            $builder = $this->db->table('user');
            $builder->where('uniid', $id);
            $builder->update($data);
                if($this->db->affectedRows()> 0){
                    return true;
            }else{
                return false;
            }

        }
        public function getpath($id){
            $builder=$this->db->table("user");
            $builder->select("profile_pic");
            $builder->where("uniid",$id);
            $result=$builder->get();
            if(count($result->getResultArray())==1)
            {
                return $result->getRowArray();
            }
            else
            {
                return false;
            }
        }

}
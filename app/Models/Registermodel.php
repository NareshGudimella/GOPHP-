<?php
 namespace App\Models;
 use CodeIgniter\Model;


 class Registermodel extends Model{
   public $db;
    public function __construct(){
        $this->db=\config\Database::connect();
    }


    public function register($data){

    $db=\config\Database::connect();
   $builder=$db->table("user");
    $res=$builder->insert($data);
    if ($res) {
                    return true;
               }
           else{
                     return false;
               }

 }
 public function verifyuniid($id){

    $builder=$this->db->table("user");
    $builder->select("activation_date, uniid,status");
    $builder->where("uniid",$id);
   if( $result=$builder->get()->getRow()){
    return $result;
   }
   else{
    return false;
   }  
 }
 public function updateStatus($id){

    $builder=$this->db->table("user");
    $builder->where("uniid",$id);
    $builder->update(['status'=>'active']);
   if( $this->db->affectedRows()==1){
    return true;
   }
   else{
    return false;
   }
 }

}
<?php
 namespace App\Models;

 use \CodeIgniter\Model;

 class Contactmodel extends Model{

    public function savedata($data){

        $db=\config\Database::connect();
        $bulider=$db->table('users');
        $res= $bulider->insert($data);
        
        if ($res) {
                        return true;
                    }
        else{
                        return false;
             }


 }
}
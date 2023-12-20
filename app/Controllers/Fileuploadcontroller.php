<?php 
namespace App\Controllers;
use codeIgniter\Controller;
use App\Models\DashboardModel;


class Fileuploadcontroller extends BaseController{
    public $dmodel;
    public function __construct(){
            helper("form");
            $this->dmodel = new DashboardModel();   
    }
    public function index()
    {

        $data=[];
        $uniid=session()->get('logged_user');
        $path= $this->dmodel->getpath("$uniid");
        $data['validation']=null;
        if($this->request->is("post"))
        {
            $rules=[
                         'avatar'=>'uploaded[avatar]|max_size[avatar,1024]|ext_in[avatar,png,jpg,gif,jpeg]',
                   ];
           if($this->validate($rules))
            {
                $file = $this->request->getFile("avatar");
                if($file->isValid() && !$file->hasMoved())
                {
                    $newname=$file->getRandomName();
                      if(  $file->move(WRITEPATH.'uploads/',$newname)){
                        echo '<p> File Uploaded Successfully </p>';
                      }
                      else{
                        echo $file->getErrorString()." ".$file->getError();
                      }

                }
        
            }else{
                $data['validation']=$this->validator;
            }

        }

        return view("upload_view",$data);
    }
}

    
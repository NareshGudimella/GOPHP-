<?php 
 namespace App\Controllers;
 
 use codeIgniter\Controller;
 use \App\Models\Contactmodel;


 class Contactcontroller extends BaseController{
    public $contactmodel;
   


    public function __construct(){
        helper("form");
        $this->contactmodel = new Contactmodel();
    }

 public function index(){
    
    $data=[];
    $data["validation"] = null;

   $session=\CodeIgniter\Config\Services::session();

     $rules=[
        'uname'=>'required|min_length[3]|max_length[20]',
        'email'=>'required|valid_email',
        'mobile'=>'required|exact_length[10]|numeric',
        'msg'=> 'required',
     ];
     if($this->request->is('post'))
        {
               if($this->validate($rules))
               {
                     $cdata=[
                           'uname'=>$this->request->getvar('uname',FILTER_SANITIZE_STRING),
                           'email'=>$this->request->getvar('email',FILTER_SANITIZE_STRING),
                           'mobile'=>$this->request->getvar('mobile',FILTER_SANITIZE_STRING),
                           'message'=>$this->request->getvar('msg',FILTER_SANITIZE_STRING),
                     ];
                 $status =$this->contactmodel->savedata($cdata);
                 if($status){
                  
                        $session->setTempdata('sucess','Thanks we will get back you soon',3);
                       
                        return redirect()->to(current_url());
                 }
                 else{
                  $session->setTempdata('error','Sorry! try again',3);
                  return redirect()->to(current_url());
                 }
               }
               else {
            $data['validation'] = $this->validator;
               }
               return view('contact',$data);
        }

        
        
        echo  view("contact",$data);
    }
}

                      
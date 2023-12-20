<?php

namespace App\Controllers;
use codeIgniter\Controller;
use App\Models\DashboardModel;


class Dashboard extends BaseController{
     public $dmodel;
    public function __construct(){
        helper("form");
        $this->dmodel = new DashboardModel();

    }

    public function index(){
      
       $uniid=session()->get('logged_user');
       
      $data['userdata']=$this->dmodel->getLoggedinuserdata($uniid);
       
      
        return view('dashboard_view', $data);
    }
    public function logout(){
         if(session()->has('logged_info')){
            $la_id=session()->get('logged_info');
            $this->dmodel->updatelogouttime($la_id);
         }
    session()->remove('logged_user');
    session()->destroy(); 
    return redirect()->to(base_url().'login');
    }
    public function Login_activity(){
         $uniid=session()->get('logged_user');
         $data['userdata']=$this->dmodel->getLoggedinuserdata( $uniid );
        $data['login_info']=$this->dmodel->getLoginuserinfo($uniid);
        return view('login_activity_view',$data);

    }
    public function upload_avatar(){
        $data=[];
        $uniid=session()->get('logged_user');
        $data['userdata']=$this->dmodel->getLoggedinuserdata($uniid);
        $data['validation']=null;

        if($this->request->is('post')){
           
            $rules=[
                         'avatar'=>'uploaded[avatar]|max_size[avatar,1024]|ext_in[avatar,png,jpg,gif,jpeg]',
                   ];
  if($this->validate($rules))
   {
            $file=$this->request->getFile('avatar');
            if($file->isValid()&& !$file->hasMoved()){
               if( $file->move(WRITEPATH.'uploads\public',$file->getRandomName()))
               {
               
                    $path= '/uploads/public/'.$file->getName();
                   $status= $this->dmodel->updateAvatar($path,$uniid);
                   if($status){
                        session()->setTempdata('success','Avtar is uploaded successfully',3);
                        return redirect()->to(current_url());
                   }else{
                    session()->setTempdata('error','Sorry Unable to Upload Avatar',3);
                    return redirect()->to(current_url());
                   }
               }else
               {
                session()->setTempdata('error',$file->getErrorString(),3);
                return redirect()->to(current_url());
               }
            }else
            {
                session()->setTempdata('error','U Have uploded Invalid File',3);
                return redirect()->to(current_url());
            }
        }else{
            $data['validation']=$this->validator;
        }

        }
        return view('avatar_view',$data);
    }

    public function change_pwd(){
        $data=[];
        $uniid=session()->get('logged_user');
        $data['userdata']=$this->dmodel->getLoggedinuserdata($uniid);
        if($this->request->is('post')){
            $rules=[
                'opwd'=>'required',
                'npwd'=> 'required|min_length[6]|max_length[16]',
                'cnpwd'=> 'required|matches[npwd]' 
                    ];
             if($this->validate($rules))
             {
               $opwd= $this->request->getVar('opwd');
               $npwd= password_hash($this->request->getVar('npwd'),PASSWORD_DEFAULT);
               $userdata=$this->dmodel->verfypwd($uniid);
               if (password_verify($opwd, $userdata['password'])) {
                               $status= $this->dmodel->updatepassword($npwd,$uniid) ;
                               if($status){
                                    session()->setTempdata('success','password Updated',3);
                                    return redirect()->to(base_url('dashboard'));
                               }else{
                                session()->setTempdata('error','Sorry! Unable to Update your password ,try again',3);
                                return redirect()->to(current_url());
                               }

                        }else{
                            session()->setTempdata('error','Old password doesnot match with db',3);
                        }
             }   
             else{
                $data['validation']=$this->validator;
             }    

        }
        return view('change_pwd',$data);
    }
    public  function edit(){
        $data=[];
        $data['validation']=null;
        $uniid=session()->get('logged_user');
        $data['userdata']=$this->dmodel->getLoggedinuserdata($uniid);
        if($this->request->is('post'))
        {
            $rules=
                [
                        'username'=> 'required|min_length[4]|max_length[14]',
                        'mobile'=> 'required|exact_length[10]|numeric',

                ];
            if($this->validate($rules))
            {
                $userdata=[
                    'username'=>$this->request->getVar('username'), 
                    'mobile'=>$this->request->getVar('mobile'),
                         ];
                $status=  $this->dmodel->updateinfo($userdata,$uniid);
                        if($status)
                        {
                            session()->setTempdata('success','Profile Updated..',3);
                            return redirect()->to(base_url('dashboard'));
                        }
                        else
                        {
                            session()->setTempdata('error','Sorry! Unable to Update your profile ,try again',3);
                            return redirect()->to(current_url());
                        }
                
            }
            else
            {
                 $data['validation']=$this->validator;
            }
        }

        
        return view('edit_view',$data);
    }
}
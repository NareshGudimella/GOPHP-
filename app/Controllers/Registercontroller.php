<?php

namespace App\Controllers;

use App\Models\Registermodel;
use codeIgniter\Controller;


class Registercontroller extends BaseController
{
    public $email;
    public $register;
    public $session;
    public function __construct()
    {
        helper("form");
        helper("date");
        $this->register = new Registermodel();
        $this->session = \config\Services::session();
        $this->email = \config\Services::email();
    }

    public function index()
    {

        $data = [];
        $data['validation'] = null;
        $rules = [
            'username' => 'required|min_length[4]|max_length[20]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'pwd' => 'required|min_length[6]|max_length[16]',
            'cpwd' => 'required|matches[pwd]',
            'mobile' => 'required|exact_length[10]|numeric',
        ];


        if ($this->request->is('post')) {
            if ($this->validate($rules)) {
                $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
                $cdata = [
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('pwd'), PASSWORD_DEFAULT),
                    'mobile' => $this->request->getVar('mobile'),
                    'uniid' => $uniid,
                    'activation_date' => date('Y-m-d H:i:s'),

                ];
                $status = $this->register->register($cdata);
                if ($status) {


                    $to = $this->request->getVar('email');
                    $subject = "Acount Activation Link ";
                    $message = "hi " . $this->request->getVar('username')  . "<br><br>.Thanks Ur Account was created successfully"
                        . " plese click the below link to activate your account <br><br>"
                        . "<a href='" . base_url() . "register/activate/" . $uniid . "'>Activate now </a> THANKS <br> NareshGudimella";


                    $this->email->setTo($to);
                    $this->email->setSubject($subject);
                    $this->email->setMessage($message);
                    $this->email->setFrom('user@ci4', 'Naresh');

                    if ($this->email->send()) {
                        $this->session->setTempdata('sucess', 'Account Craeated Successfully .Plese Activate your Account', 3);
                        return redirect()->to(current_url());
                    } else {
                        $dddata = $this->email->printDebugger(["headers"]);
                        print_r($dddata);
                        // $this->session->setTempdata('error','Sorry! unable to send Activation Link',3);
                    }
                } else {
                    $this->session->setTempdata('error', 'Sorry! unable to Create an account , Try again', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }



        return  view("Registeration", $data);
    }
    public function activate($uniid = null)
    {

        $data = [];
        if (!empty($uniid)) {

            $userdata = $this->register->verifyuniid($uniid);
            if ($userdata) {
                if ($this->verifyExpireTime($userdata->activation_date)) {
                    if ($userdata->status == 'inactive') {
                        $status = $this->register->updateStatus($uniid);
                        if ($status == true) {
                            $data['sucess'] = 'Account Activited Succefully';
                        }
                    } else {
                        $data['sucess'] = 'Your account is activated';
                    }
                } else {
                    $data['error'] = 'Sorry! Activation link was experied ';
                }
            } else {
                $data['error'] = 'Sorry! We are Unable to Find your Account';
            }
        } else {

            $data["error"] = 'Sorry! Unable to process ur request ';
        }


        return view("Activate_view", $data);
    }

    public function verifyExpireTime($regTime)
    {
        $currTime = now();
        $regTime = strtotime($regTime);
        $diffTime = $currTime - $regTime;
        if (3600 > $diffTime) {
            return true;
        } else {
            return false;
        }
    }
}

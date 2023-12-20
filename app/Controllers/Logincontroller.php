<?php

namespace App\Controllers;

use App\Models\Loginmodel;
use CodeIgniter\Controller;


class Logincontroller extends BaseController
{
  public $loginmodel;
  public $email;
  public $session;
  public function __construct()
  {

    $this->loginmodel = new Loginmodel();
    $this->session = session();
    helper("form");
    $this->email = \config\Services::email();
  }
  public function index()
  {
    $data = [];


    if ($this->request->is("post")) {
      $rules = [
        'email' => 'required|valid_email|',
        'pwd' => 'required|min_length[6]|max_length[16]',
      ];
      if ($this->validate($rules)) {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pwd');
        $throttler = \config\Services::throttler();
        $allow = $throttler->check('login', 4, MINUTE);
        if ($allow) {
          $userdata = $this->loginmodel->verfyEmail($email);
          if ($userdata) {
            if (password_verify($password, $userdata['password'])) {
              if ($userdata['status'] == 'active') {
                $logininfo = [
                  'uniid' => $userdata['uniid'],
                  'agent' => $this->getuseragentinfo(),
                  'ip' => $this->request->getIPAddress(),
                  'login' => date('y-m-d h:i:s')

                ];
                $la_id = $this->loginmodel->savelogininfo($logininfo);
                if ($la_id) {
                  echo $la_id;
                  $this->session->set('logged_info', $la_id);
                } else {
                  echo 'noid';
                }

                $this->session->set('logged_user', $userdata['uniid']);
                return redirect()->to(base_url() . 'dashboard');
              } else {
                $data['error'] = 'Please Activate you account . contact Admin';
                // $this->session->setTempdata('error','Please Activate you account . contact Admin',3);
                // return redirect()->to(current_url());

              }
            } else {
              $data['error'] = 'Sorry! U Entered Wrong Password';
              // $this->session->setTempdata('error','Sorry! U Entered Wrong Password',3);
              // return redirect()->to(current_url());

            }
          } else {
            $data['error'] = 'Sorry! Email does not Exists';
            // $this ->session->setTempdata('error','Sorry! Email does not Exists ',3);
            // return redirect()->to(current_url());
          }
        } else {
          $data['error'] = 'Max no of Attempts done .please try again';
        }
      } else {
        $data['validation'] = $this->validator;
      }
    }
    return view("login", $data);
  }

  public function getuseragentinfo()
  {
    $agent = $this->request->getUserAgent();
    if ($agent->isBrowser()) {
      $currentAgent = $agent->getBrowser();
    } elseif ($agent->isRobot()) {
      $currentAgent = $this->$agent->robot();
    } elseif ($agent->isMobile()) {
      $currentAgent = $agent->getMobile();
    } else {
      $currentAgent = 'unidentifed User Agent';
    }
    return $currentAgent;
  }
  public function forgot_password()
  {
    $data = [];
    if ($this->request->is('post')) {
      $rules = [
        'email' => [
          'label' => 'Email',
          'rules' => 'required|valid_email',
          'error' => [
            'required' => '(field) field required',
            'valid_email' => 'valid (field) required'
          ]
        ],
      ];
      if ($this->validate($rules)) {
        $email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
        $userdata = $this->loginmodel->verfyEmail($email);
        if ($userdata) {
          $status = $this->loginmodel->updatedat($userdata['uniid']);
          if ($status) {
            $to = $email;
            $subject = 'Reset Password Link ';
            $token = $userdata['uniid'];
            $message = 'Hi ' . $userdata['username'] . '<br><br>'
              . ' your Reset password request hsa been recived, Please click'
              . ' the below link to reset your password. <br><br>'
              . '  <a href="' . base_url() . '/login/reset_password/' . $token . '">Click here to Reset Password</a>'
              . '  Thanks<br>';
            $this->email->setTo($to);
            $this->email->setSubject($subject);
            $this->email->setMessage($message);
            $this->email->setFrom('user@ci4', 'Naresh');

            if ($this->email->send()) {
              $this->session->setTempdata('success', 'Reset password link sent to your register email please verfiy with in 15min', 3);
              return redirect()->to(current_url());
            } else {
              $dddata = $this->email->printDebugger(["headers"]);
              print_r($dddata);
              // $this->session->setTempdata('error','Sorry! unable to send Activation Link',3);
            }
          } else {
            $this->session->setTempdata('error', 'Sorry!.... SomeThing Went Wrong plese try again..  ', 3);
            return redirect()->to(current_url());
          }
        } else {
          $this->session->setTempdata('error', 'Sorry! Email does not Exists ', 3);
          return redirect()->to(current_url());
        }
      } else {
        $data['validation'] = $this->validator;
      }
    }
    return view('forgot_view', $data);
  }

  public function reset_passsword($token = null)
  {
    $data = [];
    if (!empty($token)) {
      $userdata = $this->loginmodel->verfytoken($token);
      if (!empty($userdata)) {
        $status = $this->checkexpiredate($userdata['updated_at']);
        if ($status) {
          if ($this->request->is('post')) {
            $rules = [
              'npwd' => 'required|min_length[6]|max_length[16]',
              'cnpwd' => 'required|matches[npwd]'
            ];
            if ($this->validate($rules)) {
              $npwd = password_hash($this->request->getVar('npwd'), PASSWORD_DEFAULT);
              if ($this->loginmodel->updatepassword($token, $npwd)) {
                session()->setTempdata('success', 'Password Updated Sucessfully ,Please login ', 3);
                return redirect()->to(base_url('login'));
              } else {
                session()->setTempdata('error', 'Sorry!! Unable to Update,Please try again ', 3);
                return redirect()->to(current_url());
              }
            } else {
              $data['validation'] = $this->validator;
            }
          }
        } else {
          $data['error'] = 'Reset password link was expired.';
        }
      } else {
        $data['error'] = 'unable to find user account ';
      }
    } else {

      $data["error"] = 'Sorry! Unauthourized access ';
    }
    return  view("reset_password_view", $data);
  }

  public function checkexpiredate($date)
  {
    $update_time = strtotime($date);
    $current_time = time();
    $timediff = $current_time - $update_time;
    if ($timediff < 900) {
      return true;
    } else {
      return false;
    }
  }
}

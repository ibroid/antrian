<?php

defined("BASEPATH") or die("Kuya Batok");

class Auth extends CI_Controller
{
  public  Eloquent $eloquent;
  public function __construct()
  {
    parent::__construct();
    $this->load->library("Addons");
  }

  public function index()
  {
    if (!empty($this->session->userdata('user_login'))) {

      redirect(base_url('menu'));
    }
    $this->load->page("public/login")->layout('auth_layout');
  }

  public function login()
  {
    if (!empty($this->session->userdata('user_login'))) {

      redirect(base_url('menu'));
    }
    try {
      $u = $this->mathcIdentifier();
      $this->matchPassword($u->password, $u->salt);

      $this->storeSession($u->toArray());

      redirect(base_url("/menu"));
    } catch (\Throwable $th) {

      $this->session->set_flashdata('flash_error', $this->load->component(Constanta::ALERT_ERROR, [
        'message' => $th->getMessage()
      ]));

      redirect(base_url("/auth"));
    }
  }

  private function matchPassword($password, $salt)
  {
    if (!password_verify(R_Input::pos('login')['password'] . $salt, $password)) {
      throw new Exception("Password tidak sama", 1);
    }
  }

  private function mathcIdentifier()
  {
    $u = Users::with("role")->where('identifier', R_Input::pos('login')['identifier'])->first();
    if (!$u) {
      throw new Exception("User tidak ditemukan", 1);
    }
    return $u;
  }

  private function storeSession(array $data)
  {
    $this->session->set_userdata(['user_login' => $data]);
  }

  public function logout()
  {
    R_Input::mustPost();
    $this->destroySession();
    redirect(base_url());
  }

  private function destroySession()
  {
    $this->session->sess_destroy();
  }
}

<?php

defined("BASEPATH") or die("Kuya Batok");

class Auth extends CI_Controller
{
  public Eloquent $eloquent;
  /**
   * Constructor function for the class.
   *
   * This function is called when an object of the class is created.
   * It initializes the parent constructor and loads the "Addons" library.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->library("Addons");
  }

  /**
   * Index function for the Auth controller.
   *
   * This function checks if the user is already logged in and redirects them to the menu page if they are.
   * If the user is not logged in, it loads the login page with the 'auth_layout' layout.
   * Url : /auth. method : GET
   * @return page
   */
  public function index()
  {
    if (!empty($this->session->userdata('user_login'))) {

      redirect(base_url('menu'));
    }
    $this->load->page("public/login")->layout('auth_layout');
  }

  /**
   * Function to handle user login process.
   * Url : /auth/login. method : POST.
   * @throws \Throwable If an error occurs during the login process.
   * @return void
   */
  public function login()
  {
    R_Input::mustPost();
    if (!empty($this->session->userdata('user_login'))) {

      redirect(base_url('menu'));
    }
    try {
      $u = $this->mathcIdentifier();
      $this->matchPassword($u->password, $u->salt);

      $this->storeSession($u->toArray());
      if ($this->session->userdata("redirect_dest")) {

        redirect(base_url($this->session->userdata("redirect_dest")));
      } else {

        $this->redirectByRoleId($u);
      }
    } catch (\Throwable $th) {

      $this->session->set_flashdata('flash_error', $this->load->component(Constanta::ALERT_ERROR, [
        'message' => $th->getMessage()
      ]));

      redirect(base_url("/auth"));
    }
  }

  /**
   * Redirects the user based on their role ID.
   * @param object $user The user object containing the petugas property.
   * @return void
   */
  private function redirectByRoleId($user)
  {

    if (!$user->petugas) {
      return redirect("/menu");
    }

    switch ($user->petugas->jenis_petugas) {
      case "Petugas PTSP":
        redirect("/pelayanan");
        break;

      case "Petugas Sidang":
        redirect("/persidangan");
        break;

      case "Petugas Produk":
        redirect("/produk");
        break;

      case "Petugas Posbakum":
        redirect("/pelayanan");
        break;

      case "Kasir":
        redirect("/kasir");
        break;

      default:
        redirect("/menu");
        break;
    }
  }

  /**
   * Check if the provided password matches the stored hashed password.
   * @param string $password The plaintext password to verify.
   * @param string $salt The salt used to hash the password.
   * @throws Exception If the password does not match.
   * @return void
   */
  private function matchPassword($password, $salt)
  {
    if (!password_verify(R_Input::pos('login')['password'] . $salt, $password)) {
      throw new Exception("Password tidak sama", 1);
    }
  }

  /**
   * Retrieves a user from the database based on the provided identifier and role.
   *
   * @throws Exception If the user is not found.
   * @return Users The user object with the specified identifier and role.
   */
  private function mathcIdentifier()
  {
    $u = Users::with("role", "petugas")->where('identifier', R_Input::pos('login')['identifier'])->first();
    if (!$u) {
      throw new Exception("User tidak ditemukan", 1);
    }
    return $u;
  }

  /**
   * Store the given data in the user session under the key 'user_login'.
   *
   * @param array $data The data to be stored in the session.
   * @return void
   */
  private function storeSession(array $data)
  {
    $this->session->set_userdata(['user_login' => $data]);
  }

  /**
   * Logs out the user by destroying the session and redirecting to the base URL.
   * Url : /auth/logout. method : POST
   * @throws None
   * @return void
   */
  public function logout()
  {
    R_Input::mustPost();
    $this->destroySession();
    redirect(base_url());
  }

  /**
   * Destroys the session and redirects to the base URL.
   * @return void
   */
  private function destroySession()
  {
    $this->session->sess_destroy();
  }
}

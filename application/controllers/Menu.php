<?php


class Menu extends R_Controller
{
  public Addons $addons;
  public function __construct()
  {
    parent::__construct();
    $this->load->library("addons");
  }
  public function index()
  {
    $base_url = base_url();
    $this->addons->init([
      "js" => [
        "<script src='$base_url/assets/js/swiper/swiper-bundle.min.js'></script>\n"
      ],
      "css" => [
        "<link rel='stylesheet' type='text/css' href='../assets/css/vendors/swiper/swiper-bundle.min.css'>\n
        <link rel='stylesheet' type='text/css' href='../assets/css/vendors/swiper/swiper.min.css'>\n"
      ]
    ]);
    $this->load->page("menu")->layout("auth_layout");
  }
}

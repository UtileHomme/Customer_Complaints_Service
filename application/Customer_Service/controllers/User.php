<?php
class User extends MY_Controller
{
    //this will be the default function to be loaded when user controller is accessed
    public function index()
    {
        //load the view of the main page
        $this->load->view('public/main_page.php');
    }
}
?>

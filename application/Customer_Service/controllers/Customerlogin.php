<?php
class Customerlogin extends MY_Controller
{
    public function index()
    {
        //if the user is logged in and user tries to access login page by typing its url
        //then first check this logic and then redirect
        if($this->session->userdata('c_user_id'))
        {
            return redirect('customercomplaintsdashboard');
        }
        $this->load->view('public/customer_login');
    }

    //for validating and logging the user
    public function customer_login()
    {
        //how to format the errors being displayed
        $this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");

        //if validation passes
        if($this->form_validation->run('customer_login'))
        {
            //how to take the post data from fields
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->load->model('loginmodel');

            // we are retrieving the id of the user who is logged in
            $login_id = $this->loginmodel->customer_login_valid($username,$password);
            if($login_id)
            {
                $this->load->library('session');

                //set the session for this particular user
                $this->session->set_userdata('c_user_id', $login_id);

                // redirect to customer controller with complaints dashboard function
                return redirect('customercomplaintsdashboard/customer_complaints');
            }
            else
            {
                $this->session->set_flashdata('login_failed','Invalid Username/Password Combination');
                return redirect('customerlogin');
            }
        }
        else
        {
            // if the validation fails, then load the login page again
            $this->load->view('public/customer_login');
        }
    }

    //logout function when logout button is clicked on any page
    public function logout()
    {
        $this->session->unset_userdata('c_user_id');
        return redirect('customerlogin');
    }
}
?>

<?php
class Assistantlogin extends MY_Controller
{
    public function index()
    {
        //if the user is logged in and user tries to access login page by typing its url
        //then first check this logic and then redirect
        if($this->session->userdata('a_user_id'))
        {
            //if logged in , redirect and display the assistant dashboard
            return redirect('assistantcomplaintsdashboard');
        }
        $this->load->view('public/assistant_login');
    }

    //for validating and logging the user
    public function assistant_login()
    {
        //how to format the errors being displayed
        $this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");

        //if validation passes based on the form_validations set in /config/form_validation.php
        if($this->form_validation->run('assistant_login'))
        {
            //how to take the post data from fields
            $uname = $this->input->post('username');
            $pword = $this->input->post('password');

            $this->load->model('loginmodel');

            // we are retrieving the id of the user who is logged in
            $login_id = $this->loginmodel->assistant_login_valid($uname,$pword);

            //if the login_id value is true or a non-zero value
            if($login_id)
            {
                $this->load->library('session');

                //set the session for this particular user
                $this->session->set_userdata('a_user_id', $login_id);

                // redirect to assistant complaint dashboard controller with assistant complaints function
                return redirect('assistantcomplaintsdashboard/assistant_complaints');
            }
            else
            {
                //if the login_id value is false which means the username/password combination wasn't correct
                $this->session->set_flashdata('login_failed','Invalid Username/Password Combination');
                return redirect('assistantlogin');
            }
        }
        else
        {
            // if the validation fails, then load the login page again
            $this->load->view('public/assistant_login');
        }
    }

    public function logout()
    {
        //unset the previously set session data
        $this->session->unset_userdata('a_user_id');
        return redirect('assistantlogin');
    }
}
?>

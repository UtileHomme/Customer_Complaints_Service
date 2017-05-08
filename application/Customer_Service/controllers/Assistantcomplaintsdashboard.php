<?php
class Assistantcomplaintsdashboard extends MY_Controller
{
    //this function will act as a default function if no function is mentioned after the controller
    public function index()
    {
        $this->load->view('admin/assistant_complaints_dashboard');
    }

    //this function helps show the list of all the complaints registered till date in a tabular form with all details
    public function assistant_complaints()
    {
        //load the db model
        $this->load->model('assistantmodel','assistant');

        //store the result of the database query in the form of an array of objects
        $complaints = $this->assistant->a_complaints_list();

        //load the view page and send the above array of objects as the second argument
        $this->load->view('admin/assistant_complaints_dashboard',['complaints'=>$complaints]);
    }

    //the parameter passed here is the id of the complaint which is to be edited
    public function edit_status($complaint_id)
    {
        $this->load->model('assistantmodel','assistant');

        $complaints = $this->assistant->find_complaint($complaint_id);

        //pass the received table data into view so that it can be accessed there
        $this->load->view('admin/edit_complaint',['complaints'=>$complaints]);
    }

    public function update_status($complaint_id)
    {
        //define the validation rules for the complaint body text area
        $this->form_validation->set_rules('complaint_body', 'Complaint Body', 'required');

        //if the validation is done
        if($this->form_validation->run())
        {
            //store the data after clicking submit button inside a variable
            $post = $this->input->post();

            //since submit button is also getting sent in the array, remove it since we don't want it to be updated
            // in the table
            unset($post['submit']);

            $this->load->model('assistantmodel','assistant');

            //this post data is sent as an array into the model for updation
            if($this->assistant->update_status($complaint_id,$post))
            {
                //if successful, display this message
                $this->session->set_flashdata('feedback','Great!! The Complaint Status has been Changed');
                $this->session->set_flashdata('feedback_class', 'alert-success');
            }
            else
            {
                //if unsuccessful, display this message
                $this->session->set_flashdata('feedback','The Complaint Status Failed to Change, Please try again');
                $this->session->set_flashdata('feedback_class', 'alert-danger');
            }

            //redirect to the controller and function along with suitable messages
            return redirect('assistantcomplaintsdashboard/assistant_complaints');
        }
        else
        {
            //if the validation fails, load the edit complaint view again
            $this->load->view('admin/edit_complaint');
        }
    }

    //this function helps the assistant filter complaints on the basis of department and status of complaint
    public function search()
    {
        $this->form_validation->set_rules('query', 'Query', 'required|alpha');

        if($this->form_validation->run())
        {
            $query = $this->input->post('query');

            $this->load->model('assistantmodel','assistant');
            $searchcomplaints = $this->assistant->search($query);

            $this->load->view('admin/search_assistant_dashboard',['searchcomplaints'=>$searchcomplaints]);
        }
        else
        {
            //if validation fails call the second controller function
            $this->assistant_complaints();
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        //if the user is not logged in, redirect to login page
        if(!$this->session->userdata('a_user_id'))
        {

            return redirect('assistantlogin');
        }
    }
}
?>

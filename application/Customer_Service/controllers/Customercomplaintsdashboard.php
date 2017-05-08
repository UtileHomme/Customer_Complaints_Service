<?php
class Customercomplaintsdashboard extends MY_Controller
{
    //this function will act as a default function if not function is mentioned after the controller
    public function index()
    {
        $this->load->view('admin/customer_complaints_dashboard');
    }

    //this function helps show the list of all users complaints registered till date in a tabular form with all details
    public function customer_complaints()
    {
        //load the db model
        $this->load->model('customermodel','customer');

        //store the result of the database query in the form of an array of objects
        $complaints = $this->customer->complaints_list();

        //load the view page and send the above array of objects as the second argument
        $this->load->view('admin/customer_complaints_dashboard',['complaints'=>$complaints]);
    }

    //this function helps load the add complaint view
    public function add_complaint()
    {
        $this->load->view('admin/add_complaint');
    }

    //this function helps add the complaint
    public function store_complaint()
    {
        //define the validation rules for the complaint body text area
        $this->form_validation->set_rules('complaint_body', 'Complaint Body', 'required');

        //if the validation is done
        if($this->form_validation->run())
        {
            //store the data after clicking submit button inside a variable
            $post = $this->input->post();

            //since submit button is also getting sent in the array, remove it
            unset($post['submit']);

            $this->load->model('customermodel','customer');

            //this post data is sent as an array into the model for updation
            if($this->customer->add_complaint($post))
            {
                //if successful, display this message
                $this->session->set_flashdata('feedback','Great!! Your Complaint has been Registered');
                $this->session->set_flashdata('feedback_class', 'alert-success');
            }
            else
            {
                //if unsuccessful, display this message
                $this->session->set_flashdata('feedback','Your Complaint Failed to Register, Please try again');
                $this->session->set_flashdata('feedback_class', 'alert-danger');
            }

            //redirect to the controller and function along with suitable messages
            return redirect('customercomplaintsdashboard/customer_complaints');
        }
        else
        {
            //if the validation fails, load the add complaint view again
            $this->load->view('admin/add_complaint');
        }
    }

    //this function helps the customer filter complaints on the basis of department and status of complaint
    public function search()
    {
        $this->form_validation->set_rules('query', 'Query', 'required|alpha');

        if($this->form_validation->run())
        {
            $query = $this->input->post('query');

            $this->load->model('customermodel','customer');
            $searchcomplaints = $this->customer->search($query);

            $this->load->view('admin/search_customer_dashboard',['searchcomplaints'=>$searchcomplaints]);
        }
        else
        {
            //if validation fails call the second controller function
            $this->customer_complaints();
        }
    }

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');

        //if the user is not logged in, redirect to login page
        if(!$this->session->userdata('c_user_id'))
        {

            return redirect('customerlogin');
        }
    }
}
 ?>

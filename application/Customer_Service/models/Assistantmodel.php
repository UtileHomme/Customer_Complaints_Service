<?php
class Assistantmodel extends CI_Model
{
    //this function retrieves all the complaints for the assistant to view
    public function a_complaints_list()
    {
        $query = $this->db
        ->select(['complaint_id', 'complaint_body','dept','status'])
        ->from('complaints')
        ->get();

        //result is returned as an array of objects
        return $query->result();
    }

    //this will help in finding the complaint whose status is to be edited corresponding to the complaint_id
    public function find_complaint($complaint_id)
    {
        $q = $this->db->select(['complaint_id','complaint_body','dept','status'])
        ->where('complaint_id', $complaint_id)
        ->from('complaints')
        ->get();

        //here we are only fetching one row from the table so only one object is required and not an array of objects
        return $q->row();
    }

    //this will help update the status of the complaint on the basis of complaint id and the post data
    public function update_status($complaint_id, $complaint)
    {
        return $this->db->update('complaints', $complaint, "complaint_id=$complaint_id");
    }

    //this will help search all the complaints corresponding to department and status
    public function search($query)
    {
        $c_user_id = $this->session->userdata('c_user_id');

        $q = $this->db
        ->select(['complaint_id', 'complaint_body','dept','status'])
        ->from('complaints')
        ->or_like(['dept'=>$query,'status'=>$query])
        ->get();

        return $q->result();
    }
}
?>

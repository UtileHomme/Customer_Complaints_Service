<?php
class Customermodel extends CI_Model
{
    //this function retrieves all the complaints corresponding to the logged in customer
    public function complaints_list()
    {
        $c_user_id = $this->session->userdata('c_user_id');

        $query = $this->db
        ->select(['complaint_id', 'complaint_body','dept','status'])
        ->from('complaints')
        ->where('user_id',$c_user_id)
        ->order_by('complaint_id','desc')
        ->get();

        //result is returned as an array of objects
        return $query->result();
    }

    //this will help add the complaint into the database with default status open
    public function add_complaint($array)
    {
        //update the array sent as post data with the default as open
        $array['status']='open';
        return $this->db->insert('complaints',$array);
    }

    //this will search the complaints on the basis of department or status and the logged in userid
    public function search($query)
    {
        $c_user_id = $this->session->userdata('c_user_id');

        $this->db->select(['complaint_id', 'complaint_body','dept','status']);
        $this->db->where('user_id',$c_user_id);
        $this->db->group_start();
        $this->db->or_like(['dept'=>$query,'status'=>$query]);
        $this->db->group_end();
        $q = $this->db->get('complaints');
        return $q->result();
    }
}
?>

<?php
class Loginmodel extends CI_Model
{
    //validate the customer from database on the basis of username and password
    public function customer_login_valid($username, $password)
    {
        $password = sha1($password);
        //load the database
        $q = $this->db
        ->where(['username'=>$username,'password'=>$password])
        ->get('customers');

        //if at least 1 row is returned simply send the id of that row for validation else return false
        if($q->num_rows()>=1)
        {
            return $q->row()->id;
        }
        else
        {
            return false;
        }
    }

    //validate the customer from database on the basis of username and password
    public function assistant_login_valid($uname, $pword)
    {
        $pword = sha1($pword);
        //load the database
        $q = $this->db
        ->where(['uname'=>$uname,'pword'=>$pword])
        ->get('assistant');

        //if at least 1 row is returned simply send the id of that row for validation else return false
        if($q->num_rows()>=1)
        {
            return $q->row()->id;
        }
        else
        {
            return false;
        }
    }
}
?>

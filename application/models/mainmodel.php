<?php
class mainmodel extends CI_model
{
	public function encpswd($pass)
	{
		return password_hash($pass, PASSWORD_BCRYPT);
	}
	public function inreg($a,$b)
	{
		$this->db->insert("login",$b);
		$loginid=$this->db->insert_id();
		$a['loginid']=$loginid;
	   $this->db->insert("reg",$a);
	}
	
public function view()
	{
		$this->db->select('*');       
		$this->db->join('login','login.id=reg.loginid','inner');
		$qry=$this->db->get("reg");
        return $qry;
	}
	public function approve($id)
	{   $this->db->set('status','1');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("login");
		return $qry;
	}
	public function reject($id)
	{   $this->db->set('status','2');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("login");
		return $qry;
	}
   public function select($email,$pass)
	{
		$this->db->select('password');
		$this->db->from("login");
		$this->db->where("email",$email);
		$qry=$this->db->get()->row('password');
		return $this->verifypass($pass,$qry);
	}
	public function verifypass($pass)
	   {
         return password_hash($pass, PASSWORD_BCRYPT);
          
        }
	public function getuserid($email)
	{
		$this->db->select('id');
		$this->db->from("login");
		$this->db->where("email",$email);
		return $this->db->get()->row('id');
	}
	public function getuser($id)
	{
		$this->db->select('*');
		$this->db->from("login");
		$this->db->where("id",$id);
		return $this->db->get()->row();
	}
	
	//update user details
	public function update($id)
	{
		$this->db->select("*");
		$qry=$this->db->join('login','reg.loginid=login.id','inner');
		$qry=$this->db->where("reg.loginid",$id);
		$qry=$this->db->get("reg");
		 return $qry;
	}
	public function updatesdetails($a,$b,$id)
	{
	 	$this->db->select('*');
	 	$qry=$this->db->where("loginid",$id);
	 	$qry=$this->db->join('login','login.id=reg.loginid','inner');
	 	$qry=$this->db->update("reg",$a);
	 	$qry=$this->db->where("id",$id);
	 	$qry=$this->db->update("login",$b);
	 	return $qry;
	 }
	
	//Delete Details
	public function deletedetails($id)
	{
		$this->db->where('id',$id);
		$this->db->delete("reg");
	}	
      function is_email_available($email)  
      {  
           $this->db->where('email', $email);  
           $query = $this->db->get("registration");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }  
      public function is_phno_available($phno)  
      {  
           $this->db->where('phno', $phno);  
           $query = $this->db->get("registration");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }
      public function is_uname_available($uname)
       {  
           $this->db->where('uname', $uname);  
           $query = $this->db->get("registration");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }


}
?>
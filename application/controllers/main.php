<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    /*

* Super Class
 *
 * @package Package Name
 * @subpackage  Subpackage
 * @category    Category
 * @author  Radhika L
 * @link    http:'http://localhost/codeigniterz/'
     
    */


    //User Registration
    public function register()
    {
        $this->load->view('newreg');
    }

	public function reg()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("fname","fname",'required');
        $this->form_validation->set_rules("lname","lname",'required');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("number","number",'required');
        $this->form_validation->set_rules("dob","dob",'required');
        $this->form_validation->set_rules("addr","addr",'required');
        $this->form_validation->set_rules("dis","dis",'required');
        $this->form_validation->set_rules("pin","pin",'required');
        $this->form_validation->set_rules("uname","uname",'required');
        $this->form_validation->set_rules("password","password",'required');
        if($this->form_validation->run())
        {
        $this->load->model('mainmodel');
        $pass=$this->input->post("password");
        $encpass=$this->mainmodel->encpswd($pass);
        $a=array("fname"=>$this->input->post("fname"),
                "lname"=>$this->input->post("lname"),
                "email"=>$this->input->post("email"),
                "number"=>$this->input->post("number"),
                "dob"=>$this->input->post("dob"),
                "addr"=>$this->input->post("addr"),
                "dis"=>$this->input->post("dis"),
                "pin"=>$this->input->post("pin"),
                 "uname"=>$this->input->post("uname"),
                 "password"=>$this->input->post("password"));
       $b=array("email"=>$this->input->post("email"),
                  "number"=>$this->input->post("number"),
                  "uname"=>$this->input->post("uname"),
                "password"=>$encpass,
                "usertype"=>'1');
        $this->mainmodel->inreg($a,$b);    
        redirect(base_url().'main/loginform'); 
        }
    }    

     // Login 
   public function loginform()
    {
        $this->load->view('logform');
    }
     public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("email","email",'required');
        $this->form_validation->set_rules("password","password",'required');
            if($this->form_validation->run())
                {
                $this->load->model('mainmodel');
                $email=$this->input->post("email");
                $pass=$this->input->post("password");
                $rslt=$this->mainmodel->select($email,$pass);
                if($rslt)
                {
                    $id=$this->mainmodel->getuserid($email);
                    $user=$this->mainmodel->getuser($id);
                 $this->load->library(array('session'));
                $this->session->set_userdata(array('id'=>(int)$user->id,'status'=>$user->status,'usertype'=>$user->usertype));
                    if($_SESSION['status']=='1'&& $_SESSION['usertype']=='0' )
                    {
                                redirect(base_url().'main/view');
                    }
                    elseif($_SESSION['status']=='1'&& $_SESSION['usertype']=='1' )
                    {
                                redirect(base_url().'main/user_dashboard');
                    }
                    else
                    {
                        echo "waiting for approval";
                    }
                }
                else
                {
                 echo "invalid user";
                }
            }
else{
    redirect('main/logform','refresh');
    }
}

     // View User Details
     public function view()
    {
        $this->load->model('mainmodel');
        $data['n']=$this->mainmodel->view();
        $this->load->view('view',$data);
    }   

     // Approve the user
    public function approve()
    {
        $this->load->model('mainmodel');
        
        $id=$this->uri->segment(3);
        $this->mainmodel->approve($id);
        redirect('main/view','refresh');
    }   

    //Reject the user 
    public function reject()
    {
        $this->load->model('mainmodel');
        
        $id=$this->uri->segment(3);
        $this->mainmodel->reject($id);
        redirect('main/view','refresh');
    }   

    //View Page After User login
    public function user_dashboard()
    {
        $this->load->view('udash');
    }

    //update User Details
    //view User Details
    public function update_user_det()
    {
        $this->load->model('mainmodel');
        $id=$this->session->id;
        $data['user_data']=$this->mainmodel->update($id);
        $this->load->view('update',$data);
    }
    
    public function updatdetails()
    {
        $a = array("fname"=>$this->input->post("fname"),
            "lname"=>$this->input->post("lname"),
            "email"=>$this->input->post("email"),
            "number"=>$this->input->post("number"),
            "dob"=>$this->input->post("dob"),
            "addr"=>$this->input->post("addr"),
            "dis"=>$this->input->post("dis"),
            "pin"=>$this->input->post("pin"),
            "uname"=>$this->input->post("uname"),
            "password"=>$this->input->post("password"));
         $b= array("email"=>$this->input->post("email"));

        $this->load->model('mainmodel');
        if($this->input->post("update"))
        {
            $id=$this->session->id;
            $this->mainmodel->updatesdetails($a,$b,$id);
            redirect('main/viewusrdet','refresh');
        }
    }

     public function viewusrdet()
    {
        $this->load->model('mainmodel');
        $id=$this->session->id;
        $data['user_data']=$this->mainmodel->update($id);
        $this->load->view('viewusrdet',$data);
    }

    //Delete User Details BY Admin
    public function deletedetails()
    {
        $this->load->model('mainmodel');
        $id=$this->uri->segment(3);
        $this->mainmodel->deletedetails($id);
        redirect('main/view','refresh');
    }
    public function reset_password()
    {
        $this->load->view('resetpassword');
    }

    //Email sending view page
    public function email_sending()
    {
        $this->load->view('sendmail');
    }
    public function send()
    {
            $to =  $this->input->post('from');  // User email pass here
            $subject = 'Welcome To Elevenstech';

            $from = 'k4833@gmail.com';              // Pass here your mail id

            $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://elevenstechwebtutorials.com/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
            $emailContent .='<tr><td style="height:20px"></td></tr>';


            $emailContent .= $this->input->post('message');  //   Post message available here


            $emailContent .='<tr><td style="height:20px"></td></tr>';
            $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://elevenstechwebtutorials.com/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.elevenstechwebtutorials.com</a></p></td></tr></table></body></html>";
                        


            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '60';

            $config['smtp_user']    = 'k4833@gmail.com';    //Important
            $config['smtp_pass']    = 'k4833@123';  //Important

            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not 

             

            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($emailContent);
            $this->email->send();

            $this->session->set_flashdata('msg',"Mail has been sent successfully");
            $this->session->set_flashdata('msg_class','alert-success');
            return redirect('main/email_sending');
    }
    public function success()
    {
        $this->load->view('success');
    }


    

public function email_availibility()  
      {  
      if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  

           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("mainmodel1");  
                if($this->mainmodel1->is_email_available($_POST["email"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }  
       

      }
      public function phno_availability()
      {

                $this->load->model("mainmodel1");  
                if($this->mainmodel1->is_phno_available($_POST["phno"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Phone number Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }
      public function uname_availability()
      {

                $this->load->model("mainmodel1");  
                if($this->mainmodel1->is_uname_available($_POST["uname"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> user name Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }

 } 
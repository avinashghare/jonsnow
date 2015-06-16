<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{
    function getallinterest()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`jonsnow_interest`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`jonsnow_interest`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `jonsnow_interest`");
        $this->load->view("json",$data);
    }
    
    
    public function signup()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $name=$data['name'];
        $email=$data['email'];
        $dob=$data['dob'];
        $data['message']=$this->user_model->signupfrontenduser($name,$email,$dob);
        $this->load->view('json',$data);
    }
    
    public function adduserinterest()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $userid=$data['userid'];
        $interest=$data['interest'];
        $data['message']=$this->user_model->adduserinterest($userid,$interest);
        $this->load->view('json',$data);
    }
    
    public function getfeedbyuser()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $userid=$data['userid'];
        $timestamp=$data['timestamp'];
        $data['message']=$this->feed_model->getfeedbyuser($userid,$timestamp);
        $this->load->view('json',$data);
    }
    
    
    
    
    
    public function getsingleinterest()
    {
        $id=$this->input->get_post("id");
        $data["message"]=$this->interest_model->getsingleinterest($id);
        $this->load->view("json",$data);
    }
    function getallfeed()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`jonsnow_feed`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`jonsnow_feed`.`title`";
        $elements[1]->sort="1";
        $elements[1]->header="Title";
        $elements[1]->alias="title";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`jonsnow_feed`.`description`";
        $elements[2]->sort="1";
        $elements[2]->header="Description";
        $elements[2]->alias="description";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `jonsnow_feed`");
        $this->load->view("json",$data);
    }
    public function getsinglefeed()
    {
        $id=$this->input->get_post("id");
        $data["message"]=$this->feed_model->getsinglefeed($id);
        $this->load->view("json",$data);
    }
} 
?>
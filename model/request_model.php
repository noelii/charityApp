<?php

namespace model;
require_once("../../autoload.php");
class  request_model extends charity_db
{
 private $req_id;
 private $request_time;
 private $request_title;
 private $request_desc;
 private $request_budget;
 private $request_strategy;
 private $request_status;
 private $requester;

 //containing objects
 private $donation;
 private $comment;
 private $share;
 private $all_donations=[];
 private $all_comments=[];
 private $all_shares=[];

 public function __construct($obj=null)
 {
     parent::__construct();
     $this->request_time="";
     $this->request_title="";
     $this->request_desc="";
     $this->request_budget="";
     $this->request_strategy="";
     $this->request_status="";
     $this->requester="";

     $this->actor="requests";
     $this->donation=new donations_model();
     $load=$this->load_request($obj);
     $this->load_donations();
  
  

 }
 private function load_request($id=null)
 {
   if($id!=null)
   {
     $sql="select * from requests where req_id=".$id;
     $res=parent::fetch_data($sql);
     if($res==null){return false;}
     else
     {
         while($req_data=mysqli_fetch_assoc($res))
         {
             $this->req_id=$req_data['req_id'];
             $this->request_time=$req_data['request_time'];
             $this->request_title=$req_data['title'];
             $this->request_title=$req_data['title'];
             $this->request_desc=$req_data['description'];
             $this->request_budget=$req_data['budget'];
             $this->request_strategy=$req_data['strategy'];
             $this->request_status=$req_data['status'];
             $this->requester=$req_data['NGO_id'];
         
         }

         return true;
     }
    }
 }
 //loading all donations for this request
 private function load_donations()
{
   $this->entity="donations";
   $donations_data=parent::fetch_all($this->req_id);
   if($donations_data!=1 && $donations_data!=null)
   {
     while($don=mysqli_fetch_assoc($donations_data))
     {
     $this->donation=new donations_model($don['don_id']);
     array_push($this->all_donations,$this->donation);
     }
   }

$this->donation=new donations_model();
}
//loading all comments for this request
private function load_comments($id=null)
{

//////////////////
if($id!=null)
{
$sql1="select * from comments where req_id=".$id." ORDER BY com_id DESC";
$comments_data=parent::fetch_data($sql1);

if($comments_data!=null)
{
  while($com=mysqli_fetch_assoc($comments_data))
  {
    $this->comment=new comments_model($com['com_id']);
    array_push($this->all_comments,$this->comment);
  }
}

$this->comment=new comments_model();
}
}
//loading all shares made on this requests

private function load_shares()
{
   $this->entity="shares";
   $shares_data=parent::fetch_all($this->req_id);

   if($shares_data!=1 && $shares_data!=null)
   {
     while($sh=mysqli_fetch_assoc($shares_data))
     {
     $this->share=new shares_model($sh['share_id']);
     array_push($this->all_shares,$this->share);
     }
   }

$this->share=new shares_model();
}
 //setting a new request by user
  public function set_request($data)
  {
   
    $this->request_time=$data['request_time'];
    $this->request_title=$data['request_title'];
    $this->request_desc=$data['request_desc'];
    $this->request_budget=$data['request_budget'];
    $this->request_strategy=$data['request_strategy'];
    $this->request_status=$data['request_status'];
    
   
  }
  public function save_request($requestor)
  {
     $sql="insert into requests (request_time,title,description,budget,strategy,status,ngo_id)";
     $sql=$sql."values('".$this->request_time."','".$this->request_title."','".$this->request_desc;
     $sql=$sql."','".$this->request_budget."','".$this->request_strategy."','".$this->request_status."',".$requestor.")";

     if(parent::insert_data($sql)){
       $lastinsertid=mysqli_insert_id($this->conn);
       return $lastinsertid;
      }else{
        return false;
      }


  }
  public function update($field,$value)
  {
      $sql="update requests set ".$field."=".$value." where req_id=".$this->req_id;
      if(parent::update_data($sql)){ $this->{$field}=$value; return true;}else{return false;}
  }
  //deleting a request, may be by admin or ngo
  public function delete()
  {
    $sql="delete from requests where req_id=".$this->req_id;
    if(parent::delete_data($sql)){return true;}else{return false;}
  }

//setters and getters
 public function set_time($time){$this->request_time=$time;}
 public function set_title($title){$this->request_title=$title;}
 public function set_desc($desc){$this->request_desc=$desc;}
 public function set_budget($budget){$this->request_budget=$budget;}
 public function set_strategy($str){$this->request_strategy=$str;}
 public function set_requester($rq){$this->requester=$rq;}
 public function set_donation($donation){$this->donation=$donation;}
 public function set_comment($com){$this->comment=$com;}
 public function set_share($sh){$this->share=$sh;}


 public function get_ngo_id(){ return $this->requester;}
 public function get_id(){return $this->req_id;}
 public function get_time(){ return $this->request_time;}
 public function get_title(){return $this->request_title;}
 public function get_desc(){return $this->request_desc;}
 public function get_budget(){return $this->request_budget;}
 public function get_strategy(){return $this->request_strategy;}
 public function get_requester(){return $this->requester;}
 public function get_donation(){return $this->donation;}
 public function get_comment(){return $this->comment;}
 public function get_share(){return $this->share;}
 public function get_all_donations(){return $this->all_donations;}
 public function get_all_comments(){return $this->all_comments;}
 public function get_all_shares(){return $this->all_shares;}
}


?>
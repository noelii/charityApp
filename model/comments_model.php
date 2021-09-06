<?php

namespace model;
require_once("../../autoload.php");

class comments_model extends charity_db
{
 private $com_id;
 private $comment;
 private $com_date;
 private $com_time;
 private $req_id;
 private $donor_id;


 public function __construct($obj=null)
 {
     parent::__construct();
     $this->comment="";
     $this->com_date="";
     $this->com_time=""; 
     $load=$this->load_comment($obj);   
 }
 private function load_comment($id)
 {
   if($id!=null)
   {
     $sql="select * from comments where com_id=".$id." ORDER BY com_id DESC";
     $res=parent::fetch_data($sql);
     if($res==null){return false;}
     else
     {
         while($req_data=mysqli_fetch_assoc($res))
         {
             $this->com_id=$req_data['com_id'];
             $this->comment=$req_data['comment'];
             $this->com_date=$req_data['com_date'];
             $this->com_time=$req_data['com_time'];
             $this->req_id=$req_data['req_id'];
             $this->donor_id=$req_data['donor_id'];
         
         }

         return true;
     }
    }

 }
 
  public function set_comment($data)
  {
   
    $this->com_time=$data['com_time'];
    $this->com_date=$data['com_date'];
    $this->comment=$data['comment'];
    $this->req_id=$data['req_id']; 
    $this->donor_id=$data['donor_id']; 
  }
  public function save_comment()
  {
     $sql="insert into comments (comment,com_date,com_time,req_id,donor_id)";
     $sql=$sql."values('".$this->comment."','".$this->com_date."','".$this->com_time;
     $sql=$sql."',".$this->req_id.",".$this->donor_id.")";

     if(parent::insert_data($sql)){return true;}else{return false;}


  }
  public function update($field,$value)
  {
      $sql="update comments set ".$field."=".$value." where com_id=".$this->com_id;
      if(parent::update_data($sql)){ $this->{$field}=$value; return true;}else{return false;}
  }
  //deleting a comment

  public function delete()
  {
    $sql="delete from comments where com_id=".$this->com_id;
    if(parent::delete_data($sql)){return true;}else{return false;}
  }

//setters and getters
 public function set_time($time){$this->com_time=$time;}
 public function set_date($date){$this->com_date=$date;}
 public function set_com($com){$this->comment=$com;}
 public function set_req($req){$this->req_id=$req;}
 public function set_donor($donor){$this->donor_id=$donor;}


 public function get_time(){ return $this->com_time;}
 public function get_date(){return $this->com_date;}
 public function get_comment(){return $this->comment;}
 public function get_req(){return $this->req_id;}
 public function get_donor(){return $this->donor_id;}

}


?>
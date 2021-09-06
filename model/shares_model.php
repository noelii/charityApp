<?php

namespace model;
require_once("../../autoload.php");
class  shares_model extends charity_db
{
 private $share_id;
 private $share_time;
 private $share_date;
 private $res_no;
 private $req_id;
 private $donor_id;


 public function __construct($obj=null)
 {
     parent::__construct();
     $this->share_time="";
     $this->share_date=""; 
     $load=$this->load_share($obj); 
 }
 private function load_share($id)
 {
     if($id!=null)
     {
     $sql="select * from shares where share_id='$id'";
     $res=parent::fetch_data($sql);
     if($res==1){return false;}
     else
     {
         while($req_data=mysqli_fetch_assoc($res))
         {
             $this->share_id=$req_data['share_id'];
             $this->share_time=$req_data['share_time'];
             $this->share_date=$req_data['share_date'];
             $this->res_no=$req_data['res_no'];
             $this->req_id=$req_data['req_id'];
             $this->donor_id=$req_data['donor_id'];
         
         }

         return true;
     }
    }

 }
 
  public function set_share($data)
  {
   
    $this->share_time=$data['share_time'];
    $this->share_date=$data['share_date'];
    $this->res_no=$data['res_no'];
    $this->req_id=$data['req_id'];
    $this->donor_id=$data['donor_id'];
   
  }
  public function save_share()
  {
     $sql="insert into shares (share_time,share_date,res_no,req_id,donor_id)";
     $sql=$sql."values(".$this->share_time.",".$this->share_date.",".$this->res_no;
     $sql=$sql.",".$this->req_id.",".$this->donor_id.")";

     if(parent::insert_data($sql)){return true;}else{return false;}


  }
  public function update($field,$value)
  {
      $sql="update shares set ".$field."=".$value." where share_id=".$this->share_id;
      if(parent::update_data($sql)){ $this->{$field}=$value; return true;}else{return false;}
  }

//setters and getters
 public function set_time($time){$this->share_time=$time;}
 public function set_date($date){$this->share_date=$date;}
 public function set_resno($resno){$this->res_no=$resno;}
 public function set_req($req){$this->req_id=$req;}
 public function set_donor($donor){$this->donor_id=$donor;}


 public function get_time(){ return $this->share_time;}
 public function get_date(){return $this->share_date;}
 public function get_resno(){return $this->res_no;}
 public function get_req(){return $this->req_id;}
 public function get_donor(){return $this->donor_id;}

}


?>
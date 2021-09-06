<?php

namespace model;
require_once("../../autoload.php");
class ngouploads_model extends charity_db
{
 private $upload_id;
 private $path;
 private $upload_date;
 private $upload_time;
 private $ngo_id;


 public function __construct($obj=null)
 {
     parent::__construct();
     $this->path="";
     $this->upload_date="";
     $this->upload_time=""; 
     $load=$this->load_upload($obj);   
 }
 public function load_upload($id)
 {
   if($id!=null)
   {
     $sql="select * from ngo_uploads where upload_id=".$id;
     $res=parent::fetch_data($sql);
     if($res!=null){
   
         while($req_data=mysqli_fetch_assoc($res))
         {
             $this->upload_id=$req_data['upload_id'];
             $this->path=$req_data['path'];
             $this->upload_date=$req_data['upload_date'];
             $this->upload_time=$req_data['upload_time'];
             $this->ngo_id=$req_data['NGO_id'];
         
         }

        }  
 

 }
}
 
  public function set_upload($data)
  {
   
    $this->upload_time=$data['upload_time'];
    $this->upload_date=$data['upload_date'];
    $this->path=$data['path'];
    $this->ngo_id=$data['ngo_id']; 
  }
  public function save_upload()
  {
     $sql="insert into ngo_uploads (path,upload_date,upload_time,ngo_id)";
     $sql=$sql."values('".$this->path."','".$this->upload_date."','".$this->upload_time;
     $sql=$sql."',".$this->ngo_id.")";

     if(parent::insert_data($sql)==true){return true;}else{return false;}


  }
  public function update($field,$value)
  {
      $sql="update ngo_uploads set ".$field."=".$value." where upload_id=".$this->upload_id;
      if(parent::update_data($sql)){ $this->{$field}=$value; return true;}else{return false;}
  }
  //deleting uploaded files
  public function delete()
  {
    $sql="delete from ngo_uploads where upload_id=".$this->upload_id;
    if(parent::delete_data($sql)==true){return true;}else{return false;} 
  }
//setters and getters
 public function set_time($time){$this->upload_time=$time;}
 public function set_date($date){$this->upload_date=$date;}
 public function set_path($path){$this->path=$path;}
 public function set_ngo($ngo){$this->ngo_id=$ngo;}

 public function get_id(){return $this->upload_id;}
 public function get_time(){ return $this->upload_time;}
 public function get_date(){return $this->upload_date;}
 public function get_path(){return $this->path;}
 public function get_ngo(){return $this->ngo_id;}

}


?>
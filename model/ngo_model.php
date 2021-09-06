<?php

namespace model;
require_once("../../autoload.php");

class ngo_model extends charity_db
{
 private $ngo_id;
 private $ngo_name;
 private $ngo_email;
 private $ngo_pwd;
 private $ngo_country;
 private $ngo_city;
 private $ngo_phone;
 private $ngo_status;
 private $ngo_img;

 //containing objects

 private $request;
 private $upload;
 private $all_requests=array();
 private $all_uploads=array();

 public function __construct($obj=null)
 {
     parent::__construct();
     $this->ngo_name="";
     $this->ngo_phone="";
     $this->ngo_email="";
     $this->ngo_pwd="";
     $this->ngo_country="";
     $this->ngo_city="";
     $this->ngo_status="";
     $this->ngo_img="";
     $this->request=new request_model();
     $this->upload=new ngouploads_model();
     $this->actor="ngo";
     if($obj!=null)
     {
     $load=$this->load_ngo_byid($obj);
     $this->load_requests();
     $this->load_uploads();
     }
     
 }

 public function load_ngo($pass,$email)
 {
     $sql="select * from ngo where NGO_email='".$email."'";
     $res=parent::fetch_data($sql);
     if($res==null){return false;}
     else
     {
         while($ngo_data=mysqli_fetch_assoc($res))
         {
            if(password_verify($pass,$ngo_data['NGO_password']))
            {
             $this->ngo_id=$ngo_data['NGO_id'];
             $this->ngo_name=$ngo_data['NGO_name'];
             $this->ngo_email=$ngo_data['NGO_email'];
             $this->ngo_pwd=$ngo_data['NGO_password'];
             $this->ngo_country=$ngo_data['NGO_country'];
             $this->ngo_city=$ngo_data['NGO_city'];
             $this->ngo_phone=$ngo_data['NGO_phoneno'];
             $this->ngo_status=$ngo_data['NGO_status'];
             $this->ngo_img=$ngo_data['NGO_img'];

             $this->load_requests();
             $this->load_uploads();
             return true;
            }
            else{

              return false;
            }
         }
 
     }

 }
 //loading by id
 private function load_ngo_byid($id)
 {
   if($id!=null)
   {
    $sql="select * from ngo where NGO_id=".$id;
    $res=parent::fetch_data($sql);
    if($res==null){return false;}
    else
    {
        while($ngo_data=mysqli_fetch_assoc($res))
        {
            $this->ngo_id=$ngo_data['NGO_id'];
            $this->ngo_name=$ngo_data['NGO_name'];
            $this->ngo_email=$ngo_data['NGO_email'];
            $this->ngo_pwd=$ngo_data['NGO_password'];
            $this->ngo_country=$ngo_data['NGO_country'];
            $this->ngo_city=$ngo_data['NGO_city'];
            $this->ngo_phone=$ngo_data['NGO_phoneno'];
            $this->ngo_status=$ngo_data['NGO_status'];
            $this->ngo_img=$ngo_data['NGO_img'];
        }
        $this->upload=new ngouploads_model();
        return true;
    }
  } 
 }
 //load all requests
 private function load_requests()
 {
  // $this->entity="requests";
   $sql1="select * from requests where NGO_id=".$this->ngo_id;
   $requests_data=parent::fetch_data($sql1);

   if($requests_data!=null)
   {
     while($rq=mysqli_fetch_assoc($requests_data))
     {
     $this->request=new request_model($rq['req_id']);
     array_push($this->all_requests,$this->request);
     }
   }

$this->request=new request_model();
 }
 //load all uploads
 private function load_uploads()
 {
   $this->entity="ngo_uploads";
   $sql="select * from ngo_uploads where NGO_id=".$this->ngo_id;
   $uploads_data=parent::fetch_data($sql);

   if($uploads_data!=null)
   {
     while($up=mysqli_fetch_assoc($uploads_data))
     {
     $this->upload=new ngouploads_model($up['upload_id']);
     array_push($this->all_uploads,$this->upload);
     }
   }

$this->upload=new ngouploads_model();
 }
  public function set_ngo($data)
  {
    $this->ngo_name=$data['ngo_name'];
    $this->ngo_phone=$data['ngo_phone'];
    $this->ngo_email=$data['ngo_email'];
    $this->ngo_pwd=$data['ngo_pwd'];
    $this->ngo_country=$data['ngo_country'];
    $this->ngo_city=$data['ngo_city'];
    $this->ngo_img=$data['ngo_img'];
    $this->ngo_status=$data['ngo_status'];
  }
  public function save_ngo()
  {
     $sql="insert into ngo (ngo_name,ngo_country,ngo_city,ngo_email,ngo_password,ngo_phoneno,ngo_status";
     $sql=$sql.",ngo_img) values('".$this->ngo_name."','".$this->ngo_country."','".$this->ngo_city;
     $sql=$sql."','".$this->ngo_email."','".$this->ngo_pwd."','".$this->ngo_phone."','".$this->ngo_status."','".$this->ngo_img."')";

     if(parent::insert_data($sql)){return true;}else{return false;}


  }
  public function update($field,$value)
  {
      $sql="update ngo set ".$field."='".$value."' where ngo_id=".$this->ngo_id;
      if(parent::update_data($sql)==true){return true;}else{return false;}
  }
  //updating

  public function updateall()
  {
    $this->update("ngo_name",$this->ngo_name);
    $this->update("ngo_country",$this->ngo_country);
    $this->update("ngo_city",$this->ngo_city);
    $this->update("ngo_email",$this->ngo_email);
    $this->update("ngo_phoneno", $this->ngo_phone);
  }
//deleting the current ngo

public function delete()
{
    $sql="delete from ngo where ngo_id=".$this->ngo_id;
    if(parent::delete_data($sql)){return true;}else{return false;} 
}

//setters and getters
 public function set_name($name){$this->ngo_name=$name;}
 public function set_phone($phone){$this->ngo_phone=$phone;}
 public function set_email($email){$this->ngo_email=$email;}
 public function set_pwd($pwd){$this->ngo_pwd=$pwd;}
 public function set_country($country){$this->ngo_country=$country;}
 public function set_city($city){$this->ngo_city=$city;}
 public function set_img($img){$this->ngo_img=$img;}
 public function set_status($status){$this->ngo_status=$status;}
 public function set_request($req){$this->request=$req;}
 public function set_upload($upload){$this->upload=$upload;}
 public function get_id(){ return $this->ngo_id;}
 public function get_name(){ return $this->ngo_name;}
 public function get_phone(){return $this->ngo_phone;}
 public function get_email(){return $this->ngo_email;}
 public function get_pwd(){return $this->ngo_pwd;}
 public function get_country(){return $this->ngo_country;}
 public function get_city(){return $this->ngo_city;}
 public function get_img(){return $this->ngo_img;}
 public function get_status(){return $this->ngo_status;}
 public function get_request(){return $this->request;}
 public function get_upload(){return $this->upload;}
 public function get_all_requests(){return $this->all_requests;}
 public function get_all_uploads(){return $this->all_uploads;}


}




?>
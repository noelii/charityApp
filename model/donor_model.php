<?php

namespace model;

require_once("../../autoload.php");
class donor_model extends charity_db
{
 private $donor_id;
 private $donor_fname;
 private $donor_lname;
 private $donor_email;
 private $donor_pwd;
 private $donor_country;
 private $donor_city;
 private $donor_img;

 //containing objects
 private $share;
 private $donation;
 private $comment;

 // all donations made by this donor

 private $all_donations=[];
 
 public function __construct($obj=null)
 {
     parent::__construct();
     $this->donor_fname="";
     $this->donor_lname="";
     $this->donor_email="";
     $this->donor_pwd="";
     $this->donor_country="";
     $this->donor_city="";
     $this->donor_img="";

    $this->actor="donor";
    $this->share=new shares_model();
    $this->donation=new donations_model();
    $this->comment=new comments_model();
    if($obj!=null)
    {
    $load=$this->load_donor_by_id($obj);
    $this->load_donations();
    }
 }
 public function load_donor($pass,$email)
 {
     $sql="select * from donor where donor_email='$email'";
     $res=parent::fetch_data($sql);
     if($res==null){return false;}
     else
     {
         while($donor_data=mysqli_fetch_assoc($res))
         {
            if(password_verify ($pass,$donor_data['donor_pwd']))
            {
             $this->donor_id=$donor_data['donor_id'];
             $this->donor_fname=$donor_data['donor_fname'];
             $this->donor_lname=$donor_data['donor_lname'];
             $this->donor_email=$donor_data['donor_email'];
             $this->donor_pwd=$donor_data['donor_pwd'];
             $this->donor_country=$donor_data['donor_country'];
             $this->donor_city=$donor_data['donor_city'];
             $this->donor_img=$donor_data['donor_img'];
             $this->load_donations();
             return true;
            }
            else
            {
                return false;
            }

         }
       
     }

 }
  //loading by id
 private function load_donor_by_id($id)
 {
     if($id!=null)
     {
     $sql="select * from donor where donor_id=".$id;
     $res=parent::fetch_data($sql);
     if($res==null){return false;}
     else
     {
         while($donor_data=mysqli_fetch_assoc($res))
         {
             $this->donor_id=$donor_data['donor_id'];
             $this->donor_fname=$donor_data['donor_fname'];
             $this->donor_lname=$donor_data['donor_lname'];
             $this->donor_email=$donor_data['donor_email'];
             $this->donor_pwd=$donor_data['donor_pwd'];
             $this->donor_country=$donor_data['donor_country'];
             $this->donor_city=$donor_data['donor_city'];
             $this->donor_img=$donor_data['donor_img'];
         }
         return true;
     }
    }

 }
private function load_donations()
{
$sql="select * from donations where donor_id=".$this->donor_id;
   $donations=parent::fetch_data($sql);

   if($donations!=null)
   {
     while($don=mysqli_fetch_assoc($donations))
     {
        $this->donation=new donations_model($don['don_id']);
        array_push($this->all_donations,$this->donation);
     }
   }

   $this->donation=new donations_model();
}
  
  public function set_donor($data)
  {
    $this->donor_fname=$data['donor_fname'];
    $this->donor_lname=$data['donor_lname'];
    $this->donor_email=$data['donor_email'];
    $this->donor_pwd=$data['donor_pwd'];
    $this->donor_country=$data['donor_country'];
    $this->donor_city=$data['donor_city'];
    $this->donor_img=$data['donor_img'];
  }
  public function save_donor()
  {
     $sql="insert into donor (donor_fname,donor_lname,donor_email,donor_pwd,donor_country,";
     $sql=$sql."donor_city,donor_img) values('".$this->donor_fname."','".$this->donor_lname."','".$this->donor_email;
     $sql=$sql."','".$this->donor_pwd."','".$this->donor_country."','".$this->donor_city."','".$this->donor_img."')";

     if(parent::insert_data($sql)){return true;}else{return false;}


  }
  public function update($field,$value)
  {
      $sql="update donor set ".$field."='".$value."' where donor_id=".$this->donor_id;
      if(parent::update_data($sql)==true){return true;}else{return false;}
  }
  //deleting a donor, used by the admin
  public function delete()
  {
      $sql="delete from donor where donor_id=".$this->donor_id;
      if(parent::delete_data($sql)){return true;}else{return false;}
  }

//setters and getters
 public function set_fname($name){$this->donor_fname=$name;}
 public function set_lname($name){$this->donor_lname=$name;}
 public function set_email($email){$this->donor_email=$email;}
 public function set_pwd($pwd){$this->donor_pwd=$pwd;}
 public function set_country($country){$this->donor_country=$country;}
 public function set_city($city){$this->donor_city=$city;}
 public function set_img($img){$this->donor_img=$img;}
 public function set_share($share){$this->share=$share;}
 public function set_comment($comment){$this->comment=$comment;}
 public function set_donation($donation){$this->donation=$donation;}

 public function get_fname(){ return $this->donor_fname;}
 public function get_lname(){return $this->donor_lname;}
 public function get_email(){return $this->donor_email;}
 public function get_pwd(){return $this->donor_pwd;}
 public function get_country(){return $this->donor_country;}
 public function get_city(){return $this->donor_city;}
 public function get_img(){return $this->donor_img;}

 public function get_share(){return $this->share;}
 public function get_comment(){return $this->comment;}
 public function get_donation(){return $this->donation;}
 public function get_all_donations(){return $this->all_donations;}
 public function get_id(){return $this->donor_id;}



}


?>
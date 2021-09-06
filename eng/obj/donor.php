<?php

namespace eng\obj;
use \model\{admin_model,donor_model,ngo_model,request_model};

require_once("../../autoload.php");

class donor extends charity_user
{

    public function __construct($donorid=null)
    {
        $this->data=new donor_model($donorid);
    }

    public  function createAccount($data)
    {
      $this->data->set_donor($data);
      if($this->data->save_donor()){return true;}else{return false;}
    }
    public  function viewInfo()
    {
      $output=[];
      $output['img']=$this->data->get_img();
      $output['name']=$this->data->get_fname();
      $output['email']=$this->data->get_email();
      $output['country']=$this->data->get_country();
      $output['city']=$this->data->get_city();
     
  
      return json_encode($output);
    }
    public function uploadlogo($file)
    {
      $exta=['jpg','jpeg','png','PNG','JPG','JPEG'];
      $ext=pathinfo($file['name'],PATHINFO_EXTENSION);
      if(!in_array($ext,$exta)){print "only PNG and JPG images are allowed..."; return false;}
      else
      {
  $target_dir ="../../ui/dist/img/";
  $target_file = $target_dir.time()."profil.".pathinfo($file['name'],PATHINFO_EXTENSION);
  $uploadOk = 1;
  if (file_exists($target_file)) {
    print "file already exists.";
    $uploadOk = 0;
  }
  
  if ($file["size"] > 50000000) {
    print "file too large.";
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
   print "file not uploaded.";
  } else {
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
      
       
       $uploadmod=$this->data;
  
       if($uploadmod->update("donor_img",time()."profil.".pathinfo($file['name'],PATHINFO_EXTENSION))==true){ return true; }
       else{ unlink($target_file); print "updating failed";}
    } else {
      print "updating failed";
    }
  }
    }
  }
    public  function viewRequests()
    {

    }
    public function donate($data)
    {
      $this->data->get_donation()->set_donation($data);
      $returned=$this->data->get_donation()->save_donation();
      if($returned!==false){return $returned;}else{return false;}
    }
    public function comment($data)
    {
      $this->data->comment->set_comment($data);
      $this->data->comment->save_comment();
    }
    public function viewDonations()
    {

    }
    public function login($pass,$email)
    {
        if($this->data->load_donor($pass,$email))
        {
            return $this->data;
      
        }
      
    }
  //all donattions

   public function viewall_requests()
   {

     $alldon=$this->data->get_all_donations();
     $donprint="";
     for($d=0;$d<count($alldon);$d++)
     {
      $req=new request_model($alldon[$d]->get_req());
      $don_ngo=new ngo_model($req->get_requester());
      $donprint.='<div class="card">';
      $donprint.='<div class="card-header p-2">';
      $donprint.='<div class="user-block" style="margin-right:20%">';
      $donprint.='<img class="img-circle img-bordered-sm" src="dist/img/'.$don_ngo->get_img().'" >';
      $donprint.='<span class="username">';
      $donprint.='<a href="#">'.$don_ngo->get_name().'</a>';
      $donprint.='</span>';
      $donprint.='</div>';
      $donprint.='<div class="row">';
      $donprint.='<div class="col-md-4">';
      $donprint.='<img class="img-circle img-bordered-sm" src="dist/img/donate.png" alt="beg icon" style="height:85%;width:20%">';
      $donprint.='<span>'.$alldon[$d]->get_amount().' donated</span>';
      $donprint.='</div>';
      $donprint.='<div class="col-md-3">';
      $donprint.='<span>';
      $donprint.='<a href="#" class="link-black text-sm">';
      $donprint.='<span>'.$alldon[$d]->get_date().'</span>';
      $donprint.='</a>';
      $donprint.='</span>';
      $donprint.='</div>';
      $donprint.='<div class="col-md-3">';
      $donprint.='<span>';
      $donprint.='<a href="#" class="link-black text-sm">';
      $donprint.='<span>'.$alldon[$d]->get_time().'</span>';
      $donprint.='</a>';
      $donprint.='</span>';
      $donprint.='</div>';
      $donprint.='</div>';
      $donprint.='</div>';
      $donprint.='</div>';
    

     }

     return $donprint;
   }
    //getters and setters

    public function set_data($data){$this->data=$data;}
    public function get_data(){return $this->data;}



}







?>
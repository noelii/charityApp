<?php

namespace model;
require_once("../../autoload.php");
class  donations_model extends charity_db
{
 private $don_id;
 private $don_time;
 private $don_date;
 private $amount;
 private $currency;
 private $cardnumber;
 private $recommand;
 private $req_id;
 private $donor_id;
 private $receipt;
 private $requester;

//constructor for an empty donation, used for making a new donation
 public function __construct($obj=null)
 {
     parent::__construct();
     $this->don_time="";
     $this->don_date="";
     $this->recommand="";
     $load=$this->load_donation($obj);    
 }
 //loading a donation by its id
 private function load_donation($id)
 {
     if($id!=null)
     {
     $sql="select * from donations where don_id=".$id;
     $res=parent::fetch_data($sql);
     if($res==null){return false;}
     else
     {
         while($req_data=mysqli_fetch_assoc($res))
         {
             $this->don_id=$req_data['don_id'];
             $this->don_time=$req_data['don_time'];
             $this->don_date=$req_data['don_date'];
             $this->amount=$req_data['amount'];
             $this->recommand=$req_data['recommandation'];
             $this->req_id=$req_data['req_id'];
             $this->donor_id=$req_data['donor_id'];
             $this->currency=$req_data['currency'];
             $this->cardnumber=$req_data['cardnumber'];
             $this->receipt=$req_data['receipt'];
             $this->requester=(new request_model($req_data['req_id']))->get_ngo_id();
         
         }

         return true;
     }
    }

 }
 //setting a new donation, used for making new ones
  public function set_donation($data)
  {
   
    $this->don_time=$data['don_time'];
    $this->don_date=$data['don_date'];
    $this->amount=$data['amount'];
    $this->recommand=$data['recommandation'];
    $this->req_id=$data['req_id'];
    $this->donor_id=$data['donor'];
    $this->currency=$data['currency'];
    $this->cardnumber=$data['cardnumber'];
    $this->requester=(new request_model($data['req_id']))->get_ngo_id();
    $receipt="request_ID: ".$data['req_id']."requester: ".(new request_model($data['req_id']))->get_ngo_id()."donor: ".$_SESSION['donor']->get_id();
    $this->receipt=password_hash($receipt, PASSWORD_DEFAULT);
   
  }
  //commiting donation in the database, using for making new ones
  public function save_donation()
  {
     $sql="insert into donations (don_date,don_time,amount,currency,cardnumber,receipt,recommandation,req_id,donor_id)";
     $sql=$sql."values('".$this->don_date."','".$this->don_time."',".$this->amount;
     $sql=$sql.",'".$this->currency."','".$this->cardnumber."','".$this->receipt."','".$this->recommand."',".$this->req_id.",".$this->donor_id.")";

     if(parent::insert_data($sql)){
      
      $donor=new donor_model($this->donor_id);
      $receiptdata=[];
      $receiptdata["receiptnumber"]=$this->receipt;
      $receiptdata["amount"]=$this->amount." ".$this->currency;
      $receiptdata["donor_name"]=$donor->get_fname()." ".$donor->get_lname();
      $receiptdata["requestor"]=(new ngo_model($this->requester))->get_name();
      $receiptdata["donor_id"]=password_hash($this->donor_id, PASSWORD_DEFAULT);
     
      $receiptdata["date"]=$this->don_date;
      $receiptdata["time"]=$this->don_time;
      $receiptdata["signature"]=password_hash("charitysignature".$this->don_date." ".$this->don_time, PASSWORD_DEFAULT);

      return $receiptdata;

    
    }else{
        return false;
        
        }


  }
  //used for updating donations incase it is need
  public function update($field,$value)
  {
      $sql="update donations set ".$field."=".$value." where don_id=".$this->don_id;
      if(parent::update_data($sql)){ $this->{$field}=$value; return true;}else{return false;}
  }

//setters and getters
 public function set_time($time){$this->don_time=$time;}
 public function set_date($date){$this->don_date=$date;}
 public function set_amount($amount){$this->amount=$amount;}
 public function set_recom($recom){$this->recommand=$recom;}
 public function set_req($req){$this->req_id=$req;}
 public function set_id($donor){$this->donor_id=$donor;}


 public function get_time(){ return $this->don_time;}
 public function get_date(){return $this->don_date;}
 public function get_amount(){return $this->amount;}
 public function get_recom(){return $this->recommand;}
 public function get_req(){return $this->req_id;}
 public function get_id(){return $this->donor_id;}


}


?>
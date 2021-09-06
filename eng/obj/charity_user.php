<?php
  namespace eng\obj;
  
  use \model\{admin_model,donor_model,ngo_model};

  require_once("../../autoload.php");
  abstract class charity_user
  {

   private $data;

   public abstract function createAccount($data);
   public abstract function viewInfo();
   public abstract function viewRequests();
   public abstract function login($email,$pass);
   

  }



















?>
<?php
namespace App\Traits;

use App\User;

class LicenseBooking {
    // Properties
    public $LicenseCode;
    public $IsTrial;
    public $ActivationTime;
    public $StartTrialTime;
    public $Message;
    public $IsError;
    public $IsOk;
    public $ID;
    public $CreationDateTime;
    public $IsAvailable;
    public $IsActivated;
    public $UserEmail;
    public $DeviceInfo;
    public $DeviceUniqueId;
     
    
    public $FirstStartTime;
    public $LastCheckTime;
    public $Notes;
    // Methods
    function set_license($license,$isTrial) {
      
      $this->LicenseCode = $license->license_id;
      $this->IsTrial = $isTrial;
      $this->ActivationTime = "2021-02-10T11:05:35.07741+05:00";
      $this->StartTrialTime = "2021-02-10T11:05:35.07741+05:00";
  
        $this->ID=$license->id;
        $this->CreationDateTime="2021-02-10T11:05:35.07741+05:00";
        $this->IsAvailable = false;
        $this->IsActivated = true;
        $useremail = User::where('id',$license->user_id)->first();
        $this->UserEmail =$useremail->email;
        $this->DeviceInfo = 'xyz';
        $this->DeviceUniqueId = $license->device_id;
        $this->FirstStartTime = "2021-02-10T11:05:35.07741+05:00";
        $this->LastCheckTime = "2021-02-10T11:05:35.07741+05:00";
        $this->Notes = "License Activation Process";
    }
   
  }
  
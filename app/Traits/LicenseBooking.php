<?php

namespace App\Traits;

use App\User;
use App\License;

class LicenseBooking
{
  // Properties
  public $LicenseCode;
  public $IsTrial = false;
  public $ActivationTime;
  public $StartTrialTime;
  public $ID = 1;
  public $CreationDateTime;
  public $IsAvailable = false;
  public $IsActivated = false;
  public $UserEmail;
  public $UserPassword;
  public $UserFirstName;
  public $UserLastName;
  public $UserPhone;
  public $DeviceInfo;
  public $DeviceUniqueId;
  public $FirstStartTime;
  public $LastCheckTime;
  public $Notes;
  // Methods
  function set_license($license, $isTrial)
  {
    
    $licenseActivation = '';
    if(!$isTrial)
    {
      $licenseActivation = License::where('license','=',$license->license_id)->first();
    }
    $this->LicenseCode = ($isTrial) ? $license->license : $licenseActivation->license;
    $this->ActivationTime = ($isTrial) ? $license->license_activated_at:$licenseActivation->license_activated_at;
    $this->StartTrialTime =  ($isTrial) ? $license->trial_activated_at: $licenseActivation->trial_activated_at;
    $this->ID =  ($isTrial) ? $license->id : $licenseActivation->id;
    $this->CreationDateTime = "2021-02-10T11:05:35.07741+05:00";
    $this->IsAvailable = false;
    $this->IsActivated = ($isTrial) ? false : true ;
    $useremail = User::where('id', $license->user_id)->first();
    $this->UserEmail = $useremail->email;
    $this->UserPassword = $useremail->password;
    $this->UserFirstName = $useremail->first_name;
    $this->UserLastName = $useremail->last_name;
    $this->Userphone = $useremail->phone;
    $this->DeviceInfo = 'xyz';
    $this->DeviceUniqueId = $license->device_id;
    $this->FirstStartTime = "2021-02-10T11:05:35.07741+05:00";
    $this->LastCheckTime = "2021-02-10T11:05:35.07741+05:00";
    $this->Notes = ($isTrial)?"License Activation Process":"Trial Activation Process";
   
    
  }

 
}

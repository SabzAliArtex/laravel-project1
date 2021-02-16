<?php

namespace App\Traits;

use App\User;

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

    $this->LicenseCode = $license->license_id;
    $this->IsTrial = $isTrial;
    $this->ActivationTime = "2021-02-10T11:05:35.07741+05:00";
    $this->StartTrialTime = "2021-02-10T11:05:35.07741+05:00";
    $this->ID = $license->id;
    $this->CreationDateTime = "2021-02-10T11:05:35.07741+05:00";
    $this->IsAvailable = false;
    $this->IsActivated = true;
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
    $this->Notes = "License Activation Process";
  }

  function set_license_Trial($license, $isTrial)
  {

    $this->LicenseCode = $license->license;
    $this->IsTrial = $isTrial;
    $this->ActivationTime = $license->trial_activated_at;
    $this->StartTrialTime = $license->trial_activated_at;
    $this->ID = $license->id;
    $this->CreationDateTime = "2021-02-10T11:05:35.07741+05:00";
    $this->IsAvailable = true;
    $this->IsActivated = false;
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
    $this->Notes = "License Trial Process";
  }
}

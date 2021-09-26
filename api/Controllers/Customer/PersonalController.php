<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Controllers\LocationController;
use App\Components\ProfilePageComponent;
use App\Models\User;
use App\Utils\AlertMessage;
use App\Utils\ValidatorList;

class PersonalController extends BaseController
{

  private $user;
  private $user_info;
  private $validator;

  public function __construct()
  {
    $this->user = User::getCurrentUser();
    $this->user_info = $this->user->getUserInfo();
    $this->validator = new ValidatorList;
  }

  public function get()
  {
    $regions = LocationController::$regions;

    $view = new ProfilePageComponent("personal_page");
    $view->setActivePage("personal");
    $view->setTitle("Personal Info");
    $view->addContentData("user", $this->user);
    $view->addContentData("user_info", $this->user_info);
    $view->addContentData("regions", $regions);
    $view->addContentData("validator", $this->validator);
    $view->addScript(asset('js/promise-polyfill.min.js'));
    $view->addScript(asset('js/axios.min.js'));
    $view->addScript(asset('js/address.js'));


    if (!is_null($this->user_info->region) && LocationController::isValidRegion($this->user_info->region))
    {
      $region = $this->user_info->region;
      $view->addJSData("region_data", LocationController::getLocation()->$region);
      $view->addJSData("region", $region);
      if (!is_null($this->user_info->province)) 
      {
        $view->addJSData("province", $this->user_info->province);
        if (!is_null($this->user_info->municipality)) 
        {
          $view->addJSData("municipality", $this->user_info->municipality);
          if (!is_null($this->user_info->barangay)) 
          {
            $view->addJSData("barangay", $this->user_info->barangay);
          }
        }
      }
    }

    $this->renderCustomerLayout($view);
  }

  public function patch()
  {
    $type = post('type');
    if ($type == 'contact') {
      return $this->updateContact();
    } else if ($type == 'address') {
      return $this->updateAddress();
    }
    redirect('?page=personal');
  }

  private function updateAddress()
  {
    $this->user_info->region = post('region');
    $this->user_info->province = post('province');
    $this->user_info->municipality = post('municipality');
    $this->user_info->barangay = post('barangay');
    $this->user_info->street = post('street');
    $this->user_info->unit = post('unit');
    $this->user_info->update();
    AlertMessage::success("Address Info updated successfully");
    redirect('?page=personal');
  }

  private function updateContact()
  {
    $this->validator->add("firstname", "required|min:2|max:30|name", "Firstname");
    $this->validator->add("lastname", "required|min:2|max:30|name", "Lastname");

    if ($this->validator->hasError())
      return $this->get();

    $this->user->firstname = post('firstname');
    $this->user->lastname = post('lastname');
    $this->user_info->phone = post('phone');

    $this->user->update();
    $this->user_info->update();

    AlertMessage::success("Contact Info updated successfully");
    redirect('?page=personal');
  }
}
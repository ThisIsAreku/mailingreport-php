<?php

namespace Mgrt\Model;

use Mgrt\Model\BaseModel;

class Account extends BaseModel
{
    protected $id;
    protected $company;
    protected $address_street;
    protected $address_city;
    protected $address_zipcode;
    protected $address_country;
    protected $currency;
    protected $timezone;
    protected $credits;
    protected $plan_type;
}

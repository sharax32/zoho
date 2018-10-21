<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection ;
use GuzzleHttp\Client;

class Task
{
public $status='Test Status';
public $delegate=false;
public $approve=false;
public $reject=false;
public $resubmitl=false;
public $description='Test Descrition';
public $currency_symbol='руб.';
public $duedate='2018-10-20';
public $priority='Low';
public $editable=true;
public $subject='Test Api';
public $SendNotificationEmail=false;

}

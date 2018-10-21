<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal
{
public $description='Test description';
public $CurrencySymbol='руб.';
public $ClosingDate='2018-10-19';
public $LeadConversionTime=null;
public $ProcessFlow=false;
public $DealName="Test Api Deal";
public $ExpectedRevenue=null;
public $OverallSalesDuration=0;
public $Stage='Text Stage';
public $AccountName=['name'=>'King','id'=>'3610203000000186135'];
public $approved=true;
public $delegate=false;
public $approve=false;
public $reject=false;
public $resubmit=false;
public $Amount=1500;
public $followed=false;
public $Probability=50;
public $NextStep=null;
public $editable=true;
public $Type='Test Type';
public $Lead_Source='Реклама';

}

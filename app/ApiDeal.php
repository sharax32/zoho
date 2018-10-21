<?php

namespace App;
use Config;
use App\Deal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection ;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiDeal extends Collection
{
    //
    public $id;
    public $response;
    public $message;

    public function __construct(Deal $deal){
        $array = [
            "Description" => $deal->description,
            '$currency_symbol' => $deal->CurrencySymbol,
            "Closing_Date" => $deal->ClosingDate,
            "Lead_Conversion_Time" => $deal->LeadConversionTime,
            '$process_flow' => $deal->ProcessFlow,
            "Deal_Name" => $deal->DealName,
            "Expected_Revenue" => $deal->ExpectedRevenue,
            "Overall_Sales_Duration" => $deal->OverallSalesDuration,
            "Stage" => $deal->Stage,
            "Account_Name" => $deal->AccountName,
            '$approved' => $deal->approved,
            '$approval'=> [
                "delegate"=>$deal->delegate,
                "approve" =>$deal->approve,
                "reject"  =>$deal->reject,
                "resubmit"=>$deal->resubmit,
            "Amount" => $deal->Amount,
            '$followed' => $deal->followed,
            "Probability" => $deal->Probability,
            "Next_Step" => $deal->NextStep,
            '$editable' => $deal->editable,
            "Type" => $deal->Type,
            "Lead_Source" => $deal->Lead_Source,
        ]];

        $arrayall=['data' =>[$array]];

        parent::__construct($arrayall);
    }

    public function create() {
        $client = new Client();
        $url=Config::get('extapi.url').'deals';
        $headers=Config::get('extapi.Auth');
        $body=$this->tojson();
        try {
            $this->response=$client->post( $url, ['headers' => $headers,'body' => $body]);
        } catch (RequestException $e) {
            echo $e;
        }
        if ($this->response->getStatusCode()==201)
        {
            $this->getId();
        }
        if ($this->response->getStatusCode()==202)
        {
            $this->getMessage();
            return $this->message;

        }

    }

    protected function getMessage()
    {
        $data=json_decode($this->response->getBody());
        $this->message=$data->data[0]->code;
    }

    protected function getId()
    {
        $data=json_decode($this->response->getBody());
        $this->id=$data->data[0]->details->id;
    }

}

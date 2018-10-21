<?php

namespace App;
use Config;
use App\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection ;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiTask extends Collection
{
    public $id;
    public $response;
    public $message;

    public function __construct(Task $task,$id=null){
        $array=[
            'Status'=> $task->status,
            '$approval'=> [
                "delegate"=>$task->delegate,
                "approve" =>$task->approve,
                "reject"  =>$task->approve,
                "resubmit"=>$task->reject],
            "Description"=> $task->description,
            '$currency_symbol'=> $task->currency_symbol,
            "Due_Date"=> $task->duedate,
            "Priority"=> $task->priority,
            '$editable'=> $task->editable,
            "Subject"=> $task->subject,
            "Send_Notification_Email"=> $task->SendNotificationEmail,
        ];
        $arraydeal=['$se_module'=> "Deals",
            "What_Id"=> [
                "id"=> $id ]];
        if(!is_null($id)) {
            $arrayall=['data' =>[$array + $arraydeal]];
        } else  $arrayall=['data' =>[$array]];

        parent::__construct($arrayall);
    }

    public function create() {
        $client = new Client();
        $url=Config::get('extapi.url').'tasks';
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

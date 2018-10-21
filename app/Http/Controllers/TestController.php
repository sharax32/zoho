<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Deal;
use App\ApiDeal;
use App\ApiTask;

class TestController extends Controller
{
    //
    public function index()
    {

        $dataDeal=new Deal();

        $deal=new ApiDeal($dataDeal);

        $deal->create();

        $dataTask=new Task();

        $task=new ApiTask($dataTask,$deal->id);

        $task->create();

    }
}

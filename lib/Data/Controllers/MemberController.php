<?php

namespace Lib\Data\Controllers;

use Lib\Data\Enums\SortEnum;
use Lib\Data\Model\MemberModel;
use Lib\Presentation\HomePage;

class MemberController {
    public function index()
    {
        return (new HomePage())->documentation();
    }

    public function read() 
    {
        header('Content-Type: application/json; charset=utf-8');

        $model = new MemberModel();        
        $data = $model->all();

        if(isset($_GET['sort'])){
            $sortReq = strtolower($_GET['sort']);

            $data = $model->sortByAge($data, $sortReq);
        }

        if(isset($_GET['male'])){
            $genderReq = strtolower($_GET['male']);
            
            $data = $model->filterGender($data, filter_var($genderReq, FILTER_VALIDATE_BOOLEAN));
        }

        if(isset($_GET['party'])){
            $partyReq = strtolower($_GET['party']);

            $data = $model->filterParty($data, $partyReq);
        }

        echo json_encode($data);
    }
}
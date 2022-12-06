<?php

namespace Lib\Controllers;

use Lib\Enums\SortEnum;
use Lib\Models\MemberModel;


class MemberController {
    public function read(SortEnum $sort = null, bool $male = null, string $party = null) 
    {
        header('Content-Type: application/json; charset=utf-8');

        $model = new MemberModel();        
        $data = $model->all();

        if(!is_null($sort)){
            $data = $model->sortByAge($data, $sort);
        }

        if(!is_null($male)){
            $data = $model->filterGender($data, $male);
        }

        if(!is_null($party)){
            $data = $model->filterParty($data, $party);
        }

        echo json_encode($data);
    }
}
<?php

namespace Lib\Data\Model;

use DateTime;
use Exception;

class MemberModel {

    /**
     * URL address of json file
     */
    private const URL = 'https://just-luka.github.io/data/germany24th_federal_members.json';

    /**
     * Returns all data from repository
     */
    public function all()
    {
        $data = $this->repository();

        return $data;
    }

    /**
     * Returns only specific party members
     */
    public function filterParty(array $arr, $party)
    {
        $newArr = [];
        foreach ($arr as $val)
        {
            if(strtolower($val->party) === $party){
                array_push($newArr, $val);
            }
        }

        return $newArr;
    }

    /**
     * Returns only specifc Gender, in this case Male or Female
     */
    public function filterGender(array $arr, bool $male)
    {
        $newArr = [];
        foreach ($arr as $val)
        {
            if($val->male === $male){
                array_push($newArr, $val);
            }
        }

        return $newArr;
    }

    /**
     * Returns sorted data, can be ASC or DESC
     */
    public function sortByAge(array $arr, string $orderBy)
    {
        if($orderBy === 'asc'){
            usort($arr, fn($a, $b) => strcmp($a->age, $b->age));
        }

        if($orderBy === 'desc'){
            usort($arr, fn($a, $b) => strcmp($b->age, $a->age));
        }

        return $arr;
    }

    /**
     * Repository or Proxy method, bridge between client and data origin
     */
    private function repository()
    {
        $data = $this->data()->members;
        
        // add person age
        foreach ($data as $key)
        {
            $date = new DateTime($key->birthDate);
            $key->age = date('Y') - (int) $date->format('Y');
        }

        return $data;
    }

    /**
     * Method, responsible for reading json file.
     */
    private function data()
    {
        try{
            $content = file_get_contents(self::URL);
            if(!$content){
                throw new Exception('File not Found', 404);
            }
        }catch(Exception $e) {
            echo $e->getMessage();
            return http_response_code(404);
        }

        return json_decode($content);
    }
}
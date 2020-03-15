<?php
namespace App\library{
	class helper
	{
	    public static function categoryNameArr($id, $value, $arr)
	    {
	        $newDataArr = json_decode($arr, true);
	        foreach ($newDataArr as $data) 
	        {
	            $categoryNameArr[$data[$id]] = $data[$value];
	        }
	        return $categoryNameArr;
	    }
	}
}

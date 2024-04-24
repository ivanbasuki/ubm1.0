<?php
namespace App\Controllers;
use App\Config\Services;

class database extends BaseController{

    protected $forge;
    
    public function __construct(){
        $forge = \Config\Database::forge();
    }

	public function createDB($dbName=false){
			if($dbName == false)
			{ return echo 'Gagal'; }
			$forge->createDatabase($dbName,true);
		    return echo 'Berhasil';
	}
	
  


}

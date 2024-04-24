<?php

namespace App\Models;

use CodeIgniter\Model;

class Kalender_Model extends Model
{
    
    protected $bulan;
    protected $th;
    
    public function getBulan(){
        $bulan = [
            '01'=>'JANUARI',
            '02'=>'FEBRUARI',
            '03'=>'MARET',
            '04'=>'APRIL',
            '05'=>'MEI',
            '06'=>'JUNI',
            '07'=>'JULI',
            '08'=>'AGUSTUS',
            '09'=>'SEPTEMBER',
            '10'=>'OKTOBER',
            '11'=>'NOPEMBER',
            '12'=>'DESEMBER'
        ];
    
        return $bulan;
    }

    public function konversiBulan($bulan = false)
    {
        $bl = '';
        switch($bulan)
        {
            case "JANUARI": $bl='01';
                            break;
            case "FEBRUARI": $bl='02';
                            break;
            case "MARET": $bl='03';
                            break;
            case "APRIL": $bl='04';
                            break;
            case "MEI": $bl='05';
                            break;
            case "JUNI": $bl='06';
                            break;
            case "JULI": $bl='07';
                            break;
            case "AGUSTUS": $bl='08';
                            break;
            case "SEPTEMBER": $bl='09';
                            break;
            case "OKTOBER": $bl='10';
                            break;
            case "NOPEMBER": $bl='11';
                            break;
            case "DESEMBER": $bl='12';
                            break;
        }
        return $bl;
    }

    public function getTahun($th){
        $tahun_array = array($th);
        for($a=1; $a < 5;$a++)
        {
           $thndec=$th-$a;
           array_push($tahun_array,$thndec);    
        }

        return $tahun_array;
    }

  
}
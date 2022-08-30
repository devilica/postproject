<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Writer;
use App\Models\BlacklistUser;

class ExportController extends Controller
{
    public function blacklist(){


        // $encoder = (new CharsetConverter())->inputEncoding('utf-8')->outputEncoding('utf-32');
         $lists=BlacklistUser::orderBy('id', 'desc')->get();
 
         $csv = Writer::createFromFileObject(new \SplTempFileObject());
         //$csv->addFormatter($encoder);
 
         if($lists!=null){
             $csv->insertOne(['Firstname','Lastname', 'Birth date','Created at']);
         foreach ($lists as $list){
 
             $csv->insertOne([$list->firstname, $list->lastname, $list->birth_date, $list->created_at]);
         }
         }else {
             $csv->insertOne(['No Records Found']);
         }
 
        // $csv = chr(255) . chr(254) /* BOM */ . "sep=,\n" . mb_convert_encoding($csv, 'UTF-8', 'UTF-8');
 
         $csv->output('Blacklist_'.date('_d-m-Y-H-i').'.csv');
 
 
 
     }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Diffusion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'diffusion';

    public static function getNextID(){
        $lastID = self::max('id');
        $lasNumber = intval(substr($lastID, 3));
        $nextNumber = $lasNumber + 1 ;
        $nextID = 'DFU' .str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        return $nextID;
    }

    public static function getListDiffusionSociete(){
        return DB::select('select * from diffusion_societe');
    }

    public static function getListDiffusionClient(){
        return DB::select('select * from diffusion_client');
    }
    public static function insert($data){
        DB::table('diffusion')->insert([
            'id' => self::getNextID(),
            'idproprietaire'=> $data['idproprietaire'],
            'description'=> $data['description'],
            'quantite' => $data['quantite'],
            'prix_unitaire'=> $data['prix_unitaire'],
            'date' => $data['date']
        ]);
    }

    public static function getById($id){
        $result = DB::table('diffusion')->where('id', $id)->first();
        return $result;
    }
}

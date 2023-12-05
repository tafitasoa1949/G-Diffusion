<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Societe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'societe';

    public static function getNextID(){
        $lastID = self::max('id');
        $lasNumber = intval(substr($lastID, 3));
        $nextNumber = $lasNumber + 1 ;
        $nextID = 'STE' .str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        return $nextID;
    }

    public static function getList(){
        return DB::select('select * from societe');
    }
    public static function insert($data){
        DB::table('societe')->insert([
            'id' => self::getNextID(),
            'doit'=> $data['doit'],
            'nif'=> $data['nif'],
            'stat' => $data['stat'],
            'email'=> $data['email'],
            'adresse'=> $data['adresse'],
            'contact'=> $data['contact'],
            'responsable' => $data['responsable']
        ]);
    }
    public static function getById($id){
        $result = DB::table('societe')->where('id', $id)->first();
        return $result;
    }
    public static function supprimer($id){
        DB::select('delete from societe where id=?', [$id]);
    }
}

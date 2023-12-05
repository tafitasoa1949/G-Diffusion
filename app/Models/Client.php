<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'client_particulier';

    public static function getNextCNAPSID(){
        $lastID = self::max('id');
        $lasNumber = intval(substr($lastID, 3));
        $nextNumber = $lasNumber + 1 ;
        $nextID = 'CLT' .str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        return $nextID;
    }

    public static function getList(){
        return DB::select('select * from client_particulier');
    }
    public static function insert($data){
        DB::table('client_particulier')->insert([
            'id' => self::getNextCNAPSID(),
            'nom'=> $data['nom'],
            'prenoms'=> $data['prenoms'],
            'email'=> $data['email'],
            'adresse'=> $data['adresse'],
            'contact'=> $data['contact']
        ]);
    }
    public static function getById($id){
        $result = DB::table('client_particulier')->where('id', $id)->first();
        return $result;
    }
    public static function supprimer($id){
        DB::select('delete from client_particulier where id=?', [$id]);
    }
}

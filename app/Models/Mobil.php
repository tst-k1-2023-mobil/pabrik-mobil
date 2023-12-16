<?php
namespace App\Models;
use CodeIgniter\Model; 
class Mobil extends Model{
    protected $table = 'mobil';
    public function getDataMobil($id=false){
        if(!$id){
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }
}

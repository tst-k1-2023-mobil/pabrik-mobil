<?php
namespace App\Models;
use CodeIgniter\Model; class Mobil extends Model{
    protected $table = 'mobil';
    public function getDataMobil(){
        return $this->findAll();
    }
}

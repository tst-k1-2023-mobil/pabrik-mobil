<?php
namespace App\Models;
use CodeIgniter\Model; 
class Mobil extends Model{
    protected $table = 'mobil';
    protected $allowedFields = ['stok'];
    public function getDataMobil($id=false){
        if(!$id){
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }
    public function order($mobilId, $qty) {

        $oldStok = $this->find($mobilId)['stok'];
        $newStok = max($oldStok-$qty,0);

        $data = [
            'stok' => $newStok
        ];
        $this->update($mobilId,$data);

        return $oldStok-$newStok;
    }
}

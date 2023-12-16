<?php
namespace App\Models;
use CodeIgniter\Model; 
class Mobil extends Model{
    protected $table = 'mobil';
    protected $allowedFields = ['stok'];

    public function getDataMobil(){
        return $this->findAll();
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

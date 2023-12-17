<?php
namespace App\Models;
use CodeIgniter\Model; class Assembly extends Model{
    protected $table = 'assembly';
    protected $allowedFields = ['mobilId'];
    public function getAssemblyQueue(){
        return $this->orderBy('tglSelesai','desc')->limit(1)->findColumn('tglSelesai')[0];
    }
    public function order($mobilId, $qty) {
        $data = [
            'mobilId' => $mobilId
        ];
        for ($x = 0; $x < $qty; $x++) $this->insert($data);
        $id = $this->getInsertID();

        return $this->find($id);
    }
    public function getTanggalKirim($id){
        return $this->where(['id' => $id])->first();
    }
}

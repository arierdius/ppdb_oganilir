<?php

namespace App\Http\Livewire\Admin\ProfilSekolah;

use Livewire\Component;
use App\Models\Admin\Sekolah;
use Livewire\WithPagination;

class Index extends Component
{
    
    public $jenis_sekolah, $id_sekolah;
    
    public function render()
    {
        
        $sekolah = Sekolah::where('jenis_sekolah_id', $this->jenis_sekolah)->where('id', $this->id_sekolah)->paginate(10);
        
        if($this->jenis_sekolah == null){
            $data_sekolah = Sekolah::where('jenis_sekolah_id', 'NULL')->get();
        }else{
            $data_sekolah = Sekolah::where('jenis_sekolah_id', $this->jenis_sekolah)->get();
        }
        return view('livewire.admin.profil-sekolah.index', [
            'data_sekolah' => $data_sekolah,
            'sekolah' => $sekolah
        ]);
    }
}

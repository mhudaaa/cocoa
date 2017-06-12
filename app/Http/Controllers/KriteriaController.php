<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kriteria;
use App\Model\Subkriteria;

class KriteriaController extends Controller{
    
    public function index(){
    	$kriterias = Kriteria::all();
    	return view('kriteria', compact('kriterias'));
    }

    public function setKriteria(Request $request){
    	if ($request->nilai > 0 && $request->nilai <= 100) {
    		$data = $request->all();
            Kriteria::create($data);

            $this->hitungBobot();
            
    	} else{
    		echo "nilai tidak boleh lebih dari 100";
    	}
    	return redirect('/kriteria')->with('message', 'Kriteria berhasil ditambahkan.');
    }


    public function hitungBobot(){
    	$total = Kriteria::sum('nilai');
        $kriteria = Kriteria::orderBy('id_kriteria')->get();

        foreach ($kriteria as $row) {
        	$nilai = $row['nilai'];
        	$hitungbobot = ($nilai / $total)*100;
         	$hitung = number_format($hitungbobot,16);
         	$normalisasibobot = $hitung / 100;
         	$normalisasi = number_format($normalisasibobot,16);
         	$this->updateBobot($hitung, $nilai);
         	$this->updateNormalisasi($normalisasi, $nilai);
        }
        return $nilai;
    }
    public function updateBobot($data, $where){
    	$result = Kriteria::where('nilai', $where)->update(['bobot' => $data]);
    	return $result;
    }

    public function updateNormalisasi($data, $where){
    	$result = Kriteria::where('nilai', $where)->update(['normalisasi' => $data]);
    	return $result;
    }

    public function subkriteria($id){
    	$kriteria 	= Kriteria::find($id);
    	$subs 		= Subkriteria::where("id_kriteria", "=", $id)->get();
    	return view('subkriteria', compact('kriteria', 'subs'));
    }

    public function hapusKriteria($id){
        $kriteria = Kriteria::where('id_kriteria', $id)->delete();
        $this->hitungBobot();
        return redirect('kriteria')->with('message', 'Data berhasil dihapus.');
    }

    public function viewTambahSubkriteria($id){
    	$kriteria 	= Kriteria::find($id);
    	return view('tambah-subkriteria', compact('kriteria'));	
    }

    public function setSubkriteria(Request $request){
    	$id_kriteria 		= $request->id_kriteria;
    	$nilai_subkriteria 	= $request->nilai_subkriteria;
    	$nilai_awal 		= $request->nilai_awal;
    	$nilai_akhir 		= $request->nilai_akhir;

    	$subs = Subkriteria::where('id_kriteria', $id_kriteria)->get();
    	$jmlSub = Subkriteria::where('id_kriteria', $id_kriteria)->count();
    	$nilai;

    	for ($i=0; $i < $jmlSub; $i++) { 
    		$nilai[$i] = $subs[$i]->nilai_subkriteria;
    	}

    	$min = min($nilai);
    	$max = max($nilai);

    	// Hitung utility
    	$utility = ($nilai_subkriteria - $min) / ($max - $min);
    	
    	// Input subkriteria
    	$dataSub = new Subkriteria();
    	$dataSub->id_kriteria 	= $id_kriteria;
    	$dataSub->subkriteria 	= $request->subkriteria;
    	$dataSub->nilai_awal 	= $nilai_awal;
    	$dataSub->nilai_akhir 	= $nilai_akhir;
    	$dataSub->nilai_subkriteria = $nilai_subkriteria;
    	$dataSub->utility = $utility;
    	$dataSub->save();

    	return redirect('subkriteria/get/'."$id_kriteria")->with('message', 'Data berhasil dihapus.');
    }

    
}
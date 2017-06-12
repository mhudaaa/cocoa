<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Panen;
use App\Model\Kriteria;
use App\Model\Subkriteria;
use App\Model\RincianPanen;
use App\Model\Mutu;

class PengujiController extends Controller{
    
    // Dashboard
    public function index(){
    	$panens = Panen::offset(0)->limit(2)->orderBy('tgl_uji', 'desc')->get();
    	$kriterias = Kriteria::offset(0)->limit(2)->orderBy('id_kriteria', 'desc')->get();
    	return view('penguji/dashboard', compact('panens', 'kriterias'));
    }

    // Daftar panen
    public function panen(){
    	$panens = Panen::all();
    	return view('penguji/mutu-panen', compact('panens'));
    }

    public function viewTambahPanen(){
        $kriterias = Kriteria::all();
        $subs = Subkriteria::all();
        return view('penguji/tambah-mutu-panen', compact('kriterias', 'subs'));
    }

    public function setMutuPanen(Request $request){

    	$getNormalisasi = Kriteria::select('normalisasi')->get();
    	$getMutu		= Mutu::select('nilaimutu')->get();

    	$hasil = 0;
    	$util = array();

    	// Cari jumlah kriteria
        $jmlKriteria = Kriteria::count();
        for ($i=1; $i <= $jmlKriteria; $i++) { 
        	$normalisasi 	= $getNormalisasi[$i-1]->normalisasi;
        	$utility		= $request->$i;
        	$nsementara		= $normalisasi * $utility;
        	$hasil 		   += ($nsementara);
        	$util[$i-1]		= $request->$i;
        }

        print_r($util);

        // Penentuan mutu
        $mutu = "III";

        if ($hasil >= $getMutu[0]->nilaimutu) {
            $mutu = "I";
        } elseif($hasil < $getMutu[0]->nilaimutu && $hasil >= $getMutu[1]->nilaimutu){
            $mutu = "II";
        } elseif($hasil < $getMutu[1]->nilaimutu && $hasil >= $getMutu[2]->nilaimutu){
            $mutu = "III";
        } elseif($hasil < $getMutu[2]->nilaimutu){
        	$mutu = "-";
        }

        // Cari jumlah kriteria
        $panen = [
            'berat' => $request->berat,
            'mutu' => $mutu,
        ];
        $subs = Panen::create($panen);

        // Tambah data rincian panen
        $i = 0;
        while($i < $jmlKriteria) {
            $rpanen = new RincianPanen();
            $rpanen->id_panen = $subs->id_panen;
            $rpanen->id_kriteria = ($i + 1);
            $rpanen->utility = $util[$i];
            $rpanen->save();
            $i++;
        }

    	return redirect('penguji/mutu-panen')->with('message', 'Data berhasil ditambahkan.');
    }

    public function rincianMutuPanen($id){
    	$jmlKriteria   = RincianPanen::where('id_panen', $id)->count();
        $panen         = Panen::find($id);
        $rincian       = RincianPanen::where("id_panen", "=", $id)->get();
        return view('penguji/rincian-mutu-panen', compact('panen', 'rincian', 'jmlKriteria'));
    }


    public function hapusMutuPanen($id){
        $panen         = Panen::where('id_panen', $id)->delete();
        $rincianPanen  = RincianPanen::where('id_panen', $id)->delete();
        return redirect('penguji/mutu-panen')->with('message', 'Data berhasil dihapus.');
    }

}
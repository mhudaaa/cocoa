<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Model\Panen;
use App\Model\Kriteria;
use App\Model\Subkriteria;
use App\Model\RincianPanen;

class PanenController extends Controller{
    
    public function index(){
    	$panens = Panen::all();
    	return view('mutu-panen', compact('panens'));
    }

    public function viewTambahPanen(){
        $kriterias = Kriteria::all();
        $subs = Subkriteria::all();
        return view('tambah-mutu-panen', compact('kriterias', 'subs'));
    }

    public function setMutuPanen(Request $request){
        $getNormalisasi = Kriteria::select('normalisasi')->get();
        
        // Simpan nilai normalisasi
        $normalisasi = [
            $getNormalisasi[0]->normalisasi,
            $getNormalisasi[1]->normalisasi,
            $getNormalisasi[2]->normalisasi,
            $getNormalisasi[3]->normalisasi,
            $getNormalisasi[4]->normalisasi
        ];

        // Ambil data rincian panen
        $rincianPanen = [
            $request->kadar_air,
            $request->kotoran,
            $request->serangga_hidup, 
            $request->berbau, 
            $request->benda_asing, 
        ];

        $nilaisub = [0,0,0,0,0];
        
        // Hitung kriteria
        for ($i=0; $i < sizeof($rincianPanen); $i++) {
            $x = $i;
            $jmlSub = Subkriteria::where("id_kriteria", "=", ++$x)->count();
            $dataSub = Subkriteria::where("id_kriteria", "=", $x)->get();
            for ($j=0; $j < $jmlSub; $j++) {
                if ($rincianPanen[$i] >= ($dataSub[$j]->nilai_awal) && $rincianPanen[$i] <= ($dataSub[$j]->nilai_akhir)) {
                    $nilaisub[$i] = $dataSub[$j]->utility;
                    break;
                }
            }    
        }

        $hitungNilai = [
            $nilaisub[0] * $normalisasi[0],
            $nilaisub[1] * $normalisasi[1],
            $nilaisub[2] * $normalisasi[2],
            $nilaisub[3] * $normalisasi[3],
            $nilaisub[4] * $normalisasi[4]
        ];

        // Hasil akhir perhitungan
        $hasil = array_sum($hitungNilai);

        // Penentuan mutu
        $mutu = "III";

        if ($hasil > 0.5) {
            $mutu = "I";
        } elseif($hasil > 0.2 && $hasil <= 0.5){
            $mutu = "II";
        } elseif($hasil <= 0.2){
            $mutu = "III";
        }

        // Cari jumlah kriteria
        $jmlKriteria = Kriteria::count();
        $panen = [
            'berat' => $request->berat,
            'mutu' => $mutu,
        ];
        $subs = Panen::create($panen);

        // Tambah data incian panen
        $i = 0;
        while($i < $jmlKriteria) {
            $rpanen = new RincianPanen();
            $rpanen->id_panen = $subs->id_panen;
            $rpanen->id_kriteria = ($i + 1);
            $rpanen->nilai = $rincianPanen[$i];
            $rpanen->save();
            $i++;
        }

    	return redirect('mutu-panen')->with('message', 'Data berhasil ditambahkan.');
    }

    public function rincianMutuPanen($id){
        $panen = Panen::find($id);
        $rincian = RincianPanen::where("id_panen", "=", $id)->get();
        return view('rincian-mutu-panen', compact('panen', 'rincian'));
    }


    public function hapusMutuPanen($id){
        $panen = Panen::where('id_panen', $id)->delete();
        $rincianPanen = RincianPanen::where('id_panen', $id)->delete();
        return redirect('mutu-panen')->with('message', 'Data berhasil dihapus.');
    }
}
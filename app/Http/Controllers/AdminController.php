<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Panen;
use App\Model\RincianPanen;
use App\Model\Kriteria;
use App\Model\Subkriteria;
use App\Model\Mutu;

class AdminController extends Controller{
    
    // Dashboard
    public function index(){
    	$panens = Panen::offset(0)->limit(2)->orderBy('tgl_uji', 'desc')->get();
    	$kriterias = Kriteria::offset(0)->limit(2)->orderBy('id_kriteria', 'desc')->get();
    	return view('admin/dashboard', compact('panens', 'kriterias'));
    }

    public function getMutuPanen(Request $request){
        $panens = Panen::all();
        return view('admin/mutu-panen', compact('panens'));
    }

    public function rincianMutuPanen($id){
        $jmlKriteria = RincianPanen::where('id_panen', $id)->count();
        $panen = Panen::find($id);
        $rincian = RincianPanen::where('id_panen', $id)->get();
        return view('admin/rincian-mutu-panen', compact('panen', 'rincian', 'jmlKriteria'));
    }

    public function getPenilaian(){
        $mutus = Mutu::all();
        return view('admin/penilaian', compact('mutus'));
    }

    public function getDataPenilaian($id){
        $mutu = Mutu::find($id);
        return view('admin/ubah-mutu', compact('mutu'));
    }

    public function setUpdatePenilaian(Request $request, $id){
        $mutu = Mutu::find($id);
        $mutu->nilaimutu = $request->nilaimutu;
        $mutu->save();
        return redirect('/admin/penilaian')->with('message', 'Mutu berhasil disimpan.');
    }

    // Daftar kriteria
    public function kriteria(){
    	$kriterias = Kriteria::all();
    	return view('admin/kriteria', compact('kriterias'));
    }

    // Tambah kriteria
    public function setKriteria(Request $request){
    	if ($request->nilai > 0 && $request->nilai <= 100) {
    		$data = $request->all();
            Kriteria::create($data);

            $this->hitungBobot();
            
    	} else{
    		echo "nilai tidak boleh lebih dari 100";
    	}
    	return redirect('/admin/kriteria')->with('message', 'Kriteria berhasil ditambahkan.');
    }


    public function viewUbahKriteria($id){
        $kriteria = Kriteria::find($id);
        return view('admin/ubah-kriteria', compact('kriteria'));
    }

    public function setUpdateKriteria(Request $request, $id){
        $kriteria = Kriteria::find($id);
        $kriteria->kriteria = $request->kriteria;
        $kriteria->nilai    = $request->nilai;
        $kriteria->save();
        return redirect('/admin/subkriteria')->with('message', 'Kriteria berhasil diubah.');
    }

    public function viewUbahSubkriteria($id){
        $subkriteria = Subkriteria::find($id);
        return view('admin/ubah-subkriteria', compact('subkriteria'));
    }

    public function setUpdateSubkriteria(Request $request, $id){
        $subkriteria = Subkriteria::find($id);
        $subkriteria->subkriteria = $request->subkriteria;
        $subkriteria->utility     = $request->utility;
        $subkriteria->save();
        return redirect('/admin/subkriteria/get/'.$request->id_kriteria)->with('message', 'Subkriteria berhasil diubah.');
    }

    // Fungsi hitung bobot
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

    // Update bobot
    public function updateBobot($data, $where){
    	$result = Kriteria::where('nilai', $where)->update(['bobot' => $data]);
    	return $result;
    }

    // Update normalisasi
    public function updateNormalisasi($data, $where){
    	$result = Kriteria::where('nilai', $where)->update(['normalisasi' => $data]);
    	return $result;
    }

    // Hapus kriteria
    public function hapusKriteria($id){
        $kriteria = Kriteria::where('id_kriteria', $id)->delete();
        $this->hitungBobot();
        return redirect('/admin/kriteria')->with('message', 'Data berhasil dihapus.');
    }

    // SUBKRITERIA
    // Daftar subkriteria
    public function subkriteria($id){
    	$kriteria 	= Kriteria::find($id);
    	$subs 		= Subkriteria::where("id_kriteria", "=", $id)->get();
    	return view('admin/subkriteria', compact('kriteria', 'subs'));
    }

    // Form tambah subkriteria
    public function viewTambahSubkriteria($id){
    	$kriteria 	= Kriteria::find($id);
    	return view('admin/tambah-subkriteria', compact('kriteria'));	
    }

    // Set Subkriteria
    public function setSubkriteria(Request $request){
        Subkriteria::create($request->all());
        return redirect('/admin/subkriteria/get/'.$request->id_kriteria)->with('message', 'Data berhasil ditambahkan.');

    }
}
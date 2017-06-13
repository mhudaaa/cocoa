<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Panen;
use App\Model\RincianPanen;
use App\Model\Kriteria;
use App\Model\Subkriteria;
use App\Model\Mutu;

class AdminController extends Controller{
    
    // Dashboard, menampilkan data panen dan kriteria
    public function index(){
    	$panens = Panen::offset(0)->limit(2)->orderBy('tgl_uji', 'desc')->get();
    	$kriterias = Kriteria::offset(0)->limit(2)->orderBy('id_kriteria', 'desc')->get();
    	return view('admin/dashboard', compact('panens', 'kriterias'));
    }

    // menampilkan mutu panen
    public function getMutuPanen(Request $request){
        $panens = Panen::all();
        return view('admin/mutu-panen', compact('panens'));
    }

    // menampilkan rincian mutu panen
    public function rincianMutuPanen($id){
        $jmlKriteria = RincianPanen::where('id_panen', $id)->count();
        $panen = Panen::find($id);
        $rincian = RincianPanen::where('id_panen', $id)->get();
        return view('admin/rincian-mutu-panen', compact('panen', 'rincian', 'jmlKriteria'));
    }

    // menampilkan halaman penilaian/mutu
    public function getPenilaian(){
        $mutus = Mutu::all();
        return view('admin/penilaian', compact('mutus'));
    }

    // menampilkan daftar kriteria
    public function kriteria(){
    	$kriterias = Kriteria::all();
        $totalBobot = Kriteria::sum('bobot');
    	return view('admin/kriteria', compact('kriterias', 'totalBobot'));
    }

    // Tambah kriteria
    public function setKriteria(Request $request){
    	if ($request->nilai > 0 && $request->nilai <= 100) {
    		$data = $request->all();
            Kriteria::create($data);

            // hitung ulang bobot tiap kriteria
            $this->hitungBobot();
            
    	} else{
    		echo "nilai tidak boleh lebih dari 100";
    	}
    	return redirect('/admin/kriteria')->with('message', 'Kriteria berhasil ditambahkan.');
    }

    // menampilkan form ubah kriteria 
    public function viewUbahKriteria($id){
        $kriteria = Kriteria::find($id);
        return view('admin/ubah-kriteria', compact('kriteria'));
    }

    // ubah data kriteria
    public function setUpdateKriteria(Request $request, $id){
        $kriteria = Kriteria::find($id);
        $kriteria->kriteria = $request->kriteria;
        $kriteria->nilai    = $request->nilai;
        $kriteria->save();

        // hitung ulang bobot tiap kriteria
        $this->hitungBobot();
        return redirect('/admin/kriteria')->with('message', 'Kriteria berhasil diubah.');
    }

    // menampilkan form ubah subkriteria
    public function viewUbahSubkriteria($id){
        $subkriteria = Subkriteria::find($id);
        return view('admin/ubah-subkriteria', compact('subkriteria'));
    }

    // ubah data subkriteria
    public function setUpdateSubkriteria(Request $request, $id){
        $subkriteria = Subkriteria::find($id);
        $subkriteria->subkriteria = $request->subkriteria;
        $subkriteria->utility     = $request->utility;
        $subkriteria->save();
        return redirect('/admin/subkriteria/get/'.$request->id_kriteria)->with('message', 'Subkriteria berhasil diubah.');
    }

    // hapus subkriteria
    public function hapusSubkriteria($idKriteria, $idSub){
        $kriteria = Subkriteria::where('id_subkriteria', $idSub)->delete();
        return redirect('/admin/subkriteria/get/'.$idKriteria)->with('message', 'Subkriteria berhasil dihapus.');
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

    // melihat nilai mutu
    public function viewNilaiMutu(){
        $kriterias = Kriteria::all();
        $subs = Subkriteria::all();
        return view('admin/nilai-mutu', compact('kriterias', 'subs'));
    }

    // mengatur nilaiMutu
    public function setNilaiMutu(Request $request){
        $jmlKriteria = Kriteria::count();
        $bobot       = Kriteria::select('bobotSAW')->get(); 
        $data1 = array();
        $data2 = array();
        $data3 = array();
        $hasil1 = 0;
        $hasil2 = 0;
        $hasil3 = 0;

        // Memasukkan data ke array
        for ($x=1; $x <= 3; $x++) { 
            for ($i=0; $i < $jmlKriteria; $i++) { 
                ${'data' . $x}[$i] = $request->{($i+1) . $x};
            }
        }

        // Menghitung hasil tiap data
        for ($i=1; $i <= 3; $i++) { 
            for ($j=0; $j < $jmlKriteria; $j++) { 
                ${'hasil'. $i} += (${'data'.$i}[$j] * $bobot[$j]->bobotSAW);
            }
        }
        
        // Pengurutan nilai mutu
        $hasil = [$hasil1 * 10, $hasil2 * 10, $hasil3 * 10];
        $simpanHasil = collect($hasil);
        $request->session()->put('mutu', $simpanHasil);

        rsort($hasil);
        $request->session()->put('sortdmutu', $hasil);

        // Ubah data penilaian mutu
        $i = 1;
        while ($i <= 3) {
            $mutu = Mutu::where('id_mutu', $i)->first();
            $mutu->nilaimutu = $hasil[$i-1];
            $mutu->save();
            $i++;
        }
        return redirect('/admin/penilaian/hasil');
    }
}
<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class RincianPanen extends Model{

    protected $table		= "tb_rincian_panen";
    protected $primaryKey 	= "id_rincian_panen";
    public $timestamps		= false;

    protected $fillable = [
		'id_panen', 'id_kriteria', 'nilai'
	];

	public function kriteria(){
		return $this->belongsTo(Kriteria::class, 'id_kriteria');
	}
}
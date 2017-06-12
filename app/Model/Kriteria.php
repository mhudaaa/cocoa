<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model{

    protected $table		= "tb_kriteria";
    protected $primaryKey 	= "id_kriteria";
    public $timestamps		= false;

    protected $fillable = [
		'kriteria', 'nilai', 'bobot', 'normalisasi', 'bobotWMA'
	];
}
<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model{

    protected $table		= "tb_panen";
    protected $primaryKey 	= "id_panen";
    public $timestamps		= false;

    protected $fillable = [
		'tgl_uji', 'berat', 'hasil', 'mutu'
	];

}
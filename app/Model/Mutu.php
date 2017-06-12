<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Mutu extends Model{

    protected $table		= "tb_mutu";
    protected $primaryKey 	= "id_mutu";
    public $timestamps		= false;

    protected $fillable = [
		'nilamutu', 'mutu'
	];
}
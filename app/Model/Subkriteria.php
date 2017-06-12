<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model{

    protected $table		= "tb_subkriteria";
    protected $primaryKey 	= "id_subkriteria";
    public $timestamps		= false;

    protected $fillable = [
		'id_kriteria', 'subkriteria', 'nilai', 'utility'
	];
}
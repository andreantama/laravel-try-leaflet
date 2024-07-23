<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
        protected $connection = 'mysql';
        protected $table = 'pengguna';

        protected $primaryKey = 'id';

        /*MESSASSIGMENT : KOLOM APA SAJA YANG WAJIB DIISI*/
        // protected $fillable = [];

        /*MESSASSIGMENT : KOLOM APA SAJA YANG TIDAK WAJIB DIISI*/
        protected $guarded = [];

        public function modelable()
        {
            return $this->morphTo(null, 'type', 'child_id');
        }

        /*Jika primary key tidak berifat increment value set to false*/
        //public $incrementing = false;

        /*Jika primary key tidak samadengan integer*/
        //protected $keyType = 'string';

        /*Jika created_at dan updated_at tidak ingin diset auto oleh elequent*/
        //public $timestamps = false;

        /*Jika ingin mengcustom format tanggal pada type data timestamps ke database*/
        //protected $dateFormat = 'U';

        /*Jika ingin mengcustome nama default created_at dan updated_at*/
        //const CREATED_AT = 'creation_date';
        //const UPDATED_AT = 'updated_date';

        /*Memberika nilai default pada masing2 kolom/atributes*/
        //protected $attributes = [
    //		'delayed' => false,
        //];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi'; // Specify the table name if different from Laravel's convention

    protected $fillable = [
        'peserta_id',
        'materi_id',
        'waktu_absen',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'waktu_absen' => 'datetime'
    ];

    // Relationship with Peserta
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    // Relationship with Materi
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    // Status options for forms
    public static function statusOptions()
    {
        return [
            'hadir' => 'Hadir',
            'terlambat' => 'Terlambat',
            'tidak_hadir' => 'Tidak Hadir'
        ];
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medico';

    protected $fillable = [
        'mascota_id',
        'fecha',
        'diagnostico',
        'tratamiento',
        'medicamentos',
        'veterinario',
    ];


    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
    
    
}

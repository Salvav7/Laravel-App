<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    use HasFactory;

    protected $table = 'adopcion';

    protected $fillable = [
        'mascota_id',
        'adopcion',
        'peso',
        'talla',
        'contacto',
    ];


    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

}

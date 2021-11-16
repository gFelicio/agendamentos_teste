<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Patient;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'schedules';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    // retorna o paciente do agendamento
    public function patient () {
        return $this->belongsTo('App\Models\Patient');
    }

    // retorna o médico/user do agendamento
    public function user () {
        return $this->belongsTo('App\Models\User');
    }
}

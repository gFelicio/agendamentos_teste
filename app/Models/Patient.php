<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schedule;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'patients';
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    // retorna agendamentos do paciente
    public function schedules () {
        return $this->belongsToMany('App\Models\Schedule');
    }

    // retorna médico que o inseriu no sistema
    public function user () {
        return $this->belongsTo('App\Models\User');
    }
}

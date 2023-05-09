<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'expected_evidence',
        'deadline',
        'created_by',
        'creation_date',
    ];

    protected $appends = ['objType'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_by'
    ];

    public $timestamps = false;

    public function responsible() {
        return $this->belongsToMany(User::class, 'risks_responsibles', 'rsk_id', 'u_id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getObjTypeAttribute() {
        return 'control';
    }
}

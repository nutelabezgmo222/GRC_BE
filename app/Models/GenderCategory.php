<?php

namespace App\Models;

use App\Models\Toy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenderCategory extends Model
{
    use HasFactory;

    public function toys() {
        return $this->hasMany(Toy::class, 'GenderCategory_id');
    }
}

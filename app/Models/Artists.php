<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{
    use HasFactory;

    protected $table = 'artists';
    protected $primaryKey = 'id';

    public function SetLists(){
        return $this->hasMany(SetLists::class);
    }
}

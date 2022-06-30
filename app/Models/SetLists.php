<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetLists extends Model
{
    use HasFactory;

    protected $table = 'setlists';
    protected $primaryKey = 'id';


    public function Artists(){
        return $this->belongsTo(Artists::class);
    }
}

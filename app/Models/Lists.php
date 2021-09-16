<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    public $table = 'lists';
    protected $primaryKey = 'file_id';
    public $incrementing = false;
}

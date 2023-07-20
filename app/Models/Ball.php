<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ball extends Model
{
    use HasFactory;

    protected $table = "balls";
    protected $primaryKey = "id";

    public $fillable = [
        'ball_name',
        'volume'
      ];
}

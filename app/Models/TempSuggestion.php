<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSuggestion extends Model
{
    use HasFactory;

    protected $table = "temp_suggestion";
    protected $primaryKey = "id";

    public $fillable = [
        'ball_id',
        'bucket_id',
        'quantity_added'
      ];
}

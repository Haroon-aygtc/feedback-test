<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

  protected $table = 'devices';


  protected $fillable = [
    'device_identifier',
    'department',
    'service',
  ];

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }
}

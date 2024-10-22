<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

  protected $table = 'answers';


  protected $fillable = [
    'question_id',
    'survey_id',
    'device_id',
    'answer_data',
    'locale',
  ];

  public function device()
  {
    return $this->belongsTo(Device::class);
  }

  public function question()
  {
    return $this->belongsTo(Question::class);
  }

}

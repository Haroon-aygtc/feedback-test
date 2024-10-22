<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

      protected $fillable = ['question_id'];

      // Define the table name
      protected $table = 'options';

      // Relationship with OptionTranslation
      public function translations()
      {
        return $this->hasMany(OptionTranslation::class);
      }

      // Relationship with Question
      public function question()
      {
        return $this->belongsTo(Question::class);
      }
}

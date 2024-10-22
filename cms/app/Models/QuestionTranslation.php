<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    use HasFactory;

      protected $fillable = ['question_id', 'locale', 'title', 'description', 'question_text'];

      // Define the table name
      protected $table = 'question_translations';

      // Relationship with Question
      public function question()
      {
        return $this->belongsTo(Question::class);
      }

      // Unique constraint
      protected $unique = ['question_id', 'locale'];

}

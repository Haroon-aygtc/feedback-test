<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

        protected $fillable = ['step_number', 'type'];

        // Define the table name
        protected $table = 'questions';

        // Relationship with QuestionTranslation
        public function translations()
        {
          return $this->hasMany(QuestionTranslation::class, 'question_id');
        }

        // Relationship with Option
        public function options()
        {
          return $this->hasMany(Option::class);
        }
}

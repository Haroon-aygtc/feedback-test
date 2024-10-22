<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionTranslation extends Model
{
    use HasFactory;

        protected $fillable = ['option_id', 'locale', 'option_text', 'image'];

        // Define the table name
        protected $table = 'option_translations';

        // Relationship with Option
        public function option()
        {
          return $this->belongsTo(Option::class);
        }

        // Unique constraint
        protected $unique = ['option_id', 'locale'];
}

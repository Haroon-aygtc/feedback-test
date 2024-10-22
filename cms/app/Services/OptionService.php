<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class OptionService
{
      public function createOption(Question $question, array $optionData)
      {
        $this->validateOptionData($optionData);

        return $question->options()->create();
      }

    public function attachOptionTranslations($option, $translations)
    {

      $option->translations()->createMany($translations);
    }

    private function validateOptionData(array $optionData): void
    {
      $validator = Validator::make($optionData, [
        'value' => 'required|array',
        'image' => 'nullable|array',
      ]);

      if ($validator->fails()) {
        throw new InvalidArgumentException('Invalid option data');
      }

      foreach ($optionData['value'] as $locale => $val) {
        if (empty($val)) {
          throw new InvalidArgumentException("Option text is required for locale: {$locale}");
        }
      }
    }
}

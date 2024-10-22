<?php

namespace App\Services;

use App\Helpers\TranslationHelper;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class QuestionService
{
        public function createQuestion(array $data)
        {
          $validatedData = $this->validateQuestionData($data);

          return Question::create([
            'step_number' => $validatedData['step_number'],
            'type' => $validatedData['type'],
          ]);
        }

        public function attachTranslations(Question $question, $translations)
        {
          $question->translations()->createMany($translations);
        }

        public function validateQuestionData(array $data)
        {
          $validator = Validator::make($data, [
            'step_number' => 'nullable|integer',
            'type' => 'required|string',
          ]);

          if ($validator->fails()) {
            throw new InvalidArgumentException('Invalid question data');
          }
          return $validator->validated();

        }
}

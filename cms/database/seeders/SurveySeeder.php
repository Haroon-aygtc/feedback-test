<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\OptionTranslation;
use App\Models\Question;
use App\Models\QuestionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SurveySeeder extends Seeder
{

  public function run(): void
  {
    $surveyData = json_decode(file_get_contents(storage_path('/surveyQuestions.json')), true);

    $imageMap = [
      'Very Bad' => 'sr1.png',
      'Bad' => 'sr2.png',
      'Average' => 'sr3.png',
      'Happy' => 'sr4.png',
      'سيء جدًا' => 'sr1.png',
      'سيء' => 'sr2.png',
      'متوسط' => 'sr3.png',
      'راضٍ' => 'sr4.png',
    ];

    foreach ($surveyData['en'] as $step) {
      // Create a new question
      $question = new Question();
      $question->step_number = $step['stepNumber'];
      $question->type = $step['type'];
      $question->hasTextarea = $step['hasTextarea'];
      $question->created_by = 1;
      $question->save();

      // Create translations for the question
      foreach (['en', 'ar'] as $locale) {
        $stepData = $surveyData[$locale][array_search($step['stepNumber'], array_column($surveyData[$locale], 'stepNumber'))];

        $translation = new QuestionTranslation();
        $translation->question_id = $question->id;
        $translation->locale = $locale;
        $translation->title = $stepData['title'];
        $translation->description = $stepData['description'];
        $translation->question_text = $stepData['question'];
        $translation->save();
      }

      // Create options and translations ONLY IF type is radio
      if ($step['type'] == 'radio') {
        foreach ($step['options'] as $index => $option) {
          $optionModel = new Option();
          $optionModel->question_id = $question->id;
          $optionModel->save();

          foreach (['en', 'ar'] as $locale) {
            $localeStepData = $surveyData[$locale][array_search($step['stepNumber'], array_column($surveyData[$locale], 'stepNumber'))];

            $optionTranslation = OptionTranslation::where('option_id', $optionModel->id)
              ->where('locale', $locale)
              ->first();

            if (!$optionTranslation) {
              $optionTranslation = new OptionTranslation();
              $optionTranslation->option_id = $optionModel->id;
              $optionTranslation->locale = $locale;
            }

            // Get the correct option value based on the locale
            $correctOption = collect($localeStepData['options'])->firstWhere('imgSrc', $option['imgSrc']);

            $optionTranslation->option_text = $correctOption['value'];

            $imageName = $imageMap[$correctOption['value']] ?? null;
            if ($imageName) {
              $imagePath = public_path('assets/emojis/' . $imageName);
              Storage::put('public/emojis/' . $imageName, file_get_contents($imagePath));
              $optionTranslation->image_path = 'assets/emojis/' . $imageName;
            }

            $optionTranslation->save();
          }
        }
      }
    }
  }

}

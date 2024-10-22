<?php


namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    private $locales = ['en', 'ar'];
    private $imageHandlerService;

  public function __construct(ImageHandlerService $imageHandlerService)
  {
    $this->imageHandlerService = $imageHandlerService;
  }

  public function prepareQuestionTranslations(array $data): array
  {
    $translations = [];

    foreach ($this->locales as $locale) {
      $translations[] = [
        'locale' => $locale,
        'title' => $data["title_{$locale}"] ?? null,
        'description' => $data["description_{$locale}"] ?? null,
        'question_text' => $data["question_{$locale}"] ?? null,
      ];
    }

    return $translations;
  }

  public function prepareOptionTranslations(array $optionData): array
  {
    $translations = [];

    foreach ($this->locales as $locale) {
      $imagePath = null;


      // Check if image data is available for the current locale
      if (isset($optionData['image'][$locale]) && !empty($optionData['image'][$locale])) {
        $imagePath = $this->imageHandlerService->uploadImage(
          $optionData['image'][$locale], // Directly pass the UploadedFile
          'options/images'
        );
      }

      $translations[] = [
        'locale' => $locale,
        'option_text' => $optionData['value'][$locale] ?? null,
        'image' => $imagePath,
      ];
    }

    return $translations;
  }
}

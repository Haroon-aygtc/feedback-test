<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class TranslationHelper
{
      public static function prepareTranslations(array $data, array $locales, array $fields, $imageDirectory = null): array
      {
        $translations = [];

        foreach ($locales as $locale) {
          $translationData = ['locale' => $locale];

          foreach ($fields as $field) {
            $translationData[$field] = $data["{$field}_{$locale}"] ?? '';
          }

          if ($imageDirectory && isset($data['image'][$locale])) {
            $translationData['image'] = ImageUploadHelper::uploadImage($data['image'][$locale], $imageDirectory);
          }

          $translations[] = $translationData;
        }

        return $translations;
      }


}

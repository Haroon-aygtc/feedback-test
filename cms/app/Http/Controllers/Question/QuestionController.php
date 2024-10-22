<?php

namespace App\Http\Controllers\Question;

use App\Helpers\ImageUploadHelper;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OptionTranslation;
use App\Models\Question;
use App\Models\QuestionTranslation;
use App\Services\OptionService;
use App\Services\QuestionService;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class QuestionController extends Controller
{


  private $translationService;
  private $questionService;
  private $optionService;

  public function __construct(TranslationService $translationService, QuestionService $questionService, OptionService $optionService)
  {
    $this->translationService = $translationService;
    $this->questionService = $questionService;
    $this->optionService = $optionService;
  }


  /**
   * Display a listing of the questions.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
   */
  public function index(Request $request)
  {
    $questions = Question::with(['translations', 'options.translations'])->paginate(10);
    return view('content.questions.list', compact('questions'));
  }

  public function create()
  {
    return view('content.questions.create');
  }

  public function save(Request $request)
  {
    $validatedData = $request->validate([
      'step-number' => 'required|array',
      'step-number.en' => 'required|numeric',
      'step-number.ar' => 'required|numeric',

      'title' => 'required|array',
      'title.en' => 'required|string|max:255',
      'title.ar' => 'required|string|max:255',

      'description' => 'required|array',
      'description.en' => 'required|string|max:500',
      'description.ar' => 'required|string|max:500',

      'question' => 'required|array',
      'question.en' => 'required|string|max:500',
      'question.ar' => 'required|string|max:500',

      'type' => 'required|string|in:radio,checkbox',

    ]);


    // Create a new question
    $question = new Question();
    $question->step_number = $validatedData['step-number']['en'];
    $question->type = $validatedData['type'];
    $question->save();

    // Create translations for the question
    foreach (['en', 'ar'] as $locale) {
      $translation = new QuestionTranslation();
      $translation->question_id = $question->id;
      $translation->locale = $locale;
      $translation->title = $validatedData['title'][$locale];
      $translation->description = $validatedData['description'][$locale];
      $translation->question_text = $validatedData['question'][$locale];
      $translation->save();
    }

    // Create options and their translations
    foreach ($request['options'] as $option) {
      $optionModel = new Option();
      $optionModel->question_id = $question->id;
      $optionModel->save();

      foreach (['en', 'ar'] as $locale) {
        $optionTranslation = new OptionTranslation();
        $optionTranslation->option_id = $optionModel->id;
        $optionTranslation->locale = $locale;
        $optionTranslation->option_text = $option['value'][$locale];

        // Save the image
        if (isset($option['image'][$locale])) {
          $image = $option['image'][$locale];
          $imageName = time() . '.' . $image->getClientOriginalExtension();
          $image->move(public_path('images'), $imageName);
          $optionTranslation->image = 'images/' . $imageName;
        }

        $optionTranslation->save();
      }
    }

    return response()->json(['message' => 'Question saved successfully!']);

  }



}

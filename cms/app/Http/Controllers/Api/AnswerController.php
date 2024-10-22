<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{
  public function submit(Request $request)
  {

      $validator = Validator::make($request->all(), [
        'survey.survey_id' => 'required|string',
        'survey.locale' => 'required|in:en,ar',
        'survey.questions' => 'required|array',
        // 'device.device_identifier' => 'required| exists:devices,device_identifier',
        // 'device.department' => 'nullable|string',
        // 'device.service' => 'nullable|string',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      $surveyId = $request->input('survey.survey_id');
      $locale = $request->input('survey.locale');
      $questions = $request->input('survey.questions');
      $deviceId = 'test-device';
      $department = 'Test Department';
      $service = 'Test Service';

      $device = Device::firstOrCreate([
        'device_identifier' => $deviceId,
      ], [
        'department' => $department,
        'service' => $service,
      ]);

      $answers = [];
      foreach ($questions as $questionId => $answerData) {
        $answers[] = [
          'question_id' => (int) str_replace('question_', '', $questionId),
          'survey_id' => $surveyId,
          'device_id' => $device->id,
          'answer_data' => json_encode($answerData), // Convert to JSON string
          'locale' => $locale,
        ];
      }
      Answer::insert($answers);

      return response()->json(['message' => 'Survey submitted successfully'], 201); // Inside the try block

    
  }
}

<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Device;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Analytics extends Controller
{
  public function index()
  {
      $user = Auth::user();

      try {
          // Eager load relationships for performance
          $questions = Question::with('translations', 'options')->get();

          // Get devices with answers, eager loading necessary relationships
          $devices = Device::with('answers.question.translations')
                           ->whereHas('answers')
                           ->get();

          return view('content.dashboard.dashboards-analytics', compact('user', 'questions', 'devices'));

      } catch (\Exception $e) {
          // Log the exception for debugging
          \Log::error($e);

          // Optionally flash an error message to the user
          session()->flash('error', 'An error occurred while fetching dashboard data.');

          return view('content.dashboard.dashboards-analytics', compact('user')); 
      }
  }

}

@extends('layouts/contentNavbarLayout')

@section('title', 'Questions List')

@section('content')

  <style>
    .hidden {
      display: none !important;
    }

     .table-hover tbody tr:hover {
       background-color: rgba(0,0,0,.075);
       transition: background-color 0.2s;
     }

    .btn-group .btn {
      padding: 0.375rem 0.75rem;
      border-radius: 0.25rem;
      transition: all 0.2s;
    }

    .btn-group .btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .modal-header {
      background: linear-gradient(45deg, #4e73df, #224abe);
    }

    .lang-toggle.active {
      background-color: #4e73df;
      color: white;
    }

    .list-group-item {
      border-left: 4px solid transparent;
      transition: all 0.2s;
    }

    .list-group-item:hover {
      border-left-color: #4e73df;
      background-color: #f8f9fc;
    }

    .table th {
      background-color: #f8f9fa;
      font-weight: 600;
      border-bottom: 2px solid #dee2e6;
    }

    .question-badge {
      padding: 0.35em 0.65em;
      font-size: 0.75em;
      font-weight: 500;
      border-radius: 0.25rem;
    }
  </style>
<!-- Striped Rows -->
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0 flex-grow-1">Questions List</h5>
    <div class="ml-auto">
      <a href="{{ route('admin.questions.create') }}" class="btn btn-primary" title="New Question">
        <i class="fa fa-plus"></i>
      </a>
      <button id="toggle-language" class="btn btn-primary ml-2" title="Switch to Arabic" data-language="en">
        <i class="fa fa-globe" id="language-icon"></i>
      </button>

    </div>
  </div>





  <div class="table-responsive text-nowrap">
    <table class="table table-striped table-hover" id="question-table">
      <thead>
      <tr id="en" data-question-id="en">
        <th data-question-id="text-en">Question Text</th>
        <th data-question-id="title-en">Title</th>
        <th data-question-id="description-en">Description</th>
        <th data-question-id="type-en">Type</th>
        <th data-question-id="actions-en">Actions</th>
      </tr>
      <tr id="ar" class="d-none" data-question-id="ar">
        <th data-question-id="text-ar">سؤال</th>
        <th data-question-id="title-ar">عنوان</th>
        <th data-question-id="description-ar">وصف</th>
        <th data-question-id="type-ar">نوع</th>
        <th data-question-id="actions-ar">إجراءات</th>
      </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="question-table-body">
      @foreach($questions as $question)
        <tr data-question-id="{{ $question->id }}-en">
          <td>{{ $question->translations->firstWhere('locale', 'en')->question_text }}</td>
          <td>{{ $question->translations->firstWhere('locale', 'en')->title }}</td>
          <td>{{ Str::limit($question->translations->firstWhere('locale', 'en')->description, 10) }}</td>
          <td>{{ $question->type }}</td>
          <td>
            <div class="btn-group btn-group-sm" role="group">
              @if ($question->type === 'radio')
                <button type="button" class="btn btn-outline-primary view-options-modal" data-toggle="modal" data-target="#option-modal-{{ $question->id }}" title="View Options">
                  <i class="fa fa-list-ul"></i>
                </button>
              @endif
              <button type="button" class="btn btn-outline-secondary view-question-modal" data-question-id="{{ $question->id }}" title="View Translations">
                <i class="fa fa-language"></i>
              </button>
            </div>
          </td>
        </tr>

        <tr class="d-none" data-question-id="{{ $question->id }}-ar">
          <td>{{ $question->translations->firstWhere('locale', 'ar')->question_text }}</td>
          <td>{{ $question->translations->firstWhere('locale', 'ar')->title }}</td>
          <td>{{ Str::limit($question->translations->firstWhere('locale', 'ar')->description, 10) }}</td>
          <td>{{ $question->type }}</td>
          <td>
            <div class="btn-group btn-group-sm" role="group">
              @if ($question->type === 'radio')
                <button type="button" class="btn btn-outline-primary view-options-modal" data-toggle="modal" data-target="#option-modal-{{ $question->id }}" title="عرض الخيارات">
                  <i class="fa fa-list-ul"></i>
                </button>
              @endif
              <button type="button" class="btn btn-outline-secondary view-question-modal" data-toggle="modal" data-target="#question-modal-{{ $question->id }}-ar" data-question-id="{{ $question->id }}" title="عرض الترجمات">
                <i class="fa fa-language"></i>
              </button>
            </div>
          </td>
        </tr>

        @if ($question->type === 'radio')
          <div class="modal fade" id="option-modal-{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="option-modal-label-{{ $question->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="option-modal-label-{{ $question->id }}">
                    <i class="fa fa-list-ul"></i> Options for Question #{{ $question->id }}
                  </h5>
                  <button type="button" class="close text-black" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

                <div class="modal-body">
                  <div class="text-center mb-3">
                    <div class="btn-group" role="group" aria-label="Language Toggle">
                      <button type="button" class="lang-toggle btn btn-outline-primary active" data-lang="en">English</button>
                      <button type="button" class="lang-toggle btn btn-outline-primary" data-lang="ar">Arabic</button>
                    </div>
                  </div>

                  <ul class="list-group">
                    @foreach ($question->options as $option)
                      <li class="list-group-item option-item" data-option-id="{{ $option->id }}">
                        <div class="lang-content">
                          <div class="lang-item en active">
                            <div class="row align-items-start mb-3">
                              <div class="col-md-6">
                                <p class="font-weight-bold">
                                  {{ $option->translations->firstWhere('locale', 'en')->option_text ?? 'No English text available' }}
                                </p>
                              </div>
                              <div class="col-md-6 text-right">
                                @if ($option->translations->firstWhere('locale', 'en')->image_path ?? '')
                                  <img src="{{ asset($option->translations->firstWhere('locale', 'en')->image_path) }}" alt="Option Image" class="img-fluid rounded shadow-sm" style="max-width: 150px;">
                                @else
                                  <span class="text-muted">No Image</span>
                                @endif
                              </div>
                            </div>
                          </div>

                          <div class="lang-item ar d-none">
                            <div class="row align-items-start mb-3">
                              <div class="col-md-6">
                                <p class="font-weight-bold">
                                  {{ $option->translations->firstWhere('locale', 'ar')->option_text ?? 'No Arabic text available' }}
                                </p>
                              </div>
                              <div class="col-md-6 text-right">
                                @if ($option->translations->firstWhere('locale', 'ar')->image_path ?? '')
                                  <img src="{{ asset($option->translations->firstWhere('locale', 'ar')->image_path) }}" alt="Option Image" class="img-fluid rounded shadow-sm" style="max-width: 150px;">
                                @else
                                  <span class="text-muted">لا توجد صورة</span>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        @endif

      @endforeach
      </tbody>
    </table>
    <div class="pagination-wrapper">
      {{ $questions->links() }}
    </div>
  </div>


</div>
<!--/ Striped Rows -->
  <!-- jQuery (required for Bootstrap 4 and lower) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Popper.js (for tooltip and popovers) -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

  <!-- Bootstrap 4 JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const viewQuestionButtons = document.querySelectorAll('.view-question-modal');
      const toggleLanguageButton = document.getElementById('toggle-language');
      const table = document.querySelector('table');
      const languageIcon = document.getElementById('language-icon');

      let currentLanguage = 'en';

      // Function to toggle table rows and headers based on language
      function toggleTableLanguage(language) {
        const otherLang = (language === 'en') ? 'ar' : 'en';

        document.querySelectorAll(`tr[data-question-id$="-${language}"]`).forEach(row => {
          row.classList.remove('d-none');
        });
        document.querySelectorAll(`tr[data-question-id$="-${otherLang}"]`).forEach(row => {
          row.classList.add('d-none');
        });

        document.getElementById(language).classList.remove('d-none');
        document.getElementById(otherLang).classList.add('d-none');

        table.style.direction = (language === 'en') ? 'ltr' : 'rtl';
      }

      // Function to toggle rows
      function toggleRows(language) {
        const englishRows = document.querySelectorAll('tr[data-question-id$="-en"]');
        const arabicRows = document.querySelectorAll('tr[data-question-id$="-ar"]');

        englishRows.forEach(row => {
          row.classList.toggle('d-none', language === 'ar');
        });

        arabicRows.forEach(row => {
          row.classList.toggle('d-none', language === 'en');
        });
      }

      // Event listener for the toggle language button
      toggleLanguageButton.addEventListener('click', function() {
        currentLanguage = (currentLanguage === 'en') ? 'ar' : 'en';
        toggleTableLanguage(currentLanguage);
        toggleRows(currentLanguage);

        // Update button text/icon
        this.dataset.language = currentLanguage;
        languageIcon.classList.toggle('fa-flag', currentLanguage === 'ar');
        languageIcon.classList.toggle('fa-globe', currentLanguage === 'en');
        this.title = (currentLanguage === 'en') ? 'Switch to Arabic' : 'Switch to English';
      });

      // Event listener for individual question buttons
      viewQuestionButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          const questionId = this.dataset.questionId;
          const englishRow = document.querySelector(`tr[data-question-id="${questionId}-en"]`);
          const arabicRow = document.querySelector(`tr[data-question-id="${questionId}-ar"]`);
          const arabicHeader = document.querySelector(`th[data-question-id="ar"]`);
          const englishHeader = document.querySelector(`th[data-question-id="en"]`);

          // Check if both rows exist
          if (englishRow && arabicRow) {
            if (englishRow.classList.contains('d-none')) {
              englishRow.classList.remove('d-none');
              arabicRow.classList.add('d-none');

              if (englishHeader) {
                englishHeader.classList.remove('d-none');
              }
              if (arabicHeader) {
                arabicHeader.classList.add('d-none');
              }
            } else {
              englishRow.classList.add('d-none');
              arabicRow.classList.remove('d-none');

              if (arabicHeader) {
                arabicHeader.classList.remove('d-none');
              }
              if (englishHeader) {
                englishHeader.classList.add ('d-none');
              }
            }
          } else {
            console.error(`Rows for question ID ${questionId} not found.`);
          }
        });
      });
    });
  </script>

@endsection

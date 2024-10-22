@extends('layouts/contentNavbarLayout')

@section('title', ' Create Question')

@section('content')
  <style>
    .invalid-feedback {
      color: red;
      font-size: 0.875em;
    }

    .image-preview {
      max-width: 100px;
      max-height: 100px;
      object-fit: cover;
    }


    .option-card {
      margin-bottom: 20px;
    }

    .card {
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background-color: #f8f9fa;
      border-bottom: 1px solid #ddd;
      padding: 10px 15px;
    }

    .card-body {
      padding: 15px;
    }

    .image-preview {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 5px;
      background-color: #f9f9f9;
      cursor: pointer;
      text-align: center;
    }

    .img-thumbnail {
      max-width: 100%;
      height: auto;
    }

    .modal-body img {
      max-width: 100%;
      height: auto;
    }

    .show-button {
      display: inline-flex !important;
    }

    .hide-button {
      display: none !important;

    }

  </style>
  <div class="container mt-4">
    <div class="form-group card">
      <!-- Navigation Tabs -->
      <ul class="nav nav-tabs" id="langTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="english-tab" data-bs-toggle="tab" href="#english" role="tab" aria-controls="english" aria-selected="true">English</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="arabic-tab" data-bs-toggle="tab" href="#arabic" role="tab" aria-controls="arabic" aria-selected="false">Arabic</a>
        </li>
      </ul>


      <!-- Tab Content -->
      <div class="tab-content" id="langTabContent">
        <!-- English Tab -->
        <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="english-tab">
          <div class="mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Question Form (English)</h5>
            </div>
            <div class="card-body">
              <form id="question-form-en" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="step-number-en">Step Number</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="step-number-en" name="step_number" placeholder="Step Number" />
                    <div id="step-number-en-error" class="invalid-feedback" style="display: none;">This field is required</div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="title-en">Title (English)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="title-en" name="title_en" placeholder="Question Title" />
                    <div id="title-en-error" class="invalid-feedback" style="display: none;">This field is required</div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="description-en">Description (English)</label>
                  <div class="col-sm-10">
                    <textarea id="description-en" class="form-control" name="description_en" placeholder="Question Description" rows="3"></textarea>
                    <div id="description-en-error" class="invalid-feedback" style="display: none;">This field is required</div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="question-en">Question (English)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="question-en" name="question_en" placeholder="Enter your question" />
                    <div id="question-en-error" class="invalid-feedback" style="display: none;">This field is required</div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="type-en">Type</label>
                  <div class="col-sm-10">
                    <select id="type-en" class="form-select" name="type" >
                      <option value="" disabled selected>Select Type</option>
                      <option value="radio">Radio</option>
                      <option value="rating">Rating</option>
                      <option value="contact">Contact</option>
                    </select>
                    <div id="type-en-error" class="invalid-feedback" style="display: none;">Please select a type</div>
                  </div>
                </div>
                <!-- Options Container Inside the Main Form -->
                <div id="options-container-en" class="mb-3">
                  <div class="row" id="options-row-en"></div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Arabic Tab -->
        <div class="tab-pane fade" id="arabic" role="tabpanel" aria-labelledby="arabic-tab">
          <div class="mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Question Form (Arabic)</h5>
            </div>
            <div class="card-body">
              <form id="question-form-ar" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="step-number-ar">Step Number</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="step-number-ar" name="step_number" placeholder="Step Number" readonly />
                    <div id="step-number-ar-error" class="invalid-feedback" style="display: none;">This field is required</div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="title-ar">Title (Arabic)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="title-ar" name="title_ar" placeholder="Question Title" />
                    <div id="title-ar-error" class="invalid-feedback" style="display: none;">This field is required</div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="description-ar">Description (Arabic)</label>
                  <div class="col-sm-10">
                    <textarea id="description-ar" class="form-control" name="description_ar" placeholder="Question Description" rows="3"></textarea>
                    <div id="description-ar-error" class="invalid-feedback" style="display: none;">This field is required</div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="question-ar">Question (Arabic)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="question-ar" name="question_ar" placeholder="Enter your question" />
                    <div id="question-ar-error" class="invalid-feedback" style="display: none;">This field is required</div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="type-ar">Type</label>
                  <div class="col-sm-10">
                    <select id="type-ar" class="form-select" name="type" disabled >
                      <option value="" disabled selected>Select Type</option>
                      <option value="radio">Radio</option>
                      <option value="rating">Rating</option>
                      <option value="contact">Contact</option>
                    </select>
                    <div id="type-ar-error" class="invalid-feedback" style="display: none;">Please select a type</div>
                  </div>
                </div>
                <!-- Options Container Inside the Main Form -->
                <div id="options-container-ar" class="mb-3">
                  <div class="row" id="options-row-ar"></div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer text-end">
          <button type="button" class="btn btn-primary" id="nextButton">Next</button>
          <button type="button" class="btn btn-secondary " id="prevButton" style="display: none !important;">Previous</button>
          <button type="submit" class="btn btn-primary " id="saveButton" style="display: none !important;">Save Question</button>
        </div>
      </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <img id="modal-image" class="img-fluid" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SweetAlert2 JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Your custom JavaScript -->

  <script>

    // Configuration
    const NUM_OPTIONS = 4;
    const REQUIRED_FIELDS = ['step-number', 'title', 'description', 'question'];

    // DOM Element References
    const domElements = {
      tabs: {
        en: document.getElementById('english-tab'),
        ar: document.getElementById('arabic-tab')
      },
      buttons: {
        next: document.getElementById('nextButton'),
        prev: document.getElementById('prevButton'),
        save: document.getElementById('saveButton')
      },
      forms: {
        en: document.getElementById('question-form-en'),
        ar: document.getElementById('question-form-ar')
      },
      inputs: {
        en: {
          stepNumber: document.getElementById('step-number-en'),
          type: document.getElementById('type-en')
        },
        ar: {
          stepNumber: document.getElementById('step-number-ar'),
          type: document.getElementById('type-ar')
        }
      },
      optionsContainers: {
        en: document.getElementById('options-row-en'),
        ar: document.getElementById('options-row-ar')
      }
    };

    // ================ Form Submission ================
    function submitQuestions ()  {
      const formData = new FormData();

      REQUIRED_FIELDS.forEach(field => {
        formData.append(field + '[en]', document.getElementById(`${field}-en`).value);
        formData.append(field + '[ar]', document.getElementById(`${field}-ar`).value);
      });

      formData.append('type', document.getElementById('type-en').value);

      if (document.getElementById('type-en').value === 'radio') {
        for (let i = 0; i < NUM_OPTIONS; i++) {
          formData.append(`options[${i}][value][en]`, document.getElementById(`option-en-${i}-value`).value);
          formData.append(`options[${i}][value][ar]`, document.getElementById(`option-ar-${i}-value`).value);

          const enImageInput = document.getElementById(`option-en-${i}-image`);
          const arImageInput = document.getElementById(`option-ar-${i}-image`);
          if (enImageInput.files[0]) formData.append(`options[${i}][image][en]`, enImageInput.files[0]);
          if (arImageInput.files[0]) formData.append(`options[${i}][image][ar]`, arImageInput.files[0]);
        }
      }

      fetch('{{ route('admin.questions.save') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
      })
        .then(response => {
          // 3. Handle Response
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Question saved successfully!',
            confirmButtonText: 'OK'
          });
        })
        .then((result) => {
          window.location.reload();
        })
        .catch(error => {
          console.error('Error:', error);
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred while saving the question.',
            confirmButtonText: 'OK'
          });
        });
    };

    // ================ Validation Functions ================
    function validateForm(language) {
      const typeSelect = document.getElementById(`type-${language}`);
      const type = typeSelect ? typeSelect.value : '';
      let isValid = true;

      ['step-number', 'title', 'description', 'question'].forEach(field => {
        const input = document.getElementById(`${field}-${language}`);
        const errorMessage = document.getElementById(`${field}-${language}-error`);

        if (input) {
          if (field === 'step-number') {
            const value = input.value.trim();
            const isInteger = Number.isInteger(Number(value));
            if (!isInteger || value === '') {
              input.classList.add('is-invalid');
              isValid = false;
              errorMessage.textContent = 'Please enter a valid integer';
              errorMessage.style.display = 'block';
            } else {
              input.classList.remove('is-invalid');
              errorMessage.textContent = '';
              errorMessage.style.display = 'none';
            }
          } else {
            if (!input.value.trim()) {
              input.classList.add('is-invalid');
              isValid = false;
              errorMessage.textContent = 'This field is required';
              errorMessage.style.display = 'block';
            } else {
              input.classList.remove('is-invalid');
              errorMessage.textContent = '';
              errorMessage.style.display = 'none';
            }
          }
        }
      });

      // Validate radio options and images
      if (type === 'radio') {
        for (let i = 0; i < 4; i++) {
          const optionInput = document.getElementById(`option-${language}-${i}-value`);
          const imageInput = document.getElementById(`option-${language}-${i}-image`);
          const previewImage = document.getElementById(`img-${language}-${i}`);

          if (optionInput) {
            if (!optionInput.value.trim()) {
              optionInput.classList.add('is-invalid');
              isValid = false;
            } else {
              optionInput.classList.remove('is-invalid');
            }
          }

          if (imageInput) {
            const isFileValid = imageInput.files.length > 0 || previewImage.src !== '';
            if (!isFileValid) {
              imageInput.classList.add('is-invalid');
              isValid = false;
            } else {
              imageInput.classList.remove('is-invalid');
            }
          }
        }
      }

      if (typeSelect) {
        if (type === '') {
          typeSelect.classList.add('is-invalid');
          isValid = false;
        } else {
          typeSelect.classList.remove('is-invalid');
        }
      }

      return isValid;
    }

    // ================ Data Manipulation Functions ================
    function copyDataToArabic() {
      const fieldsToCopy = ['type', 'step-number'];

      // Copy basic fields
      fieldsToCopy.forEach(field => {
        const englishValue = document.getElementById(`${field}-en`).value;
        const arabicInput = document.getElementById(`${field}-ar`);

        if (arabicInput) {
          arabicInput.value = englishValue;
        } else {
          console.warn(`Arabic input field not found for ${field}`);
        }
      });


      if (domElements.inputs.en.type.value === 'radio') {
        // Copy radio options and images
        for (let i = 0; i < NUM_OPTIONS; i++) {
          // Copy images
          const enImageInput = document.getElementById(`option-en-${i}-image`);
          const arImageInput = document.getElementById(`option-ar-${i}-image`);
          const enPreviewImage = document.getElementById(`img-en-${i}`);
          const arPreviewImage = document.getElementById(`img-ar-${i}`);

          if (enImageInput && arImageInput && enPreviewImage && arPreviewImage) {
            if (enImageInput.files.length > 0) {
              const file = enImageInput.files[0];
              const dataTransfer = new DataTransfer();
              dataTransfer.items.add(file);
              arImageInput.files = dataTransfer.files;
              arPreviewImage.src = URL.createObjectURL(file);
              arPreviewImage.style.display = 'block';
            }
          } else {
            console.warn(`Image input fields not found for index ${i}`);
          }
        }
      }
    }

    function generateRadioOptions(language) {
      const optionsContainer = domElements.optionsContainers[language];
      const optionsHtml = Array(NUM_OPTIONS)
        .fill(0)
        .map((_, index) => `
          <div class="col-md-6 mb-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Option ${index + 1}</h5>
              </div>
              <div class="card-body">
                <input type="text" class="form-control mb-2" placeholder="Option Value" name="options[${index}][value][${language}]" id="option-${language}-${index}-value" />
                <input type="file" class="form-control mb-2" accept="image/*" name="options[${index}][image][${language}]" id="option-${language}-${index}-image" onchange="previewImage(event, 'img-${language}-${index}')" />
                <div class="image-preview" onclick="showImageModal('img-${language}-${index}')">
                  <img id="img-${language}-${index}" class="img-thumbnail" style="display: none;" />
                </div>
              </div>
            </div>
          </div>
        `)
        .join('');

      optionsContainer.innerHTML = optionsHtml;
    }

    // ================ Helper Functions ================
    function previewImage(event, imgId) {
      const file = event.target.files[0];
      const imgElement = document.getElementById(imgId);
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          imgElement.src = e.target.result;
          imgElement.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        imgElement.src = '';
        imgElement.style.display = 'none';
      }
    }

    function showImageModal(imgId) {
      const imgElement = document.getElementById(imgId);
      const modalImage = document.getElementById('modal-image');
      modalImage.src = imgElement.src;
      $('#imagePreviewModal').modal('show');
    }

    // ================ Event Handlers ================
    function handleTabChange(event) {
      const clickedTabId = event.target.id;
      const activeTabId = document.querySelector('.nav-link.active').id;

      if (activeTabId === 'english-tab' && clickedTabId === 'arabic-tab') {
        if (!validateForm('en')) {
          event.preventDefault();
          Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please fill out all required fields in the English form.',
            confirmButtonText: 'OK'
          });
        }
      }

      setTimeout(() => updateButtonVisibility(), 100);
    }

    function handleButtonClick(button) {
      const activeTabId = document.querySelector('.nav-link.active').id;
      const languageCode = activeTabId === 'english-tab' ? 'en' : 'ar';

      if (button === domElements.buttons.next) {
        if (validateForm('en')) {
          copyDataToArabic();
          document.getElementById('arabic-tab').click();
          setTimeout(() => updateButtonVisibility(), 100);
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please fill out all required fields in the English form.',
            confirmButtonText: 'OK'
          });
        }
      } else if (button === domElements.buttons.prev) {
        document.getElementById('english-tab').click();
        setTimeout(() => updateButtonVisibility(), 100);
      } else if (button === domElements.buttons.save) {
        const englishValid = validateForm('en');
        const arabicValid = validateForm('ar');

        if (englishValid && arabicValid) {
          submitQuestions();
        } else {
          const failedLanguage = !englishValid ? 'English' : 'Arabic';
          Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: `Please fill out all required fields in the ${failedLanguage} form.`,
            confirmButtonText: 'OK'
          });
        }
      }
    }

    function updateButtonVisibility() {
      const activeTabId = document.querySelector('.nav-link.active').id;

      domElements.buttons.next.style.setProperty('display', 'none', 'important');
      domElements.buttons.prev.style.setProperty('display', 'none', 'important');
      domElements.buttons.save.style.setProperty('display', 'none', 'important');

      if (activeTabId === 'english-tab') {
        domElements.buttons.next.style.setProperty('display', 'inline-flex', 'important');
      } else if (activeTabId === 'arabic-tab') {
        domElements.buttons.prev.style.setProperty('display', 'inline-flex', 'important');
        domElements.buttons.save.style.setProperty('display', 'inline-flex', 'important');
      }
    }

    // ================ Initialization ================
    document.addEventListener('DOMContentLoaded', () => {
      // --- Event Listeners ---
      const tabs = document.querySelectorAll('.nav-link');
      tabs.forEach(tab => {
        tab.addEventListener('show.bs.tab', handleTabChange);
      });

      [domElements.buttons.next, domElements.buttons.prev, domElements.buttons.save].forEach(button => {
        button.addEventListener('click', () => handleButtonClick(button));
      });

      document.getElementById('type-en').addEventListener('change', function() {
        const selectedType = event.target.value;
        if (selectedType === 'radio') {
          generateRadioOptions('en');
          generateRadioOptions('ar');
        } else {
          domElements.optionsContainers.en.innerHTML = '';
          domElements.optionsContainers.ar.innerHTML = '';
        }
      });

      setTimeout(updateButtonVisibility, 100);

      // ... (Your other initialization code) ...
    });

  </script>







@endsection

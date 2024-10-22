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

// ================ Fetch Questions Function ================
// function fetchQuestions(page = 1) {
//   fetch('#' + `?page=${page}`)
//     .then(response => {
//       if (!response.ok) {
//         throw new Error('Network response was not ok');
//       }
//       const questions = data.data;
//       renderQuestionList(questions);
//     })
//     .then(data => {
//       const questions = data.data;
//       renderQuestionList(questions);
//     })
//     .catch(error => {
//
//     });
// };
{{--// {{ route('admin.questions.index') }}   ---    {{ route('admin.questions.updateStatus') }} --}}
// ================ Render Question List Function ================
// function renderQuestionList(data) {
//   const questionTableBodyElement = document.getElementById('question-table-body');
//   questionTableBodyElement.innerHTML = '';
//
//   data.data.forEach(question => {
//     const tableRow = document.createElement('tr');
//     tableRow.innerHTML = `
//   <td>${question.id}</td>
//   <td>
//     <button class="toggle-button" data-question-id="${question.id}">Toggle</button>
//     <div class="question-text" data-question-id="${question.id}">
//       <p>AR: ${question.text_ar}</p>
//       <p>EN: ${question.text_en}</p>
//     </div>
//   </td>
//   <td>${question.category.name}</td>
//   <td>${question.type.name}</td>
//   <td>${question.status ? 'Active' : 'Inactive'}</td>
//   <td>
//     <button class="status-button" data-question-id="${question.id}" data-status="${question.status ? 0 : 1}">${question.status ? 'Deactivate' : 'Activate'}</button>
//   </td>
// `;
//     questionTableBodyElement.appendChild(tableRow);
//   });
//
//   // Add event listeners for toggle buttons
//   document.querySelectorAll('.toggle-button').forEach(button => {
//     button.addEventListener('click', event => {
//       const questionId = event.target.dataset.questionId;
//       const questionTextElement = document.querySelector(`.question-text[data-question-id="${questionId}"]`);
//       questionTextElement.classList.toggle('hidden');
//     });
//   });
//
//   // Add event listeners for status buttons
//   document.querySelectorAll('.status-button').forEach(button => {
//     button.addEventListener('click', event => {
//       const questionId = event.target.dataset.questionId;
//       const status = event.target.dataset.status;
//       // Send AJAX request to update question status
//       fetch('', {
//         method: 'POST',
//         headers: {
//           'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({ id: questionId, status: status })
//       })
//         .then(response => {
//           if (!response.ok) {
//             throw new Error('Network response was not ok');
//           }
//           return response.json();
//         })
//         .then(data => {
//           // Update the question status in the table
//           const tableRow = document.querySelector(`tr[data-question-id="${questionId}"]`);
//           const statusCell = tableRow.querySelector('td:nth-child(5)');
//           statusCell.textContent = data.status ? 'Active' : 'Inactive';
//           event.target.textContent = data.status ? 'Deactivate' : 'Activate';
//         })
//         .catch(error => {
//           // ... (Your error handling with Swal) ...
//         });
//     });
//   });
//
//   // Render pagination links
//   renderPaginationLinks(data.meta);
// };

// ================ Render Pagination Links Function ================
// function renderPaginationLinks(meta) {
//   const paginationElement = document.getElementById('pagination');
//   paginationElement.innerHTML = '';
//
//   if (meta.prev_page_url) {
//     const prevLink = document.createElement('a');
//     prevLink.href = `javascript:fetchQuestions(${meta.current_page - 1})`;
//     prevLink.textContent = 'Previous';
//     paginationElement.appendChild(prevLink);
//   }
//
//   if (meta.next_page_url) {
//     const nextLink = document.createElement('a');
//     nextLink.href = `javascript:fetchQuestions(${meta.current_page + 1})`;
//     nextLink.textContent = 'Next';
//     paginationElement.appendChild(nextLink);
//   }
// };

// Call the fetchQuestions function when the page loads
// document.addEventListener('DOMContentLoaded', fetchQuestions);
</script>

document.addEventListener('DOMContentLoaded', () => {
  const modalToggleButtons = document.querySelectorAll('[data-modal-toggle="crud-modal"]');
  const crudModal = document.getElementById('crud-modal');

  if (crudModal) {
    modalToggleButtons.forEach(button => {
      button.addEventListener('click', () => {
        crudModal.classList.toggle('hidden');
        crudModal.setAttribute('aria-hidden', crudModal.classList.contains('hidden'));
        // Optional: Add logic to handle focus for accessibility
        if (!crudModal.classList.contains('hidden')) {
          const firstFocusableElement = crudModal.querySelector('button[type="button"], input, select, textarea, a[href]');
          if (firstFocusableElement) {
            firstFocusableElement.focus();
          }
        }
      });
    });

    // Close modal on outside click
    window.addEventListener('click', (event) => {
      if (event.target === crudModal) {
        crudModal.classList.add('hidden');
        crudModal.setAttribute('aria-hidden', true);
      }
    });

    // Close modal on Escape key press
    window.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        crudModal.classList.add('hidden');
        crudModal.setAttribute('aria-hidden', true);
      }
    });

    // Handle close button inside the modal
    const closeModalButton = crudModal.querySelector('[data-modal-toggle="crud-modal"]');
    if (closeModalButton) {
      closeModalButton.addEventListener('click', () => {
        crudModal.classList.add('hidden');
        crudModal.setAttribute('aria-hidden', true);
      });
    }
  }
});
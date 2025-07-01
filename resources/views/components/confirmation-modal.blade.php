<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <!-- Icon -->
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>

            <!-- Title -->
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                Confirm Action
            </h3>

            <!-- Message -->
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500" id="modal-message">
                    Are you sure you want to proceed? This action cannot be undone.
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-center space-x-4 mt-4">
                <button id="modal-cancel" type="button"
                        class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
                <button id="modal-confirm" type="button"
                        class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let confirmationCallback = null;

function showConfirmation(title, message, onConfirm, confirmText = 'Confirm', confirmClass = 'bg-red-600 hover:bg-red-700') {
    const modal = document.getElementById('confirmationModal');
    const modalTitle = document.getElementById('modal-title');
    const modalMessage = document.getElementById('modal-message');
    const confirmBtn = document.getElementById('modal-confirm');
    const cancelBtn = document.getElementById('modal-cancel');

    // Set content
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    confirmBtn.textContent = confirmText;

    // Update confirm button styling
    confirmBtn.className = `px-4 py-2 ${confirmClass} text-white text-base font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500`;

    // Store callback
    confirmationCallback = onConfirm;

    // Show modal
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function hideConfirmation() {
    const modal = document.getElementById('confirmationModal');
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    confirmationCallback = null;
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('confirmationModal');
    const confirmBtn = document.getElementById('modal-confirm');
    const cancelBtn = document.getElementById('modal-cancel');

    // Confirm button
    confirmBtn.addEventListener('click', function() {
        if (confirmationCallback) {
            confirmationCallback();
        }
        hideConfirmation();
    });

    // Cancel button
    cancelBtn.addEventListener('click', hideConfirmation);

    // Click outside modal to close
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            hideConfirmation();
        }
    });

    // ESC key to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            hideConfirmation();
        }
    });
});

// Helper functions for common confirmations
function confirmDelete(itemName, deleteUrl, itemType = 'item') {
    showConfirmation(
        'Confirm Deletion',
        `Are you sure you want to delete "${itemName}"? This action cannot be undone.`,
        function() {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;

            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);

            // Add method spoofing for DELETE
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        },
        'Delete',
        'bg-red-600 hover:bg-red-700'
    );
}

function confirmLogout() {
    showConfirmation(
        'Confirm Logout',
        'Are you sure you want to logout? You will need to sign in again to access your account.',
        function() {
            // Submit logout form
            document.getElementById('logout-form').submit();
        },
        'Logout',
        'bg-orange-600 hover:bg-orange-700'
    );
}
</script>


<!-- Toast Notification Container -->
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2">
    <!-- Success Toast Template -->
    <div id="success-toast-template" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 ease-in-out">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span class="toast-message font-medium"></span>
            <button class="ml-auto text-green-500 hover:text-green-700" onclick="removeToast(this.parentElement.parentElement)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Error Toast Template -->
    <div id="error-toast-template" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 ease-in-out">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            <span class="toast-message font-medium"></span>
            <button class="ml-auto text-red-500 hover:text-red-700" onclick="removeToast(this.parentElement.parentElement)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Warning Toast Template -->
    <div id="warning-toast-template" class="hidden bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 ease-in-out">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <span class="toast-message font-medium"></span>
            <button class="ml-auto text-yellow-500 hover:text-yellow-700" onclick="removeToast(this.parentElement.parentElement)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Info Toast Template -->
    <div id="info-toast-template" class="hidden bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 ease-in-out">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="toast-message font-medium"></span>
            <button class="ml-auto text-blue-500 hover:text-blue-700" onclick="removeToast(this.parentElement.parentElement)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
function showToast(type, message, duration = 5000) {
    const container = document.getElementById('toast-container');
    const template = document.getElementById(type + '-toast-template');

    if (!template) return;

    // Clone the template
    const toast = template.cloneNode(true);
    toast.id = 'toast-' + Date.now();
    toast.classList.remove('hidden');

    // Set the message
    const messageSpan = toast.querySelector('.toast-message');
    messageSpan.textContent = message;

    // Add to container with initial transform
    toast.style.transform = 'translateX(100%)';
    toast.style.opacity = '0';
    container.appendChild(toast);

    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
        toast.style.opacity = '1';
    }, 10);

    // Auto remove after duration
    setTimeout(() => {
        removeToast(toast);
    }, duration);
}

function removeToast(toast) {
    if (!toast) return;

    toast.style.transform = 'translateX(100%)';
    toast.style.opacity = '0';

    setTimeout(() => {
        if (toast.parentElement) {
            toast.parentElement.removeChild(toast);
        }
    }, 300);
}

// Show toasts based on session flash messages
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        showToast('success', '{{ session('success') }}');
    @endif

    @if(session('error'))
        showToast('error', '{{ session('error') }}');
    @endif

    @if(session('warning'))
        showToast('warning', '{{ session('warning') }}');
    @endif

    @if(session('info'))
        showToast('info', '{{ session('info') }}');
    @endif

    @if($errors->any())
        showToast('error', '{{ $errors->first() }}');
    @endif
});
</script>

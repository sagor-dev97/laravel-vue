<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import spaLayout from '@/layouts/spa/spaLayout.vue';
import MessageToast from '@/Components/Common/MessageToast.vue';
import { ref, onMounted, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const toastRef = ref<InstanceType<typeof MessageToast> | null>(null);

const name = ref('');
const email = ref('');
const message = ref('');
const submitting = ref(false);

// Server errors (from Inertia props)
const serverErrors = computed(() => page.props.errors || {});

// Client-side errors (local validation)
const clientErrors = ref<{ name?: string[]; email?: string[]; message?: string[] }>({});

// Combined errors for display (server + client)
const errors = computed(() => {
  const combined: any = { ...serverErrors.value };
  if (Object.keys(clientErrors.value).length > 0) {
    combined.name = clientErrors.value.name || serverErrors.value.name;
    combined.email = clientErrors.value.email || serverErrors.value.email;
    combined.message = clientErrors.value.message || serverErrors.value.message;
  }
  return combined;
});

// Simple client-side validation
const validateForm = () => {
  clientErrors.value = {};
  let isValid = true;

  if (!name.value.trim()) {
    clientErrors.value.name = ['Name is required.'];
    isValid = false;
  }

  if (!email.value.trim()) {
    clientErrors.value.email = ['Email is required.'];
    isValid = false;
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
    clientErrors.value.email = ['Please enter a valid email address.'];
    isValid = false;
  }

  if (!message.value.trim()) {
    clientErrors.value.message = ['Message is required.'];
    isValid = false;
  }

  return isValid;
};

// Handle flash/errors on mount (clear form + optional manual toast)
onMounted(() => {
  const flashSuccess = page.props.flash?.success;
  const hasErrors = Object.keys(errors.value).length > 0;

  if (flashSuccess) {
    // Clear form on success flash
    name.value = '';
    email.value = '';
    message.value = '';
    clientErrors.value = {};  // Clear client errors too
    // Manual toast trigger (fallback if onMounted in MessageToast misses)
    toastRef.value?.showToast('success', flashSuccess);
  } else if (hasErrors) {
    // For server errors, show toast (but not for client-side)
    const firstError = Object.values(serverErrors.value)[0]?.[0] || 'An error occurred.';
    toastRef.value?.showToast('error', firstError);
  }
});

// Submit: Client-side validation first, then server
async function submitForm() {
  // Clear previous client errors
  clientErrors.value = {};

  // Client-side validation (show inline errors only, no toast)
  if (!validateForm()) {
    submitting.value = false;
    return;  // Stop submission, no POST
  }

  submitting.value = true;
  console.log('Submitting data:', { name: name.value, email: email.value, message: message.value });  // Debug log

  try {
    await router.post(route('contact-us.store'), {
      name: name.value,
      email: email.value,
      message: message.value,
    });

    // On success (Inertia will handle redirect/flash)
    clientErrors.value = {};  // Clear client errors
    // Manual success toast/clear only if no redirect (edge case)
    toastRef.value?.showToast('success', 'Message sent successfully!');
    name.value = '';
    email.value = '';
    message.value = '';
  } catch (error: any) {
    // Inertia validation errors are handled via props (no toast here, as onMounted will catch)
    console.error('Submission error:', error);
  } finally {
    submitting.value = false;
  }
}
</script>

<template>
  <spaLayout title="Contactus">
    <Head title="Contact Us" />
    
    <!-- Toast: Auto-shows on mount -->
    <MessageToast
      ref="toastRef"
      position="top-right"
      duration="4000"
      @close="() => { /* Optional callback */ }"
    />
    
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900 text-black dark:text-white px-4">
      <h1 class="text-3xl font-bold mb-6">Contact Us</h1>
      <form @submit.prevent="submitForm" class="w-full max-w-lg bg-white dark:bg-gray-800 p-8 rounded shadow-md space-y-4">
        <div>
          <label class="block mb-1 font-medium" for="name">Name</label>
          <input
            id="name"
            v-model="name"
            type="text"
            :class="[
              'w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]',
              { 'border-red-500': errors.name }
            ]"
          />
          <span v-if="errors.name" class="text-red-500 text-sm">{{ errors.name[0] }}</span>
        </div>
        <div>
          <label class="block mb-1 font-medium" for="email">Email</label>
          <input
            id="email"
            v-model="email"
            type="email"
            :class="[
              'w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]',
              { 'border-red-500': errors.email }
            ]"
          />
          <span v-if="errors.email" class="text-red-500 text-sm">{{ errors.email[0] }}</span>
        </div>
        <div>
          <label class="block mb-1 font-medium" for="message">Message</label>
          <textarea
            id="message"
            v-model="message"
            rows="4"
            :class="[
              'w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]',
              { 'border-red-500': errors.message }
            ]"
          ></textarea>
          <span v-if="errors.message" class="text-red-500 text-sm">{{ errors.message[0] }}</span>
        </div>
        <button
          type="submit"
          :disabled="submitting"
          class="px-6 py-2 bg-[#FF2D20] text-white rounded hover:bg-[#e22c1f] transition disabled:opacity-50"
        >
          {{ submitting ? 'Sending...' : 'Send Message' }}
        </button>
      </form>
    </div>
  </spaLayout>
</template>
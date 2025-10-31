<script setup lang="ts">
import { ref } from 'vue';
import { Inertia } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';

// Form state
const name = ref('');
const email = ref('');
const message = ref('');

// Submit function
function submitForm() {
    Inertia.post('/contact-us', {
        name: name.value,
        email: email.value,
        message: message.value,
    }, {
        onSuccess: () => {
            name.value = '';
            email.value = '';
            message.value = '';
        },
        onError: (errors) => {
            console.log(errors); // show validation errors in console
        }
    });
}
</script>

<template>
  <Head title="Contact Us" />

  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900 text-black dark:text-white px-4">
    <h1 class="text-3xl font-bold mb-6">Contact Us</h1>

    <!-- Flash message -->
    <div v-if="$page.props.flash.success" class="text-green-500 mb-4">
      {{ $page.props.flash.success }}
    </div>

    <form @submit.prevent="submitForm" class="w-full max-w-lg bg-white dark:bg-gray-800 p-8 rounded shadow-md space-y-4">
      <div>
        <label for="name" class="block mb-1 font-medium">Name</label>
        <input id="name" v-model="name" type="text"
          class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]" />
      </div>

      <div>
        <label for="email" class="block mb-1 font-medium">Email</label>
        <input id="email" v-model="email" type="email"
          class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]" />
      </div>

      <div>
        <label for="message" class="block mb-1 font-medium">Message</label>
        <textarea id="message" v-model="message" rows="4"
          class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"></textarea>
      </div>

      <button type="submit"
        class="px-6 py-2 bg-[#FF2D20] text-white rounded hover:bg-[#e22c1f] transition">
        Send
      </button>
    </form>
  </div>
</template>

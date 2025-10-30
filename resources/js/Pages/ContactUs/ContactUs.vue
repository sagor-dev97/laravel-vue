<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const name = ref('');
const email = ref('');
const message = ref('');

function submitForm() {
    alert(`Name: ${name.value}\nEmail: ${email.value}\nMessage: ${message.value}`);
}
</script>

<template>
  <Head title="Contact Us" />

  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900 text-black dark:text-white px-4">
    <h1 class="text-3xl font-bold mb-6">Contact Us</h1>

    <form @submit.prevent="submitForm" class="w-full max-w-lg bg-white dark:bg-gray-800 p-8 rounded shadow-md space-y-4">
      <div>
        <label class="block mb-1 font-medium" for="name">Name</label>
        <input id="name" v-model="name" type="text" required
          class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]" />
      </div>

      <div>
        <label class="block mb-1 font-medium" for="email">Email</label>
        <input id="email" v-model="email" type="email" required
          class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]" />
      </div>

      <div>
        <label class="block mb-1 font-medium" for="message">Message</label>
        <textarea id="message" v-model="message" rows="4" required
          class="w-full px-4 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"></textarea>
      </div>

      <button type="submit"
        class="px-6 py-2 bg-[#FF2D20] text-white rounded hover:bg-[#e22c1f] transition">
        Send 
      </button>
    </form>
  </div>
</template>

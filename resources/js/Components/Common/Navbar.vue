<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

defineProps({
  canRegister: {
    type: Boolean,
    default: true,
  },
});
</script>

<template>
  <header class="fixed top-0 left-0 w-full bg-[#FDFDFC] dark:bg-[#0a5753] shadow-sm py-3 px-4 z-50">
    <nav class="relative flex items-center justify-between w-full">
      <!-- Left: Logo -->
      <div class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
        <Link :href="route('home')" class="hover:opacity-80 transition">MyWebsite</Link>
      </div>

      <!-- Center: Home / Contact -->
      <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center gap-6">
        <router-link to="/" class="text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#3E3E3A]">
          Home
        </router-link>
       <Link :href="route('contact-us')" class="text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#3E3E3A]">
    Contact Us
  </Link>

      </div>


      <!-- Right: Auth Links -->
      <div class="flex items-center gap-4 ml-auto">
        <Link :href="route('login')"
          class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
        Log in
        </Link>

        <Link v-if="canRegister" :href="route('register')"
          class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
        Register
        </Link>
      </div>
    </nav>
  </header>
</template>

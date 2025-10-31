<script setup>
import { Head } from '@inertiajs/vue3'
import Navbar from '@/Components/Common/Navbar.vue'

defineProps({
  title: {
    type: String,
    default: 'My App',
  },
})
</script>

<template>
  <Head :title="title" />

  <div class="flex flex-col min-h-screen bg-[#FDFDFC] dark:bg-[#0c0c0c]">
    <!-- Header -->
    <header class="fixed top-0 left-0 w-full bg-[#FDFDFC] dark:bg-[#0a5753] shadow-sm py-3 px-4 z-50">
      <Navbar :canRegister="true" />
    </header>

    <!-- Main content (page gets injected here) -->
    <main class="flex-1 mt-16">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
      © {{ new Date().getFullYear() }} - My App
    </footer>
  </div>
</template>

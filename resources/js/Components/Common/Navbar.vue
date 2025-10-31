<script setup lang="ts">
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

defineProps({
  canRegister: {
    type: Boolean,
    default: true,
  },
});

const isOpen = ref(false);

const toggleMenu = () => {
  isOpen.value = !isOpen.value;
};

const closeMenu = () => {
  isOpen.value = false;
};
</script>

<template>
  <header class="fixed top-0 left-0 w-full bg-[#FDFDFC] dark:bg-[#0a5753] shadow-sm py-3 px-4 z-50">
    <nav class="relative flex items-center justify-between w-full">

      <!-- Left: Logo -->
      <div class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
        <Link :href="route('home')" class="hover:opacity-80 transition">MyWebsite</Link>
      </div>

      <!-- Hamburger Menu Button for small screens -->
      <button
        @click="toggleMenu"
        class="lg:hidden text-2xl text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none"
        aria-label="Toggle menu"
      >
        &#9776;
      </button>
      <!-- Center: Home / Contact - visible on large screens -->
      <div class="hidden lg:flex absolute left-1/2 transform -translate-x-1/2 flex items-center gap-6">
        <router-link
          to="/"
          class="text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#3E3E3A]"
        >
          Home
        </router-link>
        <Link :href="route('project')"
         
          class="text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#3E3E3A]"
        >
          Project
        </Link>
        
        <Link
          :href="route('contact-us')"
          class="text-sm text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#3E3E3A]"
        >
          Contact Us
        </Link>
      </div>

      <!-- Right: Auth Links -->
      <div class="hidden lg:flex items-center gap-4 ml-auto">
        <Link
          :href="route('login')"
          class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
          Log in
        </Link>

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
          Register
        </Link>
      </div>

      <!-- Mobile menu - slide from left -->
      <transition name="slide">
        <div
          v-if="isOpen"
          class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-[#011615] shadow-lg z-50 p-6 flex flex-col"
        >
          <button
            @click="closeMenu"
            aria-label="Close menu"
            class="self-end text-2xl mb-4 text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none"
          >
            &times;
          </button>

          <nav class="flex flex-col gap-6 mt-4">
            <router-link
              to="/"
              class="text-base text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#3E3E3A]"
              @click="closeMenu"
            >
              Home
            </router-link>
            <Link
              :href="route('contact-us')"
              class="text-base text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#3E3E3A]"
              @click="closeMenu"
            >
              Contact Us
            </Link>
            <Link
              :href="route('login')"
              class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
              @click="closeMenu"
            >
              Log in
            </Link>
            <Link
              v-if="canRegister"
              :href="route('register')"
              class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
              @click="closeMenu"
            >
              Register
            </Link>
          </nav>
        </div>
      </transition>

      <!-- Overlay when menu open -->
      <div
        v-if="isOpen"
        @click="closeMenu"
        class="fixed inset-0 bg-black bg-opacity-40 z-40"
      ></div>
    </nav>
  </header>
</template>

<style scoped>
/* Slide animation for mobile menu */
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.3s ease;
}
.slide-enter-from,
.slide-leave-to {
  transform: translateX(-100%);
}
.slide-enter-to,
.slide-leave-from {
  transform: translateX(0%);
}
</style>

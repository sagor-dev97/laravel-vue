<script setup lang="ts">
import { ref } from "vue";

// Gallery images (you can store them in public/images)
const images = [
  "/images/IMAGE1.png",
  "/images/IMAGE2.png",
  "/images/IMAGE3.png",
  "/images/IMAGE4.png",
  "/images/IMAGE5.png",
  "/images/IMAGE6.png",
];

const selectedImage = ref<string | null>(null);

// Open full screen image
const openImage = (img: string) => {
  selectedImage.value = img;
};

// Close when clicking outside
const closeImage = () => {
  selectedImage.value = null;
};
</script>

<template>
  <section id="gallery" class="py-16 bg-gray-50 dark:bg-[#0a5753]">
    <div class="max-w-6xl mx-auto px-4">
      <!-- Section Title -->
      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
          Our Gallery
        </h2>
        <p class="text-gray-600 dark:text-gray-300">
          Explore our collection of beautiful images
        </p>
      </div>

      <!-- Gallery Grid -->
      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"
      >
        <div
          v-for="(img, index) in images"
          :key="index"
          class="group relative cursor-pointer overflow-hidden rounded-lg shadow-md hover:shadow-xl transition"
          @click="openImage(img)"
        >
          <img
            :src="img"
            alt="Gallery Image"
            class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500"
          />
          <div
            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition"
          ></div>
        </div>
      </div>
    </div>

    <!-- Fullscreen Modal -->
    <div
      v-if="selectedImage"
      class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50"
      @click.self="closeImage"
    >
      <img
        :src="selectedImage"
        alt="Full Image"
        class="max-w-[90%] max-h-[90%] rounded-lg shadow-2xl border border-white/20 transition-transform scale-100"
      />
      <button
        class="absolute top-6 right-6 text-white text-3xl font-bold hover:text-gray-300 transition"
        @click="closeImage"
      >
        &times;
      </button>
    </div>
  </section>
</template>

<style scoped>
/* Smooth appear/disappear animation for full-screen image */
[ v-cloak ] { display: none; }

img {
  user-select: none;
}

.fullscreen-enter-active,
.fullscreen-leave-active {
  transition: opacity 0.3s ease;
}
.fullscreen-enter-from,
.fullscreen-leave-to {
  opacity: 0;
}
</style>

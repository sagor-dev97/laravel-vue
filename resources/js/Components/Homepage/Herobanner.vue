<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";

const images = [
  "/caurosule/slide1.jpg",
  "/caurosule/slide2.jpg",
  "/caurosule/slide3.jpg",
];

const current = ref(0);

let interval: ReturnType<typeof setInterval>;

const nextSlide = () => {
  current.value = (current.value + 1) % images.length;
};

onMounted(() => {
  interval = setInterval(nextSlide, 4000); // 4s per slide
});

onUnmounted(() => {
  clearInterval(interval);
});
</script>

<template>
  <section class="relative w-full bg-gradient-to-r from-[#4ade80] to-[#22d3ee] text-white overflow-hidden">
    <!-- Carousel Background -->
    <div class="absolute inset-0">
      <transition-group name="fade" tag="div">
        <img
          v-for="(img, index) in images"
          :key="index"
          v-show="index === current"
          :src="img"
          class="absolute inset-0 w-full h-full object-cover"
          alt="Slide"
        />
      </transition-group>
      <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- Content -->
    <div
      class="relative max-w-6xl mx-auto px-6 py-32 flex flex-col lg:flex-row items-center justify-between"
    >
      <!-- Left Content -->
      <div class="lg:w-1/2 text-center lg:text-left">
        <h1 class="text-4xl lg:text-5xl font-bold mb-4 drop-shadow-lg">
          Welcome to MyWebsite
        </h1>
        <p class="text-lg lg:text-xl mb-6 drop-shadow-md">
          Discover amazing content, connect with others, and explore our features.
        </p>
        <div class="flex justify-center lg:justify-start gap-4">
          <Link
            :href="route('register')"
            class="bg-white text-[#1b1b18] px-6 py-3 rounded-lg font-semibold shadow-lg hover:bg-gray-200 transition"
          >
            Get Started
          </Link>
          <Link
            :href="route('contact-us')"
            class="bg-transparent border border-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#1b1b18] transition"
          >
            Contact Us
          </Link>
        </div>
      </div>

      <!-- Right Image / Illustration -->
      <div class="lg:w-1/2 mt-10 lg:mt-0 flex justify-center">
        <img
          src="https://images.unsplash.com/photo-1604079622501-6d7c820a6231?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
          alt="Banner Illustration"
          class="w-full max-w-md rounded-xl shadow-2xl relative z-10"
        />
      </div>
    </div>
  </section>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>

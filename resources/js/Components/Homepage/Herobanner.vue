<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";

const images = [
  "/images/IMAGE1.png",
  "/images/IMAGE2.png",
  "/images/IMAGE3.png",
];

const current = ref(0);
let interval: ReturnType<typeof setInterval>;

const nextSlide = () => {
  current.value = (current.value + 1) % images.length;
};

onMounted(() => {
  interval = setInterval(nextSlide, 4000);
});

onUnmounted(() => {
  clearInterval(interval);
});

// Ripple Effect
const ripples = ref<{ x: number; y: number; id: number }[]>([]);
let rippleId = 0;

const createRipple = (e: MouseEvent) => {
  const x = e.clientX;
  const y = e.clientY;
  const id = rippleId++;
  ripples.value.push({ x, y, id });

  // Remove ripple after animation
  setTimeout(() => {
    ripples.value = ripples.value.filter((r) => r.id !== id);
  }, 800);
};
</script>

<template>
  <section
    class="relative w-full bg-gradient-to-r from-[#4ade80] to-[#22d3ee] text-white overflow-hidden cursor-pointer"
    @click="createRipple"
  >
    <!-- Water Ripple Effect -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <span
        v-for="r in ripples"
        :key="r.id"
        class="ripple absolute rounded-full bg-white/40"
        :style="{
          top: r.y + 'px',
          left: r.x + 'px',
        }"
      ></span>
    </div>

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
          Discover amazing content, connect with others, and explore our
          features.
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

      <!-- Right Image -->
      <div class="lg:w-1/2 mt-10 lg:mt-0 flex justify-center">
        <img
          src="/images/IMAGE1.png"
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

/* 💧 Water Ripple Animation */
.ripple {
  width: 20px;
  height: 20px;
  transform: translate(-50%, -50%);
  animation: ripple 0.8s ease-out forwards;
  pointer-events: none;
  position: absolute;
  z-index: 50;
}

@keyframes ripple {
  from {
    transform: translate(-50%, -50%) scale(1);
    opacity: 0.6;
  }
  to {
    transform: translate(-50%, -50%) scale(25);
    opacity: 0;
  }
}
</style>

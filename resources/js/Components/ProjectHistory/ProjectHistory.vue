<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';

interface Project {
  id: number;
  title: string;
  description: string;
  image: string;
  category?: string;
  link?: string;
}

const props = defineProps<{
  projects: Project[];
  itemsPerPage?: number;  // Default: 3 for carousel view
  showPagination?: boolean;  // Default: true
}>();

const emit = defineEmits<{
  projectClick: [project: Project];
}>();

const itemsPerPage = computed(() => props.itemsPerPage || 3);
const currentPage = ref(1);
const totalPages = computed(() => Math.ceil(props.projects.length / itemsPerPage.value));

// Carousel state
const currentSlide = ref(0);
const slidesToShow = ref(1);  // Responsive: 1 on mobile, 3 on desktop
const slideWidth = computed(() => 100 / slidesToShow.value);

// Update slidesToShow on mount (simulate resize listener)
onMounted(() => {
  const updateSlides = () => {
    if (window.innerWidth < 768) slidesToShow.value = 1;
    else if (window.innerWidth < 1024) slidesToShow.value = 2;
    else slidesToShow.value = 3;
  };
  updateSlides();
  window.addEventListener('resize', updateSlides);
});

// Computed: Paginated projects for carousel
const paginatedProjects = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  return props.projects.slice(start, start + itemsPerPage.value);
});

// Carousel navigation
const nextSlide = () => {
  if (currentSlide.value < paginatedProjects.value.length - slidesToShow.value) {
    currentSlide.value += 1;
  } else {
    currentSlide.value = 0;  // Loop
  }
};

const prevSlide = () => {
  if (currentSlide.value > 0) {
    currentSlide.value -= 1;
  } else {
    currentSlide.value = paginatedProjects.value.length - slidesToShow.value;  // Loop
  }
};

// Pagination
const goToPage = (page: number) => {
  currentPage.value = page;
  currentSlide.value = 0;  // Reset slide on page change
};
</script>

<template>
  <div class="w-full max-w-6xl mx-auto p-4">
    <!-- Header -->
    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800 dark:text-gray-200">
      Our Projects
    </h2>

    <!-- Carousel Container -->
    <div class="relative overflow-hidden rounded-lg shadow-xl">
      <!-- Carousel Track -->
      <div class="flex transition-transform duration-500 ease-in-out" :style="{ transform: `translateX(-${currentSlide * slideWidth}%)` }">
        <div
          v-for="project in paginatedProjects"
          :key="project.id"
          class="flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-2"
        >
          <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden cursor-pointer mx-2"
            @click="$emit('projectClick', project)"
          >
            <!-- Image -->
            <div class="relative h-48 w-full bg-gradient-to-br from-blue-500 to-purple-600 overflow-hidden">
              <img
                :src="project.image"
                :alt="project.title"
                class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
              />
              <div v-if="project.category" class="absolute top-2 left-2 bg-black/50 text-white px-2 py-1 rounded text-xs">
                {{ project.category }}
              </div>
            </div>
            <!-- Content -->
            <div class="p-4">
              <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">{{ project.title }}</h3>
              <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm leading-relaxed">{{ project.description }}</p>
              <a v-if="project.link" :href="project.link" target="_blank" class="text-blue-500 hover:underline text-sm">
                View Project →
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Carousel Arrows -->
      <button
        @click="prevSlide"
        class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-800 rounded-full p-2 shadow-md transition-all duration-300"
      >
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button
        @click="nextSlide"
        class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-800 rounded-full p-2 shadow-md transition-all duration-300"
      >
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>

    <!-- Pagination (if enabled) -->
    <div v-if="showPagination" class="flex justify-center items-center mt-8 space-x-2">
      <button
        v-for="pageNum in totalPages"
        :key="pageNum"
        @click="goToPage(pageNum)"
        :class="[
          'px-3 py-2 rounded-full text-sm font-medium transition-colors duration-300',
          currentPage === pageNum
            ? 'bg-blue-500 text-white shadow-md'
            : 'bg-gray-200 dark:bg-gray-700 text-gray-600 hover:bg-gray-300 dark:hover:bg-gray-600'
        ]"
      >
        {{ pageNum }}
      </button>
    </div>
  </div>
</template>

<style scoped>
/* Ensure smooth scrolling on carousel */
.carousel-track {
  will-change: transform;
}
</style>
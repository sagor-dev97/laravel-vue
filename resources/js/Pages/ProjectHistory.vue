<script setup lang="ts">
import { ref, computed } from 'vue';
import spaLayout from '@/layouts/spa/spaLayout.vue';

// Dummy project data
const projects = ref([
  { id: 1, title: 'Project 1', description: 'Description 1', image: '/images/IMAGE1.png' },
  { id: 2, title: 'Project 2', description: 'Description 2', image: '/images/IMAGE2.png' },
  { id: 3, title: 'Project 3', description: 'Description 3', image: '/images/IMAGE3.png' },
  { id: 4, title: 'Project 4', description: 'Description 4', image: '/images/IMAGE4.png' },
  { id: 5, title: 'Project 5', description: 'Description 5', image: '/images/IMAGE5.png' },
  { id: 6, title: 'Project 6', description: 'Description 6', image: '/images/IMAGE6.png' },
  { id: 7, title: 'Project 7', description: 'Description 7', image: '/images/IMAGE7.png' },
  { id: 8, title: 'Project 8', description: 'Description 8', image: '/images/IMAGE8.png' },
]);

// Pagination
const currentPage = ref(1);
const perPage = 4;

const totalPages = computed(() => Math.ceil(projects.value.length / perPage));

const paginatedProjects = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return projects.value.slice(start, start + perPage);
});

function nextPage() {
  if (currentPage.value < totalPages.value) currentPage.value++;
}

function prevPage() {
  if (currentPage.value > 1) currentPage.value--;
}
</script>

<template>
    <spaLayout class="">
  <div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6 text-center">Projects</h2>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div v-for="project in paginatedProjects" :key="project.id" class="bg-white dark:bg-gray-800 rounded shadow p-4 hover:shadow-lg transition">
        <img :src="project.image" alt="" class="rounded mb-4 w-full h-40 object-cover">
        <h3 class="text-xl font-semibold mb-2">{{ project.title }}</h3>
        <p class="text-gray-600 dark:text-gray-300">{{ project.description }}</p>
      </div>
    </div>

    <!-- Pagination Controls -->
    <div class="flex justify-center mt-6 space-x-4">
      <button @click="prevPage" :disabled="currentPage === 1" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded disabled:opacity-50">Prev</button>
      <span class="px-4 py-2">{{ currentPage }} / {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded disabled:opacity-50">Next</button>
    </div>
  </div>
  </spaLayout>
</template>

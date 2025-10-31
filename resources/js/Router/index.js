// src/router/index.js (or .ts if using TypeScript)
import { createRouter, createWebHistory } from 'vue-router';
import ProjectHistory from '@/Components/ProjectHistory/ProjectHistory.vue';

const routes = [
 
  {
    path: '/projects',
    name: 'Projects',
    component: ProjectHistory,
  },

  // Add more routes as needed
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
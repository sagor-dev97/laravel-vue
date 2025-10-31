<!-- MessageToast.vue - Reusable Toast Component for Success/Error Messages -->
<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps<{
  position?: 'top-right' | 'top-left' | 'bottom-right' | 'bottom-left';  // Default: top-right
  duration?: number;  // Auto-hide duration in ms, default: 3000
}>();

const emit = defineEmits<{
  close: [];
}>();

const page = usePage();
const toast = ref({
  show: false,
  type: 'success' as 'success' | 'error',
  message: ''
});

// Computed for flash success/errors
const success = computed(() => page.props.flash?.success);
const errors = computed(() => page.props.errors || {});

// Show toast function
const showToast = (type: 'success' | 'error', msg: string) => {
  toast.value = { show: true, type, message: msg };
  setTimeout(() => {
    closeToast();
  }, props.duration || 3000);
};

// Close toast
const closeToast = () => {
  toast.value.show = false;
  emit('close');
};

// Auto-show on mount if flash/errors present
onMounted(() => {
  if (success.value) {
    showToast('success', success.value);
  } else if (Object.keys(errors.value).length > 0) {
    const firstError = Object.values(errors.value)[0]?.[0] || 'An error occurred.';
    showToast('error', firstError);
  }
});

// Expose methods for parent to trigger toasts
defineExpose({
  showToast,
  closeToast
});
</script>

<template>
  <Transition name="toast-slide">
    <div
      v-if="toast.show"
      :class="[
        'fixed z-50 max-w-sm p-4 rounded-lg shadow-lg border-l-4 transform transition-all duration-300 ease-in-out',
        // Position classes
        position === 'top-left' ? 'top-4 left-4' :
        position === 'top-right' ? 'top-4 right-4' :
        position === 'bottom-left' ? 'bottom-4 left-4' :
        'bottom-4 right-4',
        // Type-based styles
        toast.type === 'success' 
          ? 'bg-green-100 border-green-500 text-green-700' 
          : 'bg-red-100 border-red-500 text-red-700'
      ]"
      role="alert"
    >
      <div class="flex items-center justify-between">
        <p class="font-medium flex-1">{{ toast.message }}</p>
        <button
          @click="closeToast"
          class="ml-4 text-current opacity-70 hover:opacity-100 text-xl font-bold"
          aria-label="Close"
        >
          ×
        </button>
      </div>
    </div>
  </Transition>
</template>

<style scoped>
.toast-slide-enter-active,
.toast-slide-leave-active {
  transition: all 0.3s ease;
}
.toast-slide-enter-from,
.toast-slide-leave-to {
  transform: translateX(100%);
  opacity: 0;
}
</style>
<script setup>
import { ref } from 'vue'

const message = ref('This is Div 2')

function handleClick() {
  message.value = 'Button in Div 1 was clicked!'
}
</script>


 <template>
  <section class="relative w-full text-white overflow-hidden p-6">
    <div class="flex space-x-4">
      <!-- Left Div -->
      <div class="w-1/2 bg-white/20 p-4 rounded flex flex-col items-start">
        <h2 class="text-lg font-bold mb-2">Div 1</h2>
        <p class="mb-4">Hello from the first div!</p>
        <!-- Button -->
        <button
          @click="handleClick"
          class="bg-white text-green-600 font-semibold px-4 py-2 rounded hover:bg-white/80 transition"
        >
          Click Me
        </button>
      </div>

      <!-- Right Div -->
      <div class="w-1/2 bg-white/20 p-4 rounded flex flex-col items-start">
        <h2 class="text-lg font-bold mb-2">Div 2</h2>
        <p>{{ message }}</p>
      </div>
    </div>
  </section>
</template>




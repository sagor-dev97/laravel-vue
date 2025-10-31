<script setup>
import { Head } from '@inertiajs/vue3'
import HeroBanner from '@/Components/Homepage/Herobanner.vue'
import Div from '@/Components/Container/Div.vue'
import Aboutus from '@/Components/Aboutus/Aboutus.vue'
import GallaryImamge from '@/Components/GallaryImage/GallaryImamge.vue' 
import spaLayout from '@/layouts/spa/spaLayout.vue' 

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
})
</script>

<template>
  <spaLayout title="Welcome">
    <HeroBanner />

    <section class="mt-10 text-center">
      <!-- about us -->
      <h4>About us</h4>
      <Aboutus/>
      <Div/> 
    <!--Gallary Image  -->
     <GallaryImamge/>
    </section>
  </spaLayout>
</template>

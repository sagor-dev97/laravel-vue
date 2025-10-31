<template>
  <section id="about" class="py-20 bg-[#0a5753] text-white">
    <div class="container mx-auto px-6">
      <div class="section_title_1 text-left pb-10 wow animated slideInUp">
        <h2 class="text-4xl font-bold uppercase">
          <span class="block h-1 w-16 bg-white mb-3"></span>
          About Myself
        </h2>
        <p class="text-white/80 mt-2 max-w-2xl">
          Interdum a etiam sagittis vehicula porta. Massa felis eros quam blandit nulla dolor habitant.
          Ullamcorper quis ornare et proin pellentesque.
        </p>
      </div>

      <!-- About Content -->
      <div class="flex flex-col lg:flex-row items-start gap-10">
        <!-- Image -->
        <div class="lg:w-1/3 w-full">
          <div class="relative">
            <img
              src="/images/IMAGE1.png"
              alt="About Me"
              class="rounded-lg shadow-2xl w-full"
            />
            <div
              class="absolute inset-0 flex items-center justify-center bg-black/30 hover:bg-black/50 transition"
            >
              <a
                href="https://www.youtube.com/watch?v=U10h8rrPe6g"
                target="_blank"
                rel="noopener noreferrer"
                class="text-white text-4xl hover:scale-110 transition"
              >
                <i class="fa fa-play"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Text Content -->
        <div class="lg:w-2/3 w-full">
          <div class="myself wow animated fadeInLeft space-y-4">
            <p>
              Sodales iaculis est Scelerisque sociis magna dolor pulvinar magnis. Varius praesent suscipit.
              Donec morbi feugiat placerat gravida porttitor natoque nonummy parturient posuere. Magnis suspendisse
              parturient. Magna ultricies nostra nunc magna. Sodales etiam arcu suscipit, mollis. Aenean tempor eu
              ipsum nisi sociosqu lorem hymenaeos sapien. Aptent maecenas ac ante molestie habitant.
            </p>
            <p>
              Duis vulputate nisi nam sem penatibus parturient volutpat justo phasellus. Netus. Hac montes tempor
              lorem tempor tincidunt vehicula velit. Tellus. Class aenean leo elit maecenas. Vehicula sagittis.
              Curae; eget lacus. Fames neque diam elementum risus eleifend dui tortor netus turpis.
            </p>
          </div>

          <!-- Personal Info -->
          <div class="personal_info mt-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <ul class="space-y-2">
                <li>
                  <span class="text-[#c5f5e9] font-semibold">Name:</span> Austin Jackson
                </li>
                <li>
                  <span class="text-[#c5f5e9] font-semibold">Email:</span> yourdomainname@gmail.com
                </li>
                <li>
                  <span class="text-[#c5f5e9] font-semibold">Phone:</span> +00 61 700 800
                </li>
              </ul>

              <ul class="space-y-2">
                <li>
                  <span class="text-[#c5f5e9] font-semibold">Date of Birth:</span> 14 December 1993
                </li>
                <li>
                  <span class="text-[#c5f5e9] font-semibold">Blood Group:</span> A+
                </li>
                <li>
                  <span class="text-[#c5f5e9] font-semibold">Address:</span> Mouroubra WA 6472, Australia.
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
// No JS logic required for this static layout
</script>

<style scoped>
/* Optional: You can keep wow animation classes globally */
</style>

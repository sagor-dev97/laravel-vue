<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Common/Navbar.vue';
import HeroBanner from '@/Components/Homepage/Herobanner.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

// function handleImageError() {
//     document.getElementById('screenshot-container')?.classList.add('!hidden');
//     document.getElementById('docs-card')?.classList.add('!row-span-1');
//     document.getElementById('docs-card-content')?.classList.add('!flex-row');
//     document.getElementById('background')?.classList.add('!hidden');
// }
</script>

<template>

    <Head title="Welcome" />
    <div class="flex min-h-screen flex-col">
        <header class="fixed top-0 left-0 w-full bg-[#FDFDFC] dark:bg-[#0a5753] shadow-sm py-3 px-4 z-50">
            <div class="flex lg:col-start-2 lg:justify-center">
            </div>

        </header>
        <!-- Include Navbar Component -->
        <Navbar :canRegister="true" />
        <!-- Include HeroBanner Component -->
        <HeroBanner />
        <main class="mt-6">
        </main>

        <footer class="py-16 text-center text-sm text-black dark:text-white/70">

        </footer>
    </div>
</template>

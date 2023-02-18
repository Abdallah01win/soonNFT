<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-7 md:h-screen">
      <div class="flex flex-col justify-center items-center col-span-4 max-md:mx-[8%]">
        <div class="w-full md:max-w-md py-8 ">
          <slot />
        </div>
      </div>
  
      <div class="relative col-span-3 max-md:hidden">
        <img src="storage/assets/alien-gc688c9726_1280.jpg" alt="" class="h-screen w-full" />
        <div class="px-10 py-8 w-full absolute bottom-0 ">
          <div class="h-full bg-white px-8 py-6 rounded-lg bg-opacity-50">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              class="block w-5 h-5 text-black mb-4"
              viewBox="0 0 975.036 975.036"
            >
              <path
                d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"
              ></path>
            </svg>
            <p class="leading-relaxed mb-5 text-black">
              I recently discovered soonnft and I'm impressed with the platform! It's been so easy for me to find all kinds of NFTs, and the blog section is a great resource for staying up to date on the industry.
            </p>
            <div class="inline-flex items-center">
              <img
                alt="testimonial"
                src="storage/assets/alien-gc688c9726_1280.jpg"
                class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-top"
              />
              <span class="flex-grow flex flex-col pl-4 text-gray-900">
                <span class="title-font text-sm font-medium">Nathan Williams</span>
                <span class="text-xs">Nath_Williams</span>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
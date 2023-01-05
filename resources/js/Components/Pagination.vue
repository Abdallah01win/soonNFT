<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  props: {
    links: Array,
  },
  components : {
    Link,
  }
}
</script>

<template>
    <div v-if="links.length > 3">
      <div class="flex flex-wrap mt-10">
        <template v-for="(link, key) in links">
          <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-white/50 border rounded-full" v-html="link.label" />
          <Link v-else class="grid place-content-center mr-1 mb-1 px-4 py-2 text-sm leading-4 border rounded-full hover:text-white focus:border-white" :class="{ 'bg-transparent font-bold': link.active }" :href="link.url" v-html="link.label"/>
        </template>
      </div>
    </div>
  </template>
  


<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-3 bg-white border border-transparent rounded-full font-bold  text-black uppercase tracking-widest hover:bg-white/90 focus:bg-white/90 active:bg-white/90 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 text-sm"
    >
        <slot />
    </button>
</template>

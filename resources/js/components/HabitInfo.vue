<template>
    <div class="flex flex-col basis-1/2">
        <h1 id="name" class="text-base font-semibold">{{ name }}</h1>
        <small class="font-normal text-gray-400">1 / 3 times</small>
    </div>
</template>

<script setup>
    defineProps({
        name: {
            type: String
        }
    })
</script>

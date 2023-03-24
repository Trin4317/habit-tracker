<template>
    <div class="flex flex-col basis-1/2">
        <h1 id="name" class="text-base font-semibold">{{ name }}</h1>
        <small id="execution" class="font-normal text-gray-400">{{ executions_count }} / {{ times_per_day }} times</small>
    </div>
</template>

<script setup>
    defineProps({
        name: {
            type: String
        },
        times_per_day: {
            type: Number
        },
        executions_count: {
            type: Number
        }
    })
</script>

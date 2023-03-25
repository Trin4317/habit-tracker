<template>
    <TransitionRoot as="template" appear :show="habits.isDialogOpen">
        <Dialog as="div" @close="$event => habits.closeDialog()" class="relative z-10">
            <!-- backdrop starts here -->
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>
            <!-- backdrop ends here -->

            <!-- dialog starts here -->
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel class="w-full max-w-md transform overflow-hidden
                                            rounded-2xl bg-white p-6 text-left
                                            align-middle shadow-xl transition-all"
                        >
                            <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                New Habit
                            </DialogTitle>

                            <div class="mt-2">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        Habit Name
                                    </label>
                                    <input type="text" name="name"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-600"
                                    >
                                    <span class="text-sm text-red-600">
                                        The name field is required
                                    </span>
                                </div>

                                <div class="mt-2">
                                    <label for="times_per_day" class="block text-sm font-medium text-gray-700">
                                        Times Per Day
                                    </label>
                                    <input type="text" name="times_per_day"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-600"
                                    >
                                    <span class="text-sm text-red-600">
                                        The times per day field is required
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button @click="$event => habits.closeDialog()" type="button" class="inline-flex items-center bg-primary-600 px-3.5 py-2 rounded-md text-sm font-medium text-white">
                                    Save
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
    import {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle
    } from '@headlessui/vue'
    import { useHabitsStore } from '@/stores/habits'

    const habits = useHabitsStore()
</script>

import axios from "axios";
import { defineStore } from "pinia";
import { reactive, ref } from "vue";

export const useHabitsStore = defineStore('habits', () => {
    const list = ref([])
    const isDialogOpen = ref(false)
    const validationErrors = ref({})
    const formData = reactive({
        id: '',
        name: '',
        times_per_day: ''
    })

    const fetch = async () => {
        try {
            let response = await axios.get('/api/habits')
            list.value = response.data.data
        } catch (error) {
            console.log(error)
        }
    }

    const newExecution = (habitIndex) => {
        let habit = list.value[habitIndex]
        if (habit.executions_count < habit.times_per_day) {
            list.value[habitIndex].executions_count++
            axios.post(`/api/habits/${habit.id}/execute`)
        }
    }

    const percent = (habitIndex) => {
        let habit = list.value[habitIndex]
        return habit.times_per_day > 0 ? Math.floor(habit.executions_count / habit.times_per_day * 100) : 0
    }

    const openDialog = () => {
        isDialogOpen.value = true
    }

    const closeDialog = () => {
        isDialogOpen.value = false

        formData.id = ''
        formData.name = ''
        formData.times_per_day = ''
    }

    const storeHabit = async () => {
        try {
            let response = await axios.post('/api/habits', formData)

            validationErrors.value = {}
            list.value = response.data.data

            closeDialog()
        } catch (error) {
            if (error.response.status == 422) {
                validationErrors.value = error.response.data.errors
            }
        }
    }

    const editHabit = (habitIndex) => {
        let habit = list.value[habitIndex]

        formData.id = habit.id
        formData.name = habit.name
        formData.times_per_day = habit.times_per_day

        openDialog()
    }

    const updateHabit = async () => {
        try {
            let response = await axios.put(`/api/habits/${formData.id}`, formData)

            validationErrors.value = {}
            list.value = response.data.data

            closeDialog()
        } catch (error) {
            if (error.response.status == 422) {
                validationErrors.value = error.response.data.errors
            }
        }
    }

    const deleteHabit = async (habitIndex) => {
        let habit = list.value[habitIndex]
        try {
            let response = await axios.delete(`/api/habits/${habit.id}`)

            list.value = response.data.data
        } catch (error) {
            //
        }
    }

    return {
        list,
        isDialogOpen,
        validationErrors,
        formData,
        fetch,
        newExecution,
        percent,
        openDialog,
        closeDialog,
        storeHabit,
        editHabit,
        updateHabit,
        deleteHabit,
    }
})

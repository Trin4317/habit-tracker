import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useHabitsStore = defineStore('habits', () => {
    const list = ref([])

    const fetch = async () => {
        try {
            let response = await axios.get('/api/habits')
            list.value = response.data.data
        } catch (error) {
            console.log(error)
        }
    }

    const newExecution = (habitIndex) => {
        list.value[habitIndex].executions_count++
    }

    const percent = (habitIndex) => {
        let habit = list.value[habitIndex]
        return habit.times_per_day > 0 ? Math.floor(habit.executions_count / habit.times_per_day * 100) : 0
    }

    return {
        list,
        fetch,
        newExecution,
        percent,
    }
})

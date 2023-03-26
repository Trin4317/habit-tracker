import { createPinia, setActivePinia } from "pinia";
import { beforeEach, describe, it, expect } from "vitest";
import { useHabitsStore } from "@/stores/habits";

describe('Habits Store', () => {
    let habits = null
    let habitIndex = 0

    beforeEach(async () => {
        setActivePinia(createPinia())
        habits = useHabitsStore()
        await habits.fetch()
    })

    it('fetches the list of habits', () => {
        expect(habits.list.length).toBe(1)
    })

    it('increments the execution', async () => {
        habits.list[habitIndex].executions_count = 0

        habits.newExecution(habitIndex)

        expect(habits.list[habitIndex].executions_count).toBe(1)
    })

    it('returns the percent', () => {
        habits.list[habitIndex].times_per_day = 3
        habits.list[habitIndex].executions_count = 1

        expect(habits.percent(habitIndex)).toBe(33)
    })

    it('keeps the executions less than or equal to times per day', async () => {
        habits.list[habitIndex].times_per_day = 3
        habits.list[habitIndex].executions_count = 3

        habits.newExecution(habitIndex)

        expect(habits.list[habitIndex].executions_count).toBe(3)
    })

    it('opens the dialog', () => {
        habits.openDialog()

        expect(habits.isDialogOpen).toBe(true)
    })

    it('close the dialog', () => {
        habits.closeDialog()

        expect(habits.isDialogOpen).toBe(false)
    })

    it('opens the edit habit dialog with correct form data', () => {
        habits.editHabit(habitIndex)

        expect(habits.formData.name).toBe(habits.list[habitIndex].name)
        expect(habits.formData.times_per_day).toBe(habits.list[habitIndex].times_per_day)
    })

    it('clears the form data after creating a habit', async () => {
        habits.formData.name = 'Test'
        habits.formData.times_per_day = 1

        await habits.storeHabit()

        expect(habits.formData.name).toBe('')
        expect(habits.formData.times_per_day).toBe('')
    })

    it('returns the validation errors when creating a habit', async () => {
        await habits.storeHabit()

        expect(habits.validationErrors.name.length).toBe(1)
        expect(habits.validationErrors.times_per_day.length).toBe(1)
    })
})

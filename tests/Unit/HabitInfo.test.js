import { describe, it, expect } from "vitest";
import { mount } from "@vue/test-utils";
import HabitInfo from '@/components/HabitInfo.vue';

describe('HabitInfo.vue', () => {
    it('displays the habit name', () => {
        const wrapper = mount(HabitInfo, {
            props: {
                'name': 'Drink water'
            }
        })

        expect(wrapper.find('#name').text()).toBe('Drink water')
    })
})

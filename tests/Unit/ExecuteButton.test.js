import { describe, it, expect, beforeEach } from "vitest";
import { mount } from "@vue/test-utils";
import ExecuteButton from '@/components/ExecuteButton.vue';

describe('ExecuteButton.vue', () => {
    let wrapper = null

    beforeEach(() => {
        wrapper = mount(ExecuteButton)
    })

    it('renders the button', () => {
        expect(wrapper.find('#execute').text()).toBe('+1')
    })
})

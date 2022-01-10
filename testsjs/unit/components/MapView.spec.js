import axios from 'axios'
import {mount} from "@vue/test-utils";
import MapView from "../../../resources/js/components/PMapView";
import map from "../../../resources/js/maps/map";

describe('MapView.vue', () => {
    jest.mock('axios')
    axios.get = jest.fn()
    let wrapper
    let options = {
        propsData: {
            lat: '11.00000',
            lbg: '-77.0000'
        }
    }
    test('it must fail when ip is not set', async () => {
        console.error = jest.fn().mockImplementation()
        const error = jest.spyOn(console, 'error')
        wrapper = mount(MapView)
        expect(error).toBeCalled()
    })

    test('it must show img when services failed', async () => {
        axios.get.mockRejectedValue(new Error('Error from service'))
        wrapper = mount(MapView, options)
        await wrapper.vm.$nextTick()
        await wrapper.vm.$nextTick()
        expect(wrapper.vm.mapError).toBeTruthy()
        expect(wrapper.html()).toContain('Error while rendering map')
        expect(wrapper.html()).not.toContain('id="map"')
    })

    test('it must show map container', async () => {
        axios.get.mockResolvedValue({
            data: {
                latitude: 11,
                longitude: -70
            }
        })
        map.renderMap = jest.fn().mockImplementation()
        wrapper = mount(MapView, options)
        await wrapper.vm.$nextTick()
        await wrapper.vm.$nextTick()
        expect(wrapper.vm.mapError).toBeFalsy()
        expect(wrapper.html()).not.toContain('Error while rendering map')
        expect(wrapper.html()).toContain('id="map"')
    })
})

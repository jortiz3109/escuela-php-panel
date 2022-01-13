import Map from '../../../resources/js/maps/map'
import leafLetMap from "../../../resources/js/maps/services/leafLetMap";

describe('Map.js', () => {

    test('it must return default service leaflet', () => {
        expect(Map.service).toStrictEqual(leafLetMap)
    })

    test('renderMap must return error when service has not render function', () => {
        Map.service = {}
        expect(() => {
            Map.renderMap({})
        }).toThrowError('Service has not render function')
    })

})

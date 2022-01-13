import leafLetMap from "../../../../resources/js/maps/services/leafLetMap";

describe('leafLeftMaps.js', () => {

    test('it must contain render functions', () => {
        expect(typeof leafLetMap.render === 'function').toBeTruthy()
    })
})

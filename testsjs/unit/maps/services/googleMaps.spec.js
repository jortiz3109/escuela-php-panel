import googleMaps from "../../../../resources/js/maps/services/googleMaps";

describe('googleMaps.js', () => {

    test('it must contain render functions', () => {
        expect(typeof googleMaps.render === 'function').toBeTruthy()
    })
})

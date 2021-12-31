require('./bootstrap');
require('./buefy');

import MapView from './components/MapView'
import IAutocomplete from "./components/inputs/IAutocomplete";
import IDate from "./components/inputs/IDate";

Vue.component('i-autocomplete', IAutocomplete);
Vue.component('i-date', IDate);
Vue.component('map-view', MapView);

const app = new Vue({
    el: '#app'
});

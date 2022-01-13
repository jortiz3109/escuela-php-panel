require('./bootstrap');
require('./buefy');

import PStatusButton from './components/buttons/PStatusButton';
import PMapView from './components/PMapView'
import IAutocomplete from "./components/inputs/IAutocomplete";
import IDate from "./components/inputs/IDate";

Vue.component('p-status-button', PStatusButton);
Vue.component('i-autocomplete', IAutocomplete);
Vue.component('i-date', IDate);
Vue.component('p-map-view', PMapView);

const app = new Vue({
    el: '#app'
});

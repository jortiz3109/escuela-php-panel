require('./bootstrap');
require('./buefy');
import StatusButton from './components/buttons/StatusButton';

Vue.component('status-button', StatusButton);

const app = new Vue({
    el: '#app'
})

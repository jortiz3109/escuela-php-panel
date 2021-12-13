require('./bootstrap');
require('./buefy');
// import Button from './EnableButton'
import Test from './components/buttons/Test'

Vue.component('status-button', Test)

const app = new Vue({
    el: '#app'
})

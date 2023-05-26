/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueToastr from "vue-toastr";
import moment from 'moment';

window.axios = require('axios');
window.Vue = require('vue').default;

Vue.use(VueToastr, {
/* OverWrite Plugin Options if you need */
});

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('dddd DD MMMM YYYY')
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-lottery-component', require('./components/CreateLotteryComponent.vue').default);
Vue.component('user-lottery-component', require('./components/UserLotteryComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const combination_list = [];

for (let index = 1; index <= 59; index++) {
    var i = index.toString();
    if(i.length == 1) {
        i = "0"+i;
    }

    combination_list.push(i);
}

const app = new Vue({
    el: '#app',
    data: {
        combination_list: combination_list
    }
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import AppComponent from './components/app.vue'
import AddTaskComponent from './components/AddTask.vue';
window.Vue = require('vue').default;
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast, {
    position: 'top-right'
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('students-index', require('./components/StudentsIndex.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('add-task-component', AddTaskComponent);
Vue.component('app', AppComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faPlusSquare, faTrash)
Vue.component('font-awesome-icon', FontAwesomeIcon)
const app = new Vue({
    el: '#app',
    methods: {
        handleTaskCreated(task) {
            // Handle task creation event here
            console.log('New task created:', task);
        }
    }
});

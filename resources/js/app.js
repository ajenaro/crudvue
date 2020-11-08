require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('tasks-component', require('./components/TasksComponents.vue').default);

const app = new Vue({
    el: '#app',
});

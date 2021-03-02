require("./bootstrap");

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Vue from 'vue';
import Vuex from 'vuex';
import Vuelidate from 'vuelidate';

window.Vue = require('vue');


export const eventBus = new Vue();
export const Cookies = require('js-cookie');

// Vuetify
// import vuetify from './plugins/vuetify'
// Phonemask
// import PhoneMaskInput from "vue-phone-mask-input";
// Vue.component('PhoneMaskInput', PhoneMaskInput);

import axios from "axios";
// axios.defaults.baseURL = "https://newsapi.org/v2/top-headlines";

// import LazyLoadDirective from "./directives/LazyLoadDirective.js";

// Vue.directive("lazyload", LazyLoadDirective);

Vue.use(Vuex);
Vue.use(Vuelidate);

import {state} from './vuex/state.js'
import {getters} from './vuex/getters.js'
import {mutations} from './vuex/mutations.js'
import {actions} from './vuex/actions.js'

const store = new Vuex.Store({
    state,
    mutations,
    getters,
    actions
});

Vue.component('second-section', require('./components/SecondSection.vue').default);
Vue.component('third-section', require('./components/ThirdSection.vue').default);
Vue.component('modal-cart', require('./components/ModalCart.vue').default);
Vue.component('modal-order-success', require('./components/ModalOrderSuccess.vue').default);
Vue.component('select2', require('./components/Select2.vue').default);

import getCookie from "./mixins/getCookie";
import updateCookie from "./mixins/updateCookie";

new Vue({
    // vuetify,
    el: "#app",
    data: ()=>{
        return {
            nameCookie: '4drv-store-user',
            user: {
                count: 0,
                products: {}
            }
        }
    },
    mixins: [getCookie, updateCookie],
    store,
    beforeMount() {
        let user = this.getCookie();
        this.$store.commit("add_user", user);
    },
});

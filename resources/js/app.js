require("./bootstrap");
import Vue from "vue";
import './components/globals'
require('./plugins/global')
import { initialize } from "./helpers/general";
import i18n from "./plugins/i18n";
require("./helpers/Filter");
import './directive/Tooltip'

/*Vuelidate for form validation*/
import Vuelidate from "vuelidate/src";
Vue.use(Vuelidate)

/*Vue Meta*/
import Meta from 'vue-meta'
Vue.use(Meta)

/* Vue-router */
import VueRouter from "vue-router";
Vue.use(VueRouter);

/* Vuex for the store */
import Vuex from "vuex";
Vue.use(Vuex);
import StoreData from "./store";
const store = new Vuex.Store(StoreData);

import VueHtmlToPaper from "vue-html-to-paper";
const options = {
  name: "_blank",
  specs: ["fullscreen=yes", "titlebar=yes", "scrollbars=yes"],
  styles: [
    'http://127.0.0.1:8000/css/bootstrap.min.css',
    'http://127.0.0.1:8000/css/print.css'
  ],
};

Vue.use(VueHtmlToPaper, options);

/* Import the route list */
import { routes } from "./routes/index";
const router = new VueRouter({
  routes,
  mode: "history",
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { x: 0, y: 0 }
    }
  }
});

/* Custom fire event defined */
window.Fire = new Vue();

import MainApp from "./layouts/MainApp.vue";
import { sync } from "vuex-router-sync";
initialize(store, router);
sync(store, router);

import { Plugin } from 'vue-fragment'
Vue.use(Plugin)


/* main vue is running here */
const app = new Vue({
  el: "#app",
  i18n,
  router,
  store,
  components: {
    MainApp
  }
});

import Vue from 'vue';
import VueCompositionAPI, { createApp, h } from '@vue/composition-api';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueI18n from 'vue-i18n';
import axios from 'axios';
import store from './store/index.js';

// Import shared components
import TheHeader from './components/TheHeader.vue';
import TheSidebar from './components/TheSidebar.vue';
import TheTitle from './components/TheTitle.vue';

// Axios
axios.defaults.baseURL = 'http://localhost:8000/api/';
axios.defaults.headers.post['Content-Type'] =
  'application/x-www-form-urlencoded';
Vue.prototype.$axios = axios;

import App from './App.vue';
import router from './router';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import { ToastPlugin } from '@syncfusion/ej2-vue-notifications';
// import { ToastPlugin } from '@syncfusion/ej2-vue-notifications';
import { GridPlugin } from '@syncfusion/ej2-vue-grids';
import {
  extend,
  localize,
  ValidationObserver,
  ValidationProvider,
} from 'vee-validate';
import en from 'vee-validate/dist/locale/en.json';
import ar from 'vee-validate/dist/locale/ar.json';
import * as rules from 'vee-validate/dist/rules';

Vue.use(VueCompositionAPI);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueI18n);
Vue.use(GridPlugin);
Vue.use(ToastPlugin);

// const locale = document.documentElement.lang;
const locale = 'ar';

// Install VeeValidate rules and localization
Object.keys(rules).forEach((rule) => {
  extend(rule, rules[rule]);
});
if (locale === 'ar') {
  localize('ar', ar);
} else {
  localize('en', en);
}
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);
import './translations/common_translations.json';

const i18n = new VueI18n({
  locale: document.documentElement.lang,
});

const app = createApp({
  router,
  store,
  render: () => h(App),
});

app.component('the-header', TheHeader);
app.component('the-sidebar', TheSidebar);
app.component('the-title', TheTitle);

app.mount('#app');

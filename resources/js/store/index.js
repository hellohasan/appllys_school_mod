import Cookies from 'js-cookie';
import {getLocalUser} from "../helpers/auth";

const user = getLocalUser();
const {locale, locales} = window.config
const {basicData} = getBasicData();

export default ({
  state: {
    basicData: basicData,
    currentUser: user,
    isLoggedIn: !!user,
    loading: false,
    auth_error: '',
    roles: user ? user.roles : [],
    permissions: user ? user.permissions : [],
    customers: [],
    locale: getLocale(locales, locale),
    locales: locales,
  },
  getters: {
    basicData(state) {
      return state.basicData
    },
    isLoading(state) {
      return state.loading;
    },
    isLoggedIn(state) {
      return state.isLoggedIn;
    },
    currentUser(state) {
      return state.currentUser;
    },
    authError(state) {
      return state.auth_error;
    },
    roles(state) {
      return state.roles
    },
    permissions(state) {
      return state.permissions
    },
    customers(state) {
      return state.customers
    },
    locale(state) {
      return state.locale
    },
    locales(state) {
      return state.locales
    }
  },
  mutations: {
    login(state) {
      state.loading = true;
      state.auth_error = null;
    },
    loginSuccess(state, payload) {
      state.auth_error = null;
      state.isLoggedIn = true;
      state.loading = false;
      state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});
      state.basicData = Object.assign({}, payload.basic);
      localStorage.setItem("user", JSON.stringify(state.currentUser));
      localStorage.setItem("basic", JSON.stringify(state.basicData));
    },
    loginFailed(state, payload) {
      state.loading = false;
      state.auth_error = payload.error;
    },
    logout(state) {
      localStorage.removeItem("user");
      state.isLoggedIn = false;
      state.currentUser = null;
      state.roles = [];
      state.permissions = [];
    },
    updateCurrentUser(state, payload) {
      state.currentUser = Object.assign({}, payload.user, {token: state.currentUser.token});
      localStorage.setItem("user", JSON.stringify(state.currentUser));
      //state.currentUser = Object.assign({},payload,{token:state.currentUser.token});
      //localStorage.setItem("user",state.currentUser);
    },
    updateCustomer(state, payload) {
      state.customers = payload
    },
    setLocalLang(state, locale) {
      state.locale = locale
      Cookies.set('locale', locale, {expires: 365})
    },
    updateBasicData(state, payload) {
      state.basicData = payload
    }
  },
  actions: {
    login(context) {
      context.commit("login");
    },
    refreshCurrentUser(context) {
      axios.post('/api/auth/me')
        .then((res) => {
          context.commit('updateCurrentUser', res.data)
        })
        .catch(() => {
          console.log('error');
        })
    },
    getCustomer(context) {
      axios.get('/api/customers')
        .then((res) => {
          context.commit('updateCustomer', res.data.customers)
        })
    },
    setLocale(context, locale) {
      context.commit('setLocalLang', locale)
    }
  }
});

/**
 * @param  {String[]} locales
 * @param  {String} fallback
 * @return {String}
 */
function getLocale(locales, fallback) {
  const locale = Cookies.get('locale')

  if (Object.prototype.hasOwnProperty.call(locales, locale)) {
    return locale
  } else if (locale) {
    Cookies.remove('locale')
  }
  return fallback
}

export function getBasicData() {
  const basicStr = localStorage.getItem("basic");
  if (basicStr === null) {
    let basic = {'title' : 'Develop by Softwarezon'}
    return basic
  }
  return JSON.parse(basicStr)
}

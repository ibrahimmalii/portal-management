import router from '../../router/index';
const store = {
  namespaced: true,
  state() {
    return {
      isLoggedIn: !!localStorage.token,
      username: localStorage.user ? JSON.parse(localStorage.user).name : '',
    };
  },
  mutations: {
    setLoggedStatus(state, { isAuth }) {
      state.isLoggedIn = isAuth;
    },
    setUserNameValue(state, { username }) {
      state.username = username;
    },
  },
  actions: {
    login(context) {
      context.commit('setLoggedStatus', { isAuth: true });
      router.push({ name: 'companies' });
    },
    logout(context) {
      localStorage.clear();
      context.commit('setLoggedStatus', { isAuth: false });
      router.push('/login');
    },
    setUserName({ commit }) {
      if (localStorage.user) {
        commit('setUserNameValue', {
          username: JSON.parse(localStorage.user).name,
        });
      }
    },
  },
  getters: {
    getLoggedStatus(state) {
      return state.isLoggedIn;
    },
    userNameGetter(state) {
      return state.username;
    },
  },
};

export default store;

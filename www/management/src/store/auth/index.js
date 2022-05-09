const store = {
namespaced: true,
  state() {
    return {
      isLoggedIn: !!localStorage.token,
    };
  },
  mutations: {
    setLoggedStatus(state, { isAuth }) {
      state.isLoggedIn = isAuth;
    },
  },
  actions: {
    login(context) {
      context.commit('setLoggedStatus', { isAuth: true });
    },
    logout(context) {
      localStorage.clear();
      context.commit('setLoggedStatus', { isAuth: false });
    },
  },
  getters: {
    getLoggedStatus(state) {
      return state.isLoggedIn;
    },
  },
};

export default store;

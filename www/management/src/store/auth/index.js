import router from '../../router/index';
const store = {
  namespaced: true,
  state() {
    return {
      isLoggedIn: !!localStorage.token,
      username: localStorage.user ? JSON.parse(localStorage.user).name_ar : '',
      avatar: localStorage.user ? JSON.parse(localStorage.user).avatar : '',
    };
  },
  mutations: {
    setLoggedStatus(state, { isAuth }) {
      state.isLoggedIn = isAuth;
    },
    setUserNameValue(state, { username, avatar }) {
      state.username = username;
      state.avatar = avatar;
    },
    setAvatarValue(state, { avatar }) {
      state.avatar = avatar;
      console.log('ava', avatar);
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
          username: JSON.parse(localStorage.user).name_ar,
          avatar: JSON.parse(localStorage.user).avatar,
        });
      }
    },
    setAvatar({ commit }) {
      if (localStorage.user) {
        commit('setAvatarValue', {
          avatar: JSON.parse(localStorage.user).avatar,
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
    avatarGetter(state) {
      return state.avatar;
    },
  },
};

export default store;

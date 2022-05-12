import axios from 'axios';
const store = {
  namespaced: true,
  state() {
    return {
      subCompaniesDropdown: [],
      superVisorsDropdown: [],
    };
  },
  mutations: {
    setSubCompaniesDropdown(state, subCompanies) {
      state.subCompaniesDropdown = subCompanies;
    },
    setSuperVisorsDropdown(state, superVisors) {
      state.superVisorsDropdown = superVisors;
    },
  },
  actions: {
    async getSubCompaniesDropdown({ commit }) {
      const subCompanies = await axios.get('subCompanies/dropdown');
      commit('setSubCompaniesDropdown', subCompanies.data);
    },
    async getSuperVisorsDropdown({ commit }) {
      const superVisors = await axios.get('users/supervisors/dropdown');
      commit('setSuperVisorsDropdown', superVisors.data);
    },
  },
  getters: {
    subCompaniesDropdownGetter(state) {
      return state.subCompaniesDropdown;
    },
    superVisorsDropdownGetter(state) {
      return state.superVisorsDropdown;
    },
  },
};

export default store;

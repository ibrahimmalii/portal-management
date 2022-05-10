import axios from 'axios';
const store = {
  namespaced: true,
  state() {
    return {
      companiesDropdown: [],
    };
  },
  mutations: {
    setCompaniesDropDown(state, companies) {
      state.companiesDropdown = companies;
    },
  },
  actions: {
    async getCompaniesDropdown({ commit }) {
      const companies = await axios.get('companies/dropdown');
      commit('setCompaniesDropDown', companies.data);
    },
  },
  getters: {
    companiesDropdownGetter(state) {
      return state.companiesDropdown;
    },
  },
};

export default store;

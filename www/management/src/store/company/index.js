import axios from 'axios';
const store = {
  namespaced: true,
  state() {
    return {
      companiesDropdown: [],
      subCompaniesDropdown: [],
      superVisorsDropdown: [],
    };
  },
  mutations: {
    setCompaniesDropDown(state, companies) {
      state.companiesDropdown = companies;
    },
    setSubCompaniesDropdown(state, subCompanies) {
      state.subCompaniesDropdown = subCompanies;
    },
    setSuperVisorsDropdown(state, superVisors) {
      state.superVisorsDropdown = superVisors;
    },
  },
  actions: {
    async getCompaniesDropdown({ commit }) {
      const companies = await axios.get('companies/dropdown');
      commit('setCompaniesDropDown', companies.data);
    },
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
    companiesDropdownGetter(state) {
      return state.companiesDropdown;
    },
    subCompaniesDropdownGetter(state) {
      return state.subCompaniesDropdown;
    },
    superVisorsDropdownGetter(state) {
      return state.superVisorsDropdown;
    },
  },
};

export default store;

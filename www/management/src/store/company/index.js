import axios from 'axios';
const store = {
  namespaced: true,
  state() {
    return {
      companiesDropdown: [],
      subCompaniesDropdown: [],
      superVisorsDropdown: [],
      usersDropdown: [],
      products: [],
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
    setUsersDropdown(state, users) {
      console.log(users);
      state.usersDropdown = users;
    },
    setProrducts(state, products) {
      state.products = products;
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
    async getUsersDropdown({ commit }) {
      const users = await axios.get('users/dropdown');
      commit('setUsersDropdown', users.data);
    },
    async getProducts({ commit }) {
      const products = await axios.get('products');
      commit('setProrducts', products.data);
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
    usersDropdownGetter(state) {
      return state.usersDropdown;
    },
    productsGetter(state) {
      return state.products;
    },
  },
};

export default store;

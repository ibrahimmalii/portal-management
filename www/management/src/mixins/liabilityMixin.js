import { mapGetters } from 'vuex';

export default {
  computed: {
    ...mapGetters('companies', [
      'companiesDropdownGetter',
      'subCompaniesDropdownGetter',
      'usersDropdownGetter',
      'productsGetter',
    ]),
    isOnlyStillOneMileStone() {
      return this.form.liability_dates.length <= 1 ? true : false;
    },
    checkAttachments() {
      return !this.form.attachments;
    },
    ifNoProductSelected() {
      return !this.form.product_id;
    },
    measureTotalRemainingAmount() {
      console.log('from remain');
      let counter = 0;
      this.form.liability_dates.forEach((item) => {
        console.log(item);
        if (item.is_paid && item.is_paid.id == 0) {
          counter += +item.required_amount;
        }
      });
      this.form.remaining_amount = counter;
      return counter;
    },
    measureRequiredAmount() {
      const total = this.form.liability_dates.reduce(
        (acc, prev) => +acc + +prev.required_amount,
        0
      );
      this.requiredAmount = total;
      return total;
    },
    checkCreditAndDebitEquality() {
      if (this.isSubmitted) {
        if (
          this.form.total_amount != this.requiredAmount ||
          (this.form.total_amount == 0 && this.requiredAmount == 0)
        ) {
          return this.$store.state.errorEquality;
        }
      }
    },
  },
  methods: {
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    generateId() {
      const id = Math.random().toString(36).substr(2, 9);
      return id;
    },
    clearForm() {
      requestAnimationFrame(() => {
        this.$refs.observer.reset();
      });
    },
    getSubCompanies(company) {
      this.form.sub_company_id = null;
      this.form.user_id = null;
      if (company) {
        this.$axios.get(`companies/${company.id}/sub_companies`).then((res) => {
          this.$store.commit('companies/setSubCompaniesDropdown', res.data);
        });
      }
    },
    getUsersDropDown(subCompany) {
      console.log('from func');
      this.form.user_id = null;
      if (subCompany) {
        this.$axios.get(`subCompanies/${subCompany.id}/users`).then((res) => {
          this.$store.commit('companies/setUsersDropdown', res.data);
        });
      }
    },
    getUsersDropDownFromMainCompany(company) {
      console.log('from func');
      this.form.user_id = null;
      if (company) {
        this.$axios.get(`companies/${company.id}/users`).then((res) => {
          console.log(res);
          this.$store.commit('companies/setUsersDropdown', res.data);
        });
      }
    },
    getSubAndUsersDropDown(company) {
      this.getSubCompanies(company);
      this.getUsersDropDownFromMainCompany(company);
    },
    getProductPrice(product) {
      if (product) {
        this.$axios.get(`products/${product.id}`).then((res) => {
          this.form.total_amount = res.data.price;
        });
      } else {
        this.form.total_amount = null;
      }
    },
    getUserData(user) {
      if (user) {
        this.$axios.get(`users/${user.id}`).then((res) => {
          this.form.civil_id = res.data.civil_id;
        });
      } else {
        this.form.civil_id = null;
      }
    },
    deleteMileStone(id) {
      const formIndex = this.form.liability_dates.findIndex(
        (item) => item.id === id
      );
      this.form.liability_dates.splice(formIndex, 1);
    },
    addNewForm() {
      console.log('from add new form');
      const id = this.generateId();
      this.form.liability_dates.push({
        id,
        date: null,
        required_amount: null,
        pay_date: null,
        notes: null,
        is_paid: {
          id: 0,
          name: 'لا',
        },
      });
    },
  },
};

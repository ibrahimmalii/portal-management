<template>
  <div>
    <ValidationObserver ref="observer" class="w-50" v-slot="{ handleSubmit }">
      <b-form @submit.prevent="handleSubmit(onSubmit)">
        <b-row class="my-1 text-end mb-3">
          <b-col>
            <label for="input-small">{{ $store.state.emp_name }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.emp_name"
              rules="required"
              vid="emp_name"
            >
              <v-select
                id="emp_name"
                v-model="form.user_id"
                size="md"
                dir="rtl"
                :placeholder="$store.state.enterEmpName"
                :options="usersDropdownGetter"
                @input="getUserData"
                label="name_ar"
                value="id"
              ></v-select>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.sub_company }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.sub_company"
              rules="required"
              vid="sub_company"
            >
              <v-select
                id="sub_company"
                v-model="form.sub_company_id"
                @input="getUsersDropDown"
                size="md"
                dir="rtl"
                :placeholder="$store.state.enterSubCompany"
                :options="subCompaniesDropdownGetter"
                label="name"
                value="id"
              ></v-select>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.main_company }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.main_company"
              rules="required"
              vid="main_company"
            >
              <v-select
                id="main_company"
                v-model="form.company_id"
                size="md"
                dir="rtl"
                :placeholder="$store.state.enterMainCompany"
                :options="companiesDropdownGetter"
                @input="getSubCompanies"
                label="name"
                value="id"
              ></v-select>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-row>
        <b-row class="my-1 text-end mb-3">
          <b-col>
            <label for="input-small">{{ $store.state.remaining_amount }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.remaining_amount"
              rules="integer|min:0"
              vid="remaining_amount"
            >
              <b-form-input
                :value="measureTotalRemainingAmount || 0"
                class="text-end"
                id="remaining_amount"
                size="md"
                :placeholder="$store.state.enterRemainingAmount"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.total_amount }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.total_amount"
              rules="required|integer"
              vid="total_amount"
            >
              <b-form-input
                v-model="form.total_amount"
                class="text-end"
                id="total_amount"
                :disabled="ifNoProductSelected"
                size="md"
                :placeholder="$store.state.enterTotalAmount"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.product }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.product"
              rules="required"
              vid="product"
            >
              <v-select
                id="product"
                v-model="form.product_id"
                size="md"
                dir="rtl"
                :placeholder="$store.state.enterProduct"
                :options="productsGetter"
                @input="getProductPrice"
                label="name"
                value="id"
              ></v-select>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-row>
        <b-row class="my-1 text-end mb-2">
          <milestone-form-vue
            v-for="(milestone, index) in form.liability_dates"
            :key="milestone.id"
            :isOnlyStillOneForm="isOnlyStillOneMileStone"
            @deleteMileStone="deleteMileStone"
            v-bind.sync="form.liability_dates[index]"
          ></milestone-form-vue>
        </b-row>
        <b-form-row class="my-1 text-end mb-5">
          <b-button class="ml-1" variant="success" @click="addNewForm">
            <i class="fa fa-plus"></i>
          </b-button>
        </b-form-row>
        <b-row class="my-1 text-end mb-3">
          <b-col>
            <div class="d-flex flex-column justify-content-end align-items-end">
              <div class="mr-3 lead">
                <span
                  >{{ $store.state.total_amount }}:
                  {{ form.total_amount || 0 }} |
                </span>
                <span
                  >{{ $store.state.required_amount }}:
                  {{ measureRequiredAmount || 0 }}</span
                >
              </div>
              <div>
                <span class="text-danger">{{ errorTotals }}</span>
              </div>
            </div>
          </b-col>
          <b-col>
            <b-button
              type="reset"
              @click="clearForm"
              :disabled="isSubmitted"
              variant="danger"
              class="me-2"
              >{{ $store.state.clear }}</b-button
            >
            <b-button
              :disabled="isSubmitted"
              class="mr-2"
              type="submit"
              variant="primary"
            >
              <span v-if="!isSubmitted">
                {{ $store.state.add }}
              </span>
              <span v-else>
                <b-spinner small variant="light"></b-spinner>
              </span>
            </b-button>
          </b-col>
        </b-row>
      </b-form>
    </ValidationObserver>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import MilestoneFormVue from './MilestoneForm.vue';

export default {
  name: 'AddCompanyView',
  emits: ['addedSuccessfully', 'addeddError'],
  components: {
    MilestoneFormVue,
  },
  data() {
    return {
      isSubmitted: false,
      requiredAmount: 0,
      errorTotals: '',
      form: {
        company_id: '',
        sub_company_id: '',
        product_id: '',
        user_id: '',
        civil_id: null,
        total_amount: '',
        remaining_amount: '',
        is_fully_paid: 0,
        liability_dates: [
          {
            id: '38483748drxcn',
            date: null,
            required_amount: null,
            is_paid: null,
          },
        ],
      },
    };
  },
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
      const total = this.form.liability_dates.reduce((acc, prev) => {
        if (!prev.is_paid || prev.is_paid.id == 0) {
          return (+acc || 0) + (+prev.required_amount || 0);
        }
      }, 0);
      this.form.remaining_amount = total;
      return total;
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
    onSubmit() {
      this.isSubmitted = true;
      if (
        this.form.total_amount != this.requiredAmount ||
        (this.form.total_amount == 0 && this.requiredAmount == 0)
      ) {
        this.isSubmitted = false;
        return (this.errorTotals = this.$store.state.errorEquality);
      }
      const formData = new FormData();

      const totalRemaining = this.form.remaining_amount;

      if (totalRemaining > 0) {
        this.form.is_fully_paid = 0;
      } else {
        this.form.is_fully_paid = 1;
      }

      for (let i in this.form) {
        if (
          i == 'company_id' ||
          i == 'sub_company_id' ||
          i == 'product_id' ||
          i == 'user_id'
        ) {
          formData.append(i, this.form[i].id);
          continue;
        }
        if (Array.isArray(this.form[i])) {
          this.form[i] = this.form[i].map((item) => {
            if (item.is_paid.id == 0) {
              item.is_paid = 0;
            } else {
              item.is_paid = 1;
            }
            return item;
          });
          formData.append(i, JSON.stringify(this.form[i]));
          continue;
        }

        formData.append(i, this.form[i]);
      }

      if (!this.form.remaining_amount) {
        formData.append('remaining_amount', 0);
      }
      this.$axios
        .post('/liabilities', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then((_) => {
          this.$emit('addedSuccessfully');
        })
        .catch((errors) => {
          this.$emit('addedError', errors);
        })
        .finally(() => {
          this.isSubmitted = false;
        });
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
          console.log(res.data.users);
          this.$store.commit('companies/setUsersDropdown', res.data.users);
        });
      }
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
      const id = Math.random().toString(36).substr(2, 9);
      this.form.liability_dates.push({
        id,
        date: null,
        required_amount: null,
        is_paid: null,
      });
    },
  },
};
</script>

<style>
@import 'vue-select/dist/vue-select.css';
@import '@/assets/common.css';
</style>

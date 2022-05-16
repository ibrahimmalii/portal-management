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
            <label for="input-small">{{ $store.state.sub_company }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.sub_company"
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
                @input="getSubAndUsersDropDown"
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
        <b-card
          :title="$store.state.milestone_details"
          scrollable
          class="text-end"
        >
          <b-card-boody name="milestone">
            <div class="milestone">
              <b-row class="my-1 text-end mb-2">
                <transition-group name="list">
                  <milestone-form-vue
                    v-for="(milestone, index) in form.liability_dates"
                    :key="milestone.id"
                    :isOnlyStillOneForm="isOnlyStillOneMileStone"
                    @deleteMileStone="deleteMileStone"
                    v-bind.sync="form.liability_dates[index]"
                  ></milestone-form-vue>
                </transition-group>
              </b-row>
              <b-form-row class="my-1 text-end">
                <b-button class="ml-1" variant="success" @click="addNewForm">
                  <i class="fa fa-plus"></i>
                </b-button>
              </b-form-row>
            </div>
          </b-card-boody>
        </b-card>
        <b-row class="my-1 text-end my-3">
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
                {{ $store.state.edit }}
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
import liabilityMixin from '@/mixins/liabilityMixin';

export default {
  name: 'EditLiabilityView',
  emits: ['updatedSuccessfully', 'updatedFailed'],
  mixins: [liabilityMixin],
  props: ['liability'],
  components: {
    MilestoneFormVue,
  },
  mounted() {
    this.loadFormData();
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
            is_paid: {
              id: 0,
              name: 'لا',
            },
          },
        ],
      },
    };
  },
  methods: {
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
          if (this.form[i]) {
            formData.append(i, this.form[i].id);
          } else {
            formData.append(i, null);
          }
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
      formData.append('_method', 'PUT');
      this.$axios
        .post('/liabilities/' + this.form.id, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then((_) => {
          this.$emit('updatedSuccessfully');
        })
        .catch((errors) => {
          this.$emit('updatedFailed', errors);
        })
        .finally(() => {
          this.isSubmitted = false;
        });
    },
    loadFormData() {
      for (let i in this.liability) {
        this.form[i] = this.liability[i];
      }
      this.form.user_id = this.liability.user;
      this.form.company_id = this.liability.company;
      this.form.sub_company_id = this.liability.sub_company;
      this.form.product_id = this.liability.product;
      this.form.liability_dates = this.liability.dates;
      this.form.liability_dates.map((item) => {
        item.id = item.id || this.generateId();
        if (!item.is_paid) {
          item.is_paid = {
            id: 0,
            name: 'لا',
          };
        } else {
          item.is_paid = {
            id: 1,
            name: 'نعم',
          };
        }
      });
    },
  },
};
</script>

<style scoped>
@import 'vue-select/dist/vue-select.css';
@import '@/assets/common.css';

.milestone {
  background-color: #ebe8e8;
  padding-right: 27px;
  padding-top: 20px;
  padding: 0px 0pa;
  padding-bottom: 20px;
}

.list-enter-active,
.list-leave-active,
.list-move {
  transition: 500ms cubic-bezier(0.59, 0.12, 0.34, 0.95);
  transition-property: opacity, transform;
}

.list-enter {
  opacity: 0;
  transform: translateX(50px) scaleY(0.5);
}

.list-enter-to {
  opacity: 1;
  transform: translateX(0) scaleY(1);
}

.list-leave-active {
  position: absolute;
}

.list-leave-to {
  opacity: 0;
  transform: scaleY(0);
  transform-origin: center top;
}

.list-item {
  display: block;
  width: 100%;
}
</style>

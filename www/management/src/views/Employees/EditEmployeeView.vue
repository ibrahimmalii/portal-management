<template>
  <div>
    <ValidationObserver ref="observer" class="w-50" v-slot="{ handleSubmit }">
      <b-form @submit.prevent="handleSubmit(onSubmit)">
        <b-row class="my-1 text-end mb-3">
          <b-col class="d-none">
            <label for="input-small">{{ $store.state.email }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.email"
              rules="email"
              vid="email"
            >
              <b-form-input
                id="email"
                v-model="form.email"
                class="text-end"
                size="md"
                :placeholder="$store.state.enterEmail"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.arabicName }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.arabicName"
              rules="required"
              vid="arabicName"
            >
              <b-form-input
                v-model="form.name_ar"
                class="text-end"
                id="arabicName"
                size="md"
                :placeholder="$store.state.enterArabicName"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.name }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.name"
              rules=""
              vid="name"
            >
              <b-form-input
                id="name"
                v-model="form.name"
                class="text-end"
                :placeholder="$store.state.enterName"
              ></b-form-input>
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
            <label for="input-small">{{ $store.state.nationality }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.nationality"
              rules="required"
              vid="nationality"
            >
              <b-form-input
                v-model="form.nationality"
                class="text-end"
                id="nationality"
                size="md"
                :placeholder="$store.state.enterNationality"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.nationality_ar }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.nationality_ar"
              rules=""
              vid="nationality_ar"
            >
              <b-form-input
                id="nationality_ar"
                v-model="form.nationality_ar"
                class="text-end"
                :placeholder="$store.state.enterNationalityAr"
              ></b-form-input>
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
            <label for="input-small">{{ $store.state.expired_at }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.expired_at"
              rules="required"
              vid="expired_at"
            >
              <b-form-datepicker
                v-model="form.expired_at"
                class="text-end"
                :placeholder="$store.state.expired_at"
              ></b-form-datepicker>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
                >{{ validationContext.errors[0] }}</b-form-invalid-feedback
              >
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{
              $store.state.passport_expiry_date
            }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.passport_expiry_date"
              rules="required"
              vid="passport_expiry_date"
            >
              <b-form-datepicker
                v-model="form.passport_expiry_date"
                class="text-end"
                id="passport_expiry_date"
                size="md"
                :placeholder="$store.state.enterPassportExpiryDate"
              ></b-form-datepicker>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
                >{{ validationContext.errors[0] }}</b-form-invalid-feedback
              >
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{
              $store.state.residence_expiry_date
            }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.residence_expiry_date"
              rules="required"
              vid="residence_expiry_date"
            >
              <b-form-datepicker
                v-model="form.residence_expiry_date"
                class="text-end"
                id="residence_expiry_date"
                size="md"
                :placeholder="$store.state.enterResidenceExpiryDate"
              ></b-form-datepicker>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
                >{{ validationContext.errors[0] }}</b-form-invalid-feedback
              >
            </validation-provider>
          </b-col>
        </b-row>
        <b-row class="my-1 text-end mb-3">
          <b-col>
            <label for="input-small">{{ $store.state.sub_company }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.sub_company"
              rules=""
              vid="sub_company"
            >
              <v-select
                id="sub_company"
                v-model="form.sub_company"
                size="md"
                dir="rtl"
                :placeholder="$store.state.enterSubCompany"
                :options="subCompaniesDropdownGetter"
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
            <label for="input-small">{{ $store.state.main_company }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.main_company"
              rules="required"
              vid="main_company"
            >
              <v-select
                id="main_company"
                v-model="form.company"
                size="md"
                dir="rtl"
                :placeholder="$store.state.enterMainCompany"
                :options="companiesDropdownGetter"
                @input="getSubCompanies"
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
            <label for="input-small">{{ $store.state.supervisor }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.supervisor"
              vid="supervisor"
            >
              <v-select
                id="supervisor"
                v-model="form.supervisor"
                size="md"
                dir="rtl"
                :placeholder="$store.state.enterSupervisor"
                :options="superVisorsDropdownGetter"
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
            <label for="input-small">{{ $store.state.address }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.address"
              rules="required"
              vid="address"
            >
              <b-form-textarea
                id="address"
                v-model="form.address"
                class="text-end"
                :placeholder="$store.state.enterEmployeeAddress"
                rows="3"
                max-rows="6"
              ></b-form-textarea>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
                >{{ validationContext.errors[0] }}</b-form-invalid-feedback
              >
            </validation-provider>
          </b-col>
        </b-row>
        <b-row class="my-1 text-end mb-3">
          <b-col>
            <label for="input-small">{{ $store.state.postal_code }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.postal_code"
              rules="required"
              vid="postal_code"
            >
              <b-form-input
                v-model="form.postal_code"
                class="text-end"
                id="postal_code"
                size="md"
                :placeholder="$store.state.enterPostalCode"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
                >{{ validationContext.errors[0] }}</b-form-invalid-feedback
              >
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.city }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.city"
              rules="required"
              vid="city"
            >
              <b-form-input
                v-model="form.city"
                class="text-end"
                id="city"
                size="md"
                :placeholder="$store.state.enterCity"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
                >{{ validationContext.errors[0] }}</b-form-invalid-feedback
              >
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.country }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.country"
              rules="required"
              vid="country"
            >
              <b-form-input
                v-model="form.country"
                class="text-end"
                id="country"
                size="md"
                :placeholder="$store.state.enterCountry"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
                >{{ validationContext.errors[0] }}</b-form-invalid-feedback
              >
            </validation-provider>
          </b-col>
        </b-row>
        <b-row class="my-1 text-end mb-3">
          <b-col>
            <label for="input-small">{{ $store.state.passport_number }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.passport_number"
              rules="required"
              vid="passport_number"
            >
              <b-form-input
                v-model="form.passport_number"
                class="text-end"
                id="passport_number"
                size="md"
                :placeholder="$store.state.enterPassportNumber"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.civil_id }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.civil_id"
              rules="required|integer|max:12"
              vid="civil_id"
            >
              <b-form-input
                v-model="form.civil_id"
                class="text-end"
                id="civil_id"
                size="md"
                :placeholder="$store.state.enterCivilId"
              ></b-form-input>
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
            <label for="input-small">{{ $store.state.phone }}</label>
            <validation-provider
              v-slot="validationContext"
              rules="integer|min:5|max:20"
              :name="$store.state.phoneNumber"
              vid="phone3"
            >
              <b-form-input
                v-model="form.phone3"
                class="text-end"
                id="phone3"
                size="md"
                :placeholder="$store.state.enterThirdPhoneNumber"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small"></label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.phoneNumber"
              rules="integer|min:5|max:20"
              vid="phone2"
            >
              <b-form-input
                v-model="form.phone2"
                class="text-end"
                id="phone2"
                size="md"
                :placeholder="$store.state.enterSecondPhoneNumber"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.phoneNumbers }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.phoneNumber"
              rules="required|integer|min:5|max:20"
              vid="phone1"
            >
              <b-form-input
                v-model="form.phone1"
                class="text-end"
                id="phone1"
                size="md"
                :placeholder="$store.state.enterFirstPhoneNumber"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-row>
        <b-form-row class="my-1 mb-3 text-end">
          <b-col>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.attachments"
              rules="size:5120"
              vid="attachments"
            >
              <b-form-group
                :label="$store.state.attachments"
                label-for="attachments"
              >
                <template #label>
                  <span>{{ $store.state.attachments }}</span>
                </template>
                <span v-show="isThereOriginalAttachment">
                  <b-link
                    v-for="attachmant of form.original_attachment"
                    :key="attachmant.id"
                    :href="`${$store.state.baseUrl}${attachmant.attachment_path}`"
                    target="_blank"
                  >
                    <i class="fa fa-link" style="font-size: 12px"></i>
                  </b-link>
                </span>

                <b-input-group class="text-end">
                  <b-form-file
                    class="ms-auto"
                    multiple
                    v-model="form.attachments"
                    :browse-text="$store.state.chooseFiles"
                    :drop-placeholder="$store.state.chooseFiles"
                    :placeholder="$store.state.chooseFiles"
                    accept=".jpg, .jpeg, .png, .webp, .docx, .pdf"
                  ></b-form-file>
                  <b-input-group-append>
                    <b-button
                      :disabled="
                        form.attachments == null &&
                        form.original_attachment == null
                      "
                      variant="danger"
                      @click="clearAttachments"
                      ><i class="fa fa-times-circle"></i
                    ></b-button>
                  </b-input-group-append>
                  <b-form-invalid-feedback
                    :state="getValidationState(validationContext)"
                  >
                    {{ validationContext.errors[0] }}
                  </b-form-invalid-feedback>
                </b-input-group>
              </b-form-group>
            </validation-provider>
          </b-col>
        </b-form-row>
        <b-row class="my-1 text-end mb-3">
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

export default {
  name: 'AddCompanyView',
  emits: ['updatedSuccessfully', 'updatedError'],
  props: ['userData'],
  mounted() {
    for (let i in this.userData) {
      if (i == 'attachments') {
        this.form['original_attachment'] = this.userData[i];
        this.form.attachments = null;
        continue;
      }
      if (i == 'phones') {
        this.form.phone1 = this.userData[i][0]?.phone || '';
        this.form.phone2 = this.userData[i][1]?.phone || '';
        this.form.phone3 = this.userData[i][2]?.phone || '';
        continue;
      }
      this.form[i] = this.userData[i];
    }
    this.isThereOriginalAttachment = true;
    console.log(this.form);
  },
  data() {
    return {
      isSubmitted: false,
      form: {
        name: '',
        name_ar: '',
        email: '',
        password: 'password',
        nationality: '',
        nationality_ar: '',
        passport_number: '',
        address: '',
        city: '',
        country: '',
        postal_code: '',
        civil_id: '',
        passport_expiry_date: '',
        residence_expiry_date: '',
        expired_at: '',
        avatar: null,
        company_id: '',
        sub_company_id: '',
        role_id: 3,
        supervisor: '',
        attachments: null,
        phone1: '',
        phone2: '',
        phone3: '',
        original_attachment: null,
      },
      isThereOriginalAttachment: false,
    };
  },
  computed: {
    ...mapGetters('companies', [
      'companiesDropdownGetter',
      'subCompaniesDropdownGetter',
      'superVisorsDropdownGetter',
    ]),
    checkAttachments() {
      return !this.form.attachments;
    },
  },
  methods: {
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    onSubmit() {
      console.log('form', this.form);
      this.isSubmitted = true;
      const formData = new FormData();
      if (this.form.attachments) {
        for (let i = 0; i < this.form.attachments.length; i++) {
          formData.append('attachments[]', this.form.attachments[i]);
        }
      }

      for (let i in this.form) {
        if (i == 'attachments') {
          continue;
        }
        if (i == 'company') {
          formData.append('company_id', this.form[i]?.id);
          continue;
        }
        if (i == 'sub_company') {
          if (!this.form[i]) {
            formData.append('sub_company_id', '');
            continue;
          }
          formData.append('sub_company_id', this.form[i]?.id);
          continue;
        }
        if (i == 'supervisor') {
          if (!this.form[i]) {
            console.log('from super');
            formData.append(i, '');
            continue;
          }
          formData.append(i, this.form[i]?.id);
          continue;
        }
        if (i == 'name' && !this.form[i]) {
          formData.append(i, this.form['name_ar']);
          continue;
        }
        if (i == 'email' && !this.form[i]) {
          const email = crypto.randomUUID().substring(0, 8) + '@gmail.com';
          formData.append(i, email);
          continue;
        }
        formData.append(i, this.form[i]);
      }
      formData.append('_method', 'PUT');
      this.$axios
        .post(`users/${this.userData.id}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then((_) => {
          this.$emit('updatedSuccessfully');
        })
        .catch((errors) => {
          this.$emit('updatedError', errors);
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
    clearAttachments() {
      this.form.attachments = null;
      this.form.original_attachment = null;
    },
    updatedSuccessfully() {
      this.$emit('updatedSuccessfully');
    },
    updatedError(errors) {
      this.$emit('updatedError', errors);
    },
    getSubCompanies(company) {
      this.form.sub_company = null;
      this.$axios.get(`companies/${company.id}/sub_companies`).then((res) => {
        this.$store.commit('companies/setSubCompaniesDropdown', res.data);
      });
    },
  },
};
</script>

<style>
@import 'vue-select/dist/vue-select.css';
@import '@/assets/common.css';
</style>

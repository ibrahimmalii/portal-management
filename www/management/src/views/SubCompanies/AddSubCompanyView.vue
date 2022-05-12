<template>
  <div>
    <ValidationObserver ref="observer" class="w-50" v-slot="{ handleSubmit }">
      <b-form @submit.prevent="handleSubmit(onSubmit)">
        <b-row class="my-1 text-end mb-3">
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
              rules="required"
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
            <label for="input-small">{{ $store.state.license_number }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.license_number"
              rules="required|numeric"
              vid="license_number"
            >
              <b-form-input
                id="license_number"
                v-model="form.license_number"
                class="text-end"
                size="md"
                :placeholder="$store.state.enterLicenseNumber"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.central_number }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.central_number"
              rules="required|numeric"
              vid="central_number"
            >
              <b-form-input
                v-model="form.central_number"
                class="text-end"
                id="central_number"
                size="md"
                :placeholder="$store.state.enterCentralNumber"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{
              $store.state.civil_authority_number
            }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.civil_authority_number"
              rules="required|numeric"
              vid="civil_authority_number"
            >
              <b-form-input
                id="civil_authority_number"
                v-model="form.civil_authority_number"
                class="text-end"
                :placeholder="$store.state.enterCivilAuthorityNumber"
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
            <label for="input-small">{{
              $store.state.commercial_register_number
            }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.commercial_register_number"
              rules="required|numeric"
              vid="commercial_register_number"
            >
              <b-form-input
                v-model="form.commercial_register_number"
                class="text-end"
                id="commercial_register_number"
                size="md"
                :placeholder="$store.state.enterCommercialRegisterNumber"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
              >
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{
              $store.state.address_automatic_number
            }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.address_automatic_number"
              rules="required|numeric"
              vid="address_automatic_number"
            >
              <b-form-input
                v-model="form.address_automatic_number"
                class="text-end"
                id="address_automatic_number"
                size="md"
                :placeholder="$store.state.enterAddressAutomaticNumber"
              ></b-form-input>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
                >{{ validationContext.errors[0] }}</b-form-invalid-feedback
              >
            </validation-provider>
          </b-col>
          <b-col>
            <label for="input-small">{{ $store.state.file_number }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.file_number"
              rules="required|numeric"
              vid="file_number"
            >
              <b-form-input
                v-model="form.file_number"
                class="text-end"
                id="file_number"
                size="md"
                :placeholder="$store.state.enterFileNumber"
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
              $store.state.date_of_issuance_of_license
            }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.date_of_issuance_of_license"
              rules="required"
              vid="date_of_issuance_of_license"
            >
              <b-form-datepicker
                v-model="form.date_of_issuance_of_license"
                class="text-end"
                id="date_of_issuance_of_license"
                size="md"
                :placeholder="$store.state.enterDateOfIssuanceOfLicense"
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
            <label for="input-small">{{ $store.state.license_address }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.license_address"
              rules="required"
              vid="license_address"
            >
              <b-form-textarea
                id="license_address"
                v-model="form.license_address"
                class="text-end"
                :placeholder="$store.state.enterLicenseAddress"
                rows="3"
                max-rows="6"
              ></b-form-textarea>
              <b-form-invalid-feedback
                :state="getValidationState(validationContext)"
                >{{ validationContext.errors[0] }}</b-form-invalid-feedback
              >
            </validation-provider>
          </b-col>
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
                :placeholder="$store.state.enterAddress"
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
            <label for="input-small">{{ $store.state.description }}</label>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.description"
              rules="required"
              vid="description"
            >
              <b-form-textarea
                id="description"
                v-model="form.description"
                class="text-end"
                :placeholder="$store.state.enterDescription"
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
        <b-form-row class="my-1 mb-3 text-end">
          <b-col>
            <validation-provider
              v-slot="validationContext"
              :name="$store.state.attachments"
              rules="required|size:5120"
              vid="attachments"
            >
              <b-form-group
                :label="$store.state.attachments"
                label-for="attachments"
              >
                <template #label>
                  <span>{{ $store.state.attachments }}</span>
                </template>
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
                      :disabled="checkAttachments"
                      variant="danger"
                      @click="form.attachments = null"
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
export default {
  name: 'AddCompanyView',
  emits: ['addedSuccessfully', 'addeddError'],
  data() {
    return {
      isSubmitted: false,
      form: {
        company_id: null,
        name: '',
        name_ar: '',
        liecense_number: '',
        license_address: '',
        date_of_issuance_of_license: '',
        file_number: '',
        civil_authority_number: '',
        commercial_register_number: '',
        address_automatic_number: '',
        description: '',
        address: '',
        expired_at: '',
        attachments: null,
      },
    };
  },
  watch: {
    form(value) {
      console.log(value);
    },
    companiesDropdownGetter(value) {
      console.log(value);
    },
  },
  computed: {
    ...mapGetters('companies', ['companiesDropdownGetter']),
    checkAttachments() {
      return !this.form.attachments;
    },
  },
  methods: {
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    onSubmit() {
      this.isSubmitted = true;
      const formData = new FormData();
      for (let i = 0; i < this.form.attachments.length; i++) {
        formData.append('attachments[]', this.form.attachments[i]);
      }

      for (let i in this.form) {
        if (i == 'attachments') {
          continue;
        }
        if (i == 'company_id') {
          formData.append(i, this.form[i].id);
          continue;
        }
        formData.append(i, this.form[i]);
      }
      this.$axios
        .post('/subCompanies', formData, {
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
  },
};
</script>

<style>
@import 'vue-select/dist/vue-select.css';
@import '@/assets/common.css';
</style>

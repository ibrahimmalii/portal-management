<template>
  <div class="mb-5">
    <the-title
      :title="$store.state.main_company_details"
      :type="$store.state.browse"
    ></the-title>
    <b-card v-if="!isLoaded" :title="companyName" :sub-title="companyAr">
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.license_number }}</label>
          <b-form-input
            id="license_number"
            class="text-end"
            size="md"
            :value="licenseNum"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{
            $store.state.address_automatic_number
          }}</label>
          <b-form-input
            id="addressAutomaticNum"
            class="text-end"
            size="md"
            :value="addressAutomaticNum"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.central_number }}</label>
          <b-form-input
            id="centralNum"
            class="text-end"
            size="md"
            :value="centralNum"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{
            $store.state.civil_authority_number
          }}</label>
          <b-form-input
            id="civilAuthNum"
            class="text-end"
            size="md"
            :value="civilAuthNum"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{
            $store.state.commercial_register_number
          }}</label>
          <b-form-input
            id="commercialRegister"
            class="text-end"
            size="md"
            :value="commercialRegister"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{ $store.state.file_number }}</label>
          <b-form-input
            id="fileNum"
            class="text-end"
            size="md"
            :value="fileNum"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{
            $store.state.date_of_issuance_of_license
          }}</label>
          <b-form-input
            id="dateOfIssuance"
            class="text-end"
            size="md"
            :value="dateOfIssuance"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{ $store.state.created_at }}</label>
          <b-form-input
            id="createdAt"
            class="text-end"
            size="md"
            :value="createdAt"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{ $store.state.expired_at }}</label>
          <b-form-input
            id="expiredAt"
            class="text-end"
            size="md"
            :value="expiredAt"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.address }}</label>
          <b-form-textarea
            id="address"
            class="text-end"
            size="md"
            :value="address"
            disabled
          ></b-form-textarea>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.license_address }}</label>
          <b-form-textarea
            id="licenseAddr"
            class="text-end"
            size="md"
            :value="licenseAddr"
            disabled
          ></b-form-textarea>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.description }}</label>
          <b-form-textarea
            id="description"
            class="text-end"
            size="md"
            :value="description"
            disabled
          ></b-form-textarea>
        </b-col>
      </b-row>
      <b-card-text
        >{{ $store.state.attachments }}:
        <b-link
          v-for="attachmant of attachments"
          :key="attachmant.id"
          :href="`${$store.state.baseUrl}${attachmant.attachment_path}`"
          target="_blank"
        >
          <i class="fa fa-link" style="font-size: 12px"></i>
        </b-link>
      </b-card-text>
      <!-- <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.sub_companies }}</label>
          <v-select
            id="sub_companies"
            :options="subCompanies"
            :placeholder="$store.state.sub_companies"
            size="md"
            dir="rtl"
            label="name_ar"
          ></v-select>
        </b-col>
        <b-col>
          <label for="input-small">{{ $store.state.employees }}</label>
          <v-select
            id="employees"
            :options="users"
            :placeholder="$store.state.employees_of_company"
            size="md"
            dir="rtl"
            label="name"
            v-model="userSelectValue"
            :disabled="!isUserDataLoaded"
          ></v-select>
        </b-col>
      </b-row> -->
    </b-card>
    <b-card class="text-center" v-else>
      <b-spinner variant="primary" label="Spinning"></b-spinner>
    </b-card>

    <the-title :title="$store.state.sub_companies"></the-title>
    <the-copy-sub-companies-grid
      :data="subCompanies"
    ></the-copy-sub-companies-grid>
    <the-title :title="$store.state.employees"></the-title>
    <the-copy-employee-grid :data="users"></the-copy-employee-grid>
    <!-- <the-employee-details :userData="userData"></the-employee-details> -->
  </div>
</template>

<script>
import TheEmployeeDetails from '@/components/Employees/TheEmployeeDetails.vue';
import TheCopyEmployeeGrid from '@/components/Employees/TheCopyGrid.vue';
import TheCopySubCompaniesGrid from '@/components/Companies/TheCopyGrid.vue';

export default {
  name: 'company',
  components: {
    TheEmployeeDetails,
    TheCopySubCompaniesGrid,
    TheCopyEmployeeGrid,
  },
  data() {
    return {
      isLoaded: false,
      isUserDataLoaded: true,
      companyName: '',
      companyAr: '',
      licenseNum: '',
      licenseAddr: '',
      address: '',
      addressAutomaticNum: '',
      centralNum: '',
      civilAuthNum: '',
      commercialRegister: '',
      createdAt: '',
      dateOfIssuance: '',
      description: '',
      expiredAt: '',
      fileNum: '',
      attachments: [],
      subCompanies: [],
      users: [],
      userSelectValue: null,
      userData: null,
    };
  },
  mounted() {
    this.loadCompanyData(this.$route.params.id);
  },
  watch: {
    userSelectValue(value) {
      if (value) {
        this.loadUserData(value.id);
      }
    },
  },
  methods: {
    convertToDate(date) {
      return new Date(date).toLocaleDateString();
    },
    loadCompanyData(id) {
      this.isLoaded = true;
      this.$axios
        .get('/companies/' + id)
        .then((res) => {
          const company = res.data;
          this.companyName = company.name;
          this.companyAr = company.name_ar;
          this.licenseNum = company.license_number;
          this.licenseAddr = company.license_address;
          this.address = company.address;
          this.addressAutomaticNum = company.address_automatic_number;
          this.centralNum = company.central_number;
          this.civilAuthNum = company.civil_authority_number;
          this.commercialRegister = company.commercial_register_number;
          this.createdAt = this.convertToDate(company.created_at);
          this.dateOfIssuance = this.convertToDate(
            company.date_of_issuance_of_license
          );
          this.description = company.description;
          this.expiredAt = this.convertToDate(company.expired_at);
          this.fileNum = company.file_number;
          this.attachments = company.attachments;
          this.subCompanies = company.sub_companies;
          this.users = company.users;
        })
        .catch(console.error)
        .finally(() => {
          this.isLoaded = false;
        });
    },
    loadUserData(id) {
      console.log('called');
      this.isUserDataLoaded = false;
      this.$axios
        .get(`users/${id}`)
        .then((res) => {
          this.userData = res.data;
        })
        .catch(console.error)
        .finally(() => {
          this.isUserDataLoaded = true;
        });
    },
  },
};
</script>

<style>
@import 'vue-select/dist/vue-select.css';
@import '@/assets/common.css';
</style>

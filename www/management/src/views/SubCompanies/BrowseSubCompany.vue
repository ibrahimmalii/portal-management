<template>
  <div class="mb-5">
    <the-title
      :title="$store.state.sub_company_details"
      :type="$store.state.browse"
    ></the-title>
    <b-card v-if="!isLoaded" :title="companyName" :sub-title="companyAr">
      <b-card-text>
        {{ $store.state.main_company }}:
        <router-link
          :to="{ name: 'browse-company', params: { id: mainCompany.id } }"
        >
          {{ mainCompany?.name }}
        </router-link>
      </b-card-text>
      <b-card-text>
        {{ $store.state.description }}:
        {{ description }}
      </b-card-text>
      <b-card-text>{{ $store.state.address }}: {{ address }}</b-card-text>
      <b-card-text
        >{{ $store.state.license_address }}: {{ licenseAddr }}</b-card-text
      >
      <b-card-text
        >{{ $store.state.license_number }}: {{ licenseNum }}</b-card-text
      >
      <b-card-text
        >{{ $store.state.address_automatic_number }}:
        {{ addressAutomaticNum }}</b-card-text
      >
      <b-card-text
        >{{ $store.state.central_number }}: {{ centralNum }}</b-card-text
      >
      <b-card-text
        >{{ $store.state.civil_authority_number }}:
        {{ civilAuthNum }}</b-card-text
      >
      <b-card-text
        >{{ $store.state.commercial_register_number }}:
        {{ commercialRegister }}</b-card-text
      >
      <b-card-text>{{ $store.state.file_number }}: {{ fileNum }}</b-card-text>
      <b-card-text
        >{{ $store.state.date_of_issuance_of_license }}:
        {{ dateOfIssuance }}</b-card-text
      >
      <b-card-text>{{ $store.state.created_at }}: {{ createdAt }}</b-card-text>
      <b-card-text>{{ $store.state.expired_at }}: {{ expiredAt }}</b-card-text>
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
    </b-card>
    <b-card class="text-center" v-else>
      <b-spinner variant="primary" label="Spinning"></b-spinner>
    </b-card>
  </div>
</template>

<script>
export default {
  name: 'company',
  data() {
    return {
      isLoaded: false,
      mainCompany: '',
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
    };
  },
  mounted() {
    this.loadCompanyData(this.$route.params.id);
  },
  methods: {
    convertToDate(date) {
      return new Date(date).toLocaleDateString();
    },
    loadCompanyData(id) {
      this.isLoaded = true;
      this.$axios
        .get('/subCompanies/' + id)
        .then((res) => {
          const company = res.data;
          this.mainCompany = company.company;
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
        })
        .catch(console.error)
        .finally(() => {
          this.isLoaded = false;
        });
    },
  },
};
</script>

<style></style>

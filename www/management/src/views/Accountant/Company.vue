<template>
  <div class="login mt-5 d-flex justify-content-center col">
    <b-card :title="companyName" :sub-title="companyAr">
      <b-card-text>
          الوصف: 
         {{description}}
      </b-card-text>
      <b-card-text>العنوان: {{address}}</b-card-text>
      <b-card-text>عنوان الترخيص: {{licenseAddr}}</b-card-text>
      <b-card-text>رقم الترخيص: {{licenseNum}}</b-card-text>
      <b-card-text>الرقم التلقائي للعنوان: {{addressAutomaticNum}}</b-card-text>
      <b-card-text>الرقم المركزي: {{centralNum}}</b-card-text>
      <b-card-text>رقم السلطة المدنية: {{civilAuthNum}}</b-card-text>
      <b-card-text>رقم السجل التجاري: {{commercialRegister}}</b-card-text>
      <b-card-text>رقم الملف: {{fileNum}}</b-card-text>
      <b-card-text>تاريخ إصدار الترخيص: {{dateOfIssuance}}</b-card-text>
      <b-card-text>تاريخ الإنشاء: {{createdAt}}</b-card-text>
      <b-card-text>تاريخ الانتهاء: {{expiredAt}}</b-card-text>
    </b-card>
  </div>
</template>

<script>
export default {
  name: 'company',
  data(){
      return {
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
      }
  },
  mounted() {
    console.log('from company')

    const company = JSON.parse(localStorage.user).company;
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
    this.dateOfIssuance = this.convertToDate(company.date_of_issuance_of_license);
    this.description = company.description;
    this.expiredAt = this.convertToDate(company.expired_at);
    this.fileNum = company.file_number;
    console.log(company);
  },
  methods: {
      convertToDate(date){
            return new Date(date).toLocaleDateString();
      }
  },
};
</script>

<style></style>

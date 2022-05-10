<template>
  <div>
    <the-title :title="title" :type="type"></the-title>
    <b-button class="mb-2" v-b-modal.add-company-modal variant="primary">
      {{ add }} <i class="fa fa-plus mr-2"></i>
    </b-button>
    <b-modal
      id="add-company-modal"
      scrollable
      :title="addCompany"
      centered
      hide-footer
      size="xl"
    >
      <add-company-view
        @addedSuccessfully="addeddSuccessfully"
        @addedError="addedError"
        v-if="isDataLoaded"
      >
      </add-company-view>
      <div v-else class="d-flex justify-content-center my-3">
        <b-spinner
          variant="primary"
          type="grow"
          style="width: 3rem; height: 3rem"
        ></b-spinner>
      </div>
    </b-modal>

    <b-modal
      id="edit-company-modal"
      scrollable
      :title="editCompany"
      centered
      hide-footer
      size="xl"
    >
      <edit-company-view
        v-if="isCompanyDataLoaded"
        @updatedSuccessfully="updatedSuccessfully"
        @updatedError="updatedError"
        :company="companyData"
      >
      </edit-company-view>
      <div v-else class="d-flex justify-content-center my-3">
        <b-spinner
          variant="primary"
          type="grow"
          style="width: 3rem; height: 3rem"
        ></b-spinner>
      </div>
    </b-modal>

    <ejs-grid
      v-if="isDataLoaded"
      ref="grid"
      id="Grid"
      :dataSource="data"
      :allowPaging="true"
      :allowSorting="true"
      :allowGrouping="true"
      :pageSettings="pageSettings"
      :allowFiltering="true"
      :toolbar="toolbarOptions"
      :allowPdfExport="true"
      :allowExcelExport="true"
      :toolbarClick="toolbarClick"
      :showColumnMenu="true"
      :filterSettings="filterSettings"
      :groupSettings="groupOptions"
      :allowSelection="true"
      :allowRowDragAndDrop="true"
      :selectionSettings="selectionOptions"
      :rowDropSettings="srcDropOptions"
      :enableRtl="true"
      locale="ar"
    >
      <e-columns>
        <e-column
          :headerText="$store.state.actions"
          :template="cTemplate"
          textAlign="Right"
          width="100"
        ></e-column>
        <e-column
          field="company.name"
          :headerText="$store.state.main_company"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="name"
          :headerText="$store.state.name"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="name_ar"
          :headerText="$store.state.arabicName"
          textAlign="Right"
          width="120"
        ></e-column>
        <e-column
          field="license_number"
          :headerText="$store.state.license_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="central_number"
          :headerText="$store.state.central_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="civil_authority_number"
          :headerText="$store.state.civil_authority_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="commercial_register_number"
          :headerText="$store.state.commercial_register_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="address_automatic_number"
          :headerText="$store.state.address_automatic_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="date_of_issuance_of_license"
          :headerText="$store.state.date_of_issuance_of_license"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="expired_at"
          :headerText="$store.state.expired_at"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="license_address"
          :headerText="$store.state.license_address"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="address"
          :headerText="$store.state.address"
          textAlign="Right"
          width="90"
        ></e-column>
      </e-columns>
    </ejs-grid>
    <div v-else class="text-center mt-5 mb-3 d-flex justify-content-center">
      <b-spinner variant="primary"></b-spinner>
    </div>

    <ejs-grid
      class="my-5"
      ref="destGrid"
      id="DestGrid"
      :dataSource="destData"
      :allowSorting="true"
      :allowGrouping="true"
      :allowFiltering="true"
      :toolbar="toolbarOptions"
      :allowPdfExport="true"
      :allowExcelExport="true"
      :toolbarClick="toolbarClick"
      :showColumnMenu="true"
      :filterSettings="filterSettings"
      :groupSettings="groupOptions"
      :allowPaging="true"
      :pageSettings="pageOptions"
      :allowSelection="true"
      :allowRowDragAndDrop="true"
      :selectionSettings="selectionOptions"
      :rowDropSettings="destDropOptions"
      :enableRtl="true"
      locale="ar"
    >
      <e-columns>
        <e-column
          field="company.name"
          :headerText="$store.state.main_company"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="name"
          :headerText="$store.state.name"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="name_ar"
          :headerText="$store.state.arabicName"
          textAlign="Right"
          width="120"
        ></e-column>
        <e-column
          field="license_number"
          :headerText="$store.state.license_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="central_number"
          :headerText="$store.state.central_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="civil_authority_number"
          :headerText="$store.state.civil_authority_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="commercial_register_number"
          :headerText="$store.state.commercial_register_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="address_automatic_number"
          :headerText="$store.state.address_automatic_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="date_of_issuance_of_license"
          :headerText="$store.state.date_of_issuance_of_license"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="expired_at"
          :headerText="$store.state.expired_at"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="license_address"
          :headerText="$store.state.license_address"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="address"
          :headerText="$store.state.address"
          textAlign="Right"
          width="90"
        ></e-column>
      </e-columns>
    </ejs-grid>

    <ejs-toast
      ref="successToast"
      cssClass="e-toast-success"
      :position="toastPosition"
      :content="$store.state.successAdd"
      :showProgressBar="true"
      timeOut="1500"
      :showCloseButton="true"
      progressDirection="rtl"
      :enableRtl="true"
      :beforeOpen="beforeSuccessToastOpen"
    ></ejs-toast>

    <ejs-toast
      ref="errorToast"
      cssClass="e-toast-danger"
      :position="toastPosition"
      :content="$store.state.errorAdd"
      :showProgressBar="true"
      timeOut="1500"
      :showCloseButton="true"
      progressDirection="rtl"
      :enableRtl="true"
      :beforeOpen="beforeErrorToastOpen"
    ></ejs-toast>
  </div>
</template>

<script>
import gridMixin from '@/mixins/gridMixin';
import toastMixin from '@/mixins/toastMixin';

import AddCompanyView from './AddSubCompanyView.vue';
import EditCompanyView from './EditSubCompanyView.vue';
import SubCompanyActionsVue from './SubCompanyActions.vue';

import eventBus from '@/eventBus';

import { mapGetters, mapActions } from 'vuex';

export default {
  mixins: [gridMixin, toastMixin],
  components: {
    AddCompanyView,
    EditCompanyView,
  },
  mounted() {
    this.getCompaniesDropdown();
    eventBus.$on('delete-sub-company', this.deleteCompany);
    eventBus.$on('edit-sub-company', this.loadCompanyData);
    this.getCompanies();
  },
  data() {
    return {
      position: { X: 'Right', Y: 'Bottom' },
      destData: [],
      title: 'الشركات الفرعية',
      type: 'شركة جديدة',
      addCompany: 'إضافة شركة جديدة',
      editCompany: 'تعديل شركة',
      add: 'إضافة',
      isDataLoaded: false,
      isCompanyDataLoaded: false,
      data: [],
      companyData: [],
      cTemplate: function () {
        return { template: SubCompanyActionsVue };
      },
    };
  },
  methods: {
    ...mapActions('companies', ['getCompaniesDropdown']),
    getCompanies() {
      this.$axios
        .get('subCompanies')
        .then((res) => {
          this.data = res.data;
          this.isDataLoaded = true;
        })
        .catch(console.error)
        .finally(() => {
          this.isDataLoaded = true;
        });
    },
    loadCompanyData(data) {
      this.isCompanyDataLoaded = false;
      this.$bvModal.show('edit-company-modal');
      this.$axios
        .get(`subCompanies/${data.id}`)
        .then((res) => {
          this.companyData = res.data;
          this.isCompanyDataLoaded = true;
        })
        .catch(console.error)
        .finally(() => {
          this.isCompanyDataLoaded = true;
        });
    },
    addeddSuccessfully() {
      this.$bvModal.hide('add-company-modal');
      this.getCompanies();
      this.$refs.successToast.show({
        template: this.$store.state.successAdd,
      });
    },
    addedError() {
      console.log(this.$bvModal.hide());
      this.$bvModal.hide('add-company-modal');
      this.getCompanies();
      this.$refs.errorToast.show({
        template: this.$store.state.errorAdd,
      });
    },
    deleteCompany(data) {
      this.$axios
        .delete(`subCompanies/${data.id}`)
        .then(() => {
          eventBus.$emit('sub-company-deleted', data.id);
          this.$refs.successToast.show({
            template: this.$store.state.successClear,
          });
          this.getCompanies();
        })
        .catch((error) => {
          eventBus.$emit('company-deleted', data.id);
          if (error.response.data.error)
            this.$refs.errorToast.show({
              template: this.$store.state.errorDelete,
            });
          else
            this.$refs.errorToast.show({
              template: this.$store.state.errorDelete,
            });
        });
    },
    updatedSuccessfully() {
      this.$bvModal.hide('edit-company-modal');
      this.getCompanies();
      this.$refs.successToast.show({
        template: this.$store.state.successUpdate,
      });
    },
    updatedError() {
      this.$bvModal.hide('edit-company-modal');
      this.getCompanies();
      this.$refs.errorToast.show({
        template: this.$store.state.errorUpdate,
      });
    },
  },
  computed: {
    ...mapGetters('companies', ['companiesDropdownGetter']),
  },
};
</script>

<style>
@import '../../../node_modules/@syncfusion/ej2-base/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-buttons/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-calendars/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-dropdowns/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-inputs/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-navigations/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-popups/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-splitbuttons/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-base/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-notifications/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css';
@import '@/assets/common.css';
</style>

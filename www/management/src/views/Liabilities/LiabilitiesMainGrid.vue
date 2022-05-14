<template>
  <div id="app">
    <the-title :title="$store.state.liabilities"></the-title>
    <b-button class="mb-2" v-b-modal.add-liability-modal variant="primary">
      {{ $store.state.add }} <i class="fa fa-plus mr-2"></i>
    </b-button>
    <b-modal
      id="add-liability-modal"
      scrollable
      :title="addLiability"
      centered
      hide-footer
      size="xl"
    >
      <add-liability-view
        @addedSuccessfully="addedSuccessfully"
        @addedError="addedError"
        v-if="!isLoading"
      >
      </add-liability-view>
      <div v-else class="d-flex justify-content-center my-3">
        <b-spinner
          variant="primary"
          type="grow"
          style="width: 3rem; height: 3rem"
        ></b-spinner>
      </div>
    </b-modal>

    <!-- <b-modal
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
    </b-modal> -->

    <ejs-grid
      v-if="!isLoading"
      ref="liabilityGrid"
      id="LiabilityGrid"
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
      :detailTemplate="detailTemplate"
      :enableRtl="true"
      locale="ar"
      :allowResizing="true"
    >
      <e-columns>
        <e-column
          :headerText="$store.state.id"
          field="id"
          isPrimaryKey="true"
          type="number"
        ></e-column>
        <e-column field="user.name_ar" headerText="الموظف"></e-column>
        <e-column
          field="company.name_ar"
          :headerText="$store.state.main_company"
          type="object"
        ></e-column>
        <e-column
          field="sub_company.name_ar"
          :headerText="$store.state.sub_company"
        ></e-column>
        <e-column
          field="created_at"
          :headerText="$store.state.created_at"
          :format="dateFormatOptions"
          type="dateTime"
        ></e-column>
        <e-column
          field="total_amount"
          :headerText="$store.state.original_amount"
          type="number"
        ></e-column>
        <e-column
          field="remaining_amount"
          :headerText="$store.state.remaining_amount"
          type="number"
        ></e-column>
        <e-column
          class="flex-grow-1"
          :headerText="$store.state.status"
          :template="pTemplate"
          textAlign="Left"
          type="boolean"
        ></e-column>
      </e-columns>
    </ejs-grid>
    <div v-else class="text-center mt-5 mb-3 d-flex justify-content-center">
      <b-spinner variant="primary"></b-spinner>
    </div>
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
import { mapActions } from 'vuex';
import gridMixin from '@/mixins/gridMixin';
import DetailsTemplate from './DetailsTemplate.vue';
import PaidTemplate from './PaidTemplate.vue';
import LinkTemplate from '@/components/Templates/LinkTemplate.vue';
import LiabilityActionsVue from './LiabilityActions.vue';
import AddLiabilityView from './AddLiabilityView.vue';
import toastMixin from '@/mixins/toastMixin';

export default {
  mixins: [gridMixin, toastMixin],
  components: {
    LiabilityActionsVue,
    AddLiabilityView,
  },
  mounted() {
    this.loadLiabilities();
    this.getCompaniesDropdown();
    this.getSubCompaniesDropdown();
    this.getUsersDropdown();
    this.getProducts();
  },

  data() {
    return {
      data: [],
      isLoading: true,
      detailTemplate: function (data) {
        return { template: DetailsTemplate, data };
      },
      pTemplate: function (data) {
        return { template: PaidTemplate, data };
      },
      linkTemplate: function (fields) {
        return { template: LinkTemplate, props: { nameFields: fields } };
      },
      addLiability: 'اضافة عقد جديد',
    };
  },
  methods: {
    ...mapActions('companies', [
      'getCompaniesDropdown',
      'getSubCompaniesDropdown',
      'getUsersDropdown',
      'getProducts',
    ]),
    loadLiabilities() {
      this.$axios
        .get('liabilities')
        .then((response) => {
          this.data = response.data;
        })
        .catch(console.error)
        .finally(() => {
          this.isLoading = false;
        });
    },
    addedSuccessfully() {
      this.$bvModal.hide('add-liability-modal');
      this.loadEmployeesData();
      this.$refs.successToast.show({
        template: this.$store.state.successAdd,
      });
    },
    addedError(errors) {
      console.log(errors.response.data.message);
      this.$refs.errorToast.show({
        template: errors.response.data.message,
      });
    },
    updatedSuccessfully() {
      this.$bvModal.hide('edit-employee-modal');
      this.loadEmployeesData();
      this.$refs.successToast.show({
        template: this.$store.state.successUpdate,
      });
    },
    updatedError(errors) {
      console.log(errors.response.data.message);
      this.$refs.errorToast.show({
        template: errors.response.data.message,
      });
    },
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
@import '../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-splitbuttons/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-base/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-notifications/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css';
@import '@/assets/common.css';
</style>

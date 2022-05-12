<template>
  <div>
    <the-title :title="$store.state.employees"></the-title>
    <b-button class="mb-2" v-b-modal.add-employee-modal variant="primary">
      {{ add }} <i class="fa fa-plus mr-2"></i>
    </b-button>
    <b-modal
      id="add-employee-modal"
      scrollable
      :title="add_employee"
      centered
      hide-footer
      size="xl"
    >
      <add-employee-view
        @addedSuccessfully="addedSuccessfully"
        @addedError="addedError"
        v-if="isDataLoaded"
      >
      </add-employee-view>
      <div v-else class="d-flex justify-content-center my-3">
        <b-spinner
          variant="primary"
          type="grow"
          style="width: 3rem; height: 3rem"
        ></b-spinner>
      </div>
    </b-modal>

    <b-modal
      id="edit-employee-modal"
      scrollable
      :title="edit_employee"
      centered
      hide-footer
      size="xl"
    >
      <edit-employee-view
        v-if="isEmployeeDataLoaded"
        @updatedSuccessfully="updatedSuccessfully"
        @updatedError="updatedError"
        :userData="userData"
      >
      </edit-employee-view>
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
          field="nationality"
          :headerText="$store.state.nationality_ar"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="passport_number"
          :headerText="$store.state.passport_number"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="city"
          :headerText="$store.state.city"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="country"
          :headerText="$store.state.country"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="postal_code"
          :headerText="$store.state.postal_code"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="civil_id"
          :headerText="$store.state.civil_id"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="passport_expiry_date"
          :headerText="$store.state.passport_expiry_date"
          textAlign="Right"
          width="90"
        ></e-column>
        <e-column
          field="residence_expiry_date"
          :headerText="$store.state.residence_expiry_date"
          textAlign="Right"
          width="90"
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
import gridMixin from '@/mixins/gridMixin';
import toastMixin from '@/mixins/toastMixin';
import EmployeesActions from './EmployeesActions.vue';
import AddEmployeeView from './AddEmployeeView.vue';
import EditEmployeeView from './EditEmployeeView.vue';
import eventBus from '@/eventBus';

export default {
  mixins: [gridMixin, toastMixin],
  components: {
    EmployeesActions,
  },
  mounted() {
    eventBus.$on('edit-employee', this.loadEmployeeDetails);
    eventBus.$on('view-employee', this.viewEmployee);
    this.loadEmployeesData();
  },
  components: {
    AddEmployeeView,
    EditEmployeeView,
  },
  data() {
    return {
      position: { X: 'Right', Y: 'Bottom' },
      add_employee: 'إضافة موظف جديد',
      edit_employee: 'تعديل الموظف',
      add: 'إضافة',
      isDataLoaded: false,
      isCompanyDataLoaded: false,
      data: [],
      userData: [],
      cTemplate: function () {
        return { template: EmployeesActions };
      },
      isEmployeeDataLoaded: false,
    };
  },
  methods: {
    loadEmployeesData() {
      this.$axios
        .get('/users')
        .then((response) => {
          this.data = response.data;
        })
        .catch(console.error)
        .finally(() => {
          this.isDataLoaded = true;
        });
    },
    loadEmployeeDetails(data) {
      this.isEmployeeDataLoaded = false;
      this.$bvModal.show('edit-employee-modal');
      this.$axios
        .get(`users/${data.id}`)
        .then((res) => {
          this.userData = res.data;
        })
        .catch(console.error)
        .finally(() => {
          this.isEmployeeDataLoaded = true;
        });
    },
    viewEmployee() {},
    addedSuccessfully() {
      this.$bvModal.hide('add-employee-modal');
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
@import '../../../node_modules/@syncfusion/ej2-splitbuttons/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-base/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-notifications/styles/material.css';
@import '../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css';
@import '@/assets/common.css';
</style>

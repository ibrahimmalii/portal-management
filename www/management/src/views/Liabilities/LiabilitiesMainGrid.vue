<template>
  <div id="app">
    <the-title :title="$store.state.liabilities"></the-title>
    <b-button class="mb-2" v-b-modal.add-employee-modal variant="primary">
      {{ $store.state.add }} <i class="fa fa-plus mr-2"></i>
    </b-button>

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
  </div>
</template>
<script>
import gridMixin from '@/mixins/gridMixin';
import DetailsTemplate from './DetailsTemplate.vue';
import PaidTemplate from './PaidTemplate.vue';
import LinkTemplate from '@/components/Templates/LinkTemplate.vue';

export default {
  mixins: [gridMixin],
  mounted() {
    this.loadLiabilities();
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
    };
  },
  methods: {
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

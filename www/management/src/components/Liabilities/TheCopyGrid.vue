<template>
  <div class="mb-5">
    <ejs-grid
      class="my-5"
      ref="destGrid"
      id="DestGrid"
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
  </div>
</template>

<script>
import gridMixin from '@/mixins/gridMixin';

export default {
  mixins: [gridMixin],
  props: {
    data: {
      type: Array,
      default: () => [],
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

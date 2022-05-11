<template>
  <div class="mb-5">
    <ejs-grid
      class="my-5"
      ref="destGrid"
      id="DestGrid"
      :dataSource="data"
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
  </div>
</template>

<script>
import gridMixin from '@/mixins/gridMixin';

export default {
  mixins: [gridMixin],
  props: ['data'],
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

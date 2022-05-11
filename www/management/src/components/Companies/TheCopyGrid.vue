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

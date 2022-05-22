<template>
  <div>
    <!-- This is liabilities view -->
    <liabilities-main-grid></liabilities-main-grid>
    <liability-dates-grid-view></liability-dates-grid-view>
    <!-- <liability-copy-grid :data="[]"></liability-copy-grid> -->
  </div>
</template>

<script>
import LiabilitiesMainGrid from "./LiabilitiesMainGrid.vue";
import LiabilityDatesGridView from "./LiabilityDatesGridView.vue";
import LiabilityCopyGrid from "@/components/Liabilities/TheCopyGrid.vue";

export default {
  components: {
    LiabilitiesMainGrid,
    LiabilityCopyGrid,
    LiabilityDatesGridView,
  },
};
</script>

<style>
@import "../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-buttons/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-calendars/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-dropdowns/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-navigations/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-popups/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-splitbuttons/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-notifications/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-grids/styles/material.css";
@import "@/assets/common.css";
</style>

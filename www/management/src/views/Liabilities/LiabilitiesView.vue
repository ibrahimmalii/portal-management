<template>
  <div>
    <!-- This is liabilities view -->
    <liabilities-main-grid></liabilities-main-grid>
  </div>
</template>

<script>
import LiabilitiesMainGrid from "./LiabilitiesMainGrid.vue";
import LiabilityCopyGrid from "@/components/Liabilities/TheCopyGrid.vue";

export default {
  components: {
    LiabilitiesMainGrid,
    LiabilityCopyGrid,
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

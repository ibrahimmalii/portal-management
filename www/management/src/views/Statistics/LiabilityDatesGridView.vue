<template>
  <div>
    <the-title :title="$store.state.liabilitiesDates"></the-title>
    <div class="dates-form d-flex my-3">
      <b-form-datepicker
        v-model="startDateInput"
        class="text-end"
        :placeholder="$store.state.dueDateFrom"
      ></b-form-datepicker>
      <b-form-datepicker
        v-model="endDateInput"
        class="text-end me-2"
        :placeholder="$store.state.dueDateTo"
      ></b-form-datepicker>
      <b-button variant="primary" class="me-2" @click="getSearchDates">{{
        $store.state.search
      }}</b-button>
    </div>
    <div v-if="!isLoading">
      <ejs-grid
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
        :enableRtl="true"
        locale="ar"
        :allowResizing="true"
        :actionComplete="actionComplete"
      >
        <e-columns>
          <!-- <e-column
          :headerText="$store.state.id"
          field="id"
          isPrimaryKey="true"
          type="number"
        ></e-column>
        <e-column
          field="liability_id"
          :headerText="$store.state.liability_number"
        ></e-column> -->
          <e-column
            field="liability.user.name_ar"
            headerText="الموظف"
          ></e-column>
          <e-column
            field="liability.company.name_ar"
            :headerText="$store.state.main_company"
            type="object"
          ></e-column>
          <e-column
            field="liability.sub_company.name_ar"
            :headerText="$store.state.sub_company"
          ></e-column>
          <e-column
            field="liability.product.name"
            :headerText="$store.state.product"
          >
          </e-column>
          <e-column
            field="date"
            :headerText="$store.state.dueDate"
            :format="dateFormatOptions"
            type="dateTime"
          ></e-column>
          <e-column
            field="pay_date"
            :headerText="$store.state.payDate"
            :format="dateFormatOptions"
            type="dateTime"
          ></e-column>
          <e-column
            field="required_amount"
            :headerText="$store.state.required_value"
          >
          </e-column>
          <e-column
            class="flex-grow-1"
            :headerText="$store.state.status"
            :template="pTemplate"
            textAlign="Left"
            type="boolean"
          ></e-column>
        </e-columns>
      </ejs-grid>
      <b-card class="measurement-section text-center my-3">
        <div class="measurement-section-header">
          <h5>
            تاريخ الاحصائيات<br />
            من:
            <span class="fs-6 fst-italic">{{
              startDate || $store.state.na
            }}</span>
            إلى:
            <span class="fs-6 fst-italic">{{
              endDate || $store.state.na
            }}</span>
          </h5>
        </div>

        <h5 class="my-2">القيمة المستحقة: {{ measureTotalRequiredAmount }}</h5>
        <h5 class="my-2">القيمة المحصول عليها: {{ measurePaidAmount }}</h5>
        <h5 class="my-2">
          القيمة المطلوب الحصول عليها: {{ measureTheSubBetweenRquiredAndPaid }}
        </h5>
      </b-card>
    </div>
    <div v-else class="text-center mt-5 mb-3 d-flex justify-content-center">
      <b-spinner variant="primary"></b-spinner>
    </div>
  </div>
</template>

<script>
import gridMixin from "@/mixins/gridMixin";
import PaidTemplate from "./PaidTemplate.vue";
import eventBus from "@/eventBus.js";

export default {
  name: "liability-dates-grid-view",
  mixins: [gridMixin],
  mounted() {
    eventBus.$on("refresh-liabilities-dates", this.loadDates);
    this.loadDates();
  },
  data() {
    return {
      isLoading: false,
      data: [],
      copyData: [],
      startDate: null,
      endDate: null,
      startDateInput: null,
      endDateInput: null,
      pTemplate: function (data) {
        return { template: PaidTemplate, data };
      },
    };
  },
  computed: {
    measureTotalRequiredAmount() {
      let total = this.copyData.reduce((acc, curr) => {
        return acc + curr.required_amount;
      }, 0);
      return total;
    },
    measurePaidAmount() {
      let total = this.copyData.reduce((acc, curr) => {
        if (curr.is_paid) {
          return acc + curr.required_amount;
        }
        return acc;
      }, 0);
      return total;
    },
    measureTheSubBetweenRquiredAndPaid() {
      return this.measureTotalRequiredAmount - this.measurePaidAmount;
    },
  },
  methods: {
    loadDates() {
      this.isLoading = true;
      this.$axios
        .get("/liability-dates")
        .then((response) => {
          this.data = response.data.map((item) => {
            item.date = new Date(item.date);
            item.pay_date = item.pay_date && new Date(item.pay_date);
            return item;
          });
          this.copyData = this.data;
        })
        .catch(console.error)
        .finally(() => {
          this.isLoading = false;
        });
    },
    getSearchDates() {
      this.isLoading = true;
      this.startDate = this.startDateInput;
      this.endDate = this.endDateInput;
      this.$axios
        .post("/liabilities/filter", {
          from: this.startDate,
          to: this.endDate,
        })
        .then((response) => {
          this.data = response.data.map((item) => {
            item.date = new Date(item.date);
            item.pay_date = item.pay_date && new Date(item.pay_date);
            return item;
          });
          this.copyData = this.data;
        })
        .catch(console.error)
        .finally(() => {
          this.isLoading = false;
        });
    },
    actionComplete(args) {
      console.log("sss", args.requestType);
      if (args.requestType === "filtering") {
        if (this.$refs.liabilityGrid.getFilteredRecords().length) {
          this.copyData = this.$refs.liabilityGrid.getFilteredRecords();
        } else {
          this.copyData = this.data;
        }
      }
    },
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

.e-detailcell {
  text-align: center;
  padding: 0 2.5rem !important;
  background-color: #e9ebf6;
}

.e-table {
  /* width: 95rem !important; */
}
</style>

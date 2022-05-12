<template>
  <div>
    <employees-main-grid></employees-main-grid>
    <the-copy-grid :data="[]"></the-copy-grid>
  </div>
</template>

<script>
import EmployeesMainGrid from './EmployeesMainGrid.vue';
import TheCopyGrid from '@/components/Employees/TheCopyGrid.vue';
import { mapActions } from 'vuex';

export default {
  components: {
    EmployeesMainGrid,
    TheCopyGrid,
  },
  mounted() {
    this.getCompaniesDropdown();
    this.getSubCompaniesDropdown();
    this.getSuperVisorsDropdown();
  },
  methods: {
    ...mapActions('companies', [
      'getCompaniesDropdown',
      'getSubCompaniesDropdown',
      'getSuperVisorsDropdown',
    ]),
  },
};
</script>

<style></style>

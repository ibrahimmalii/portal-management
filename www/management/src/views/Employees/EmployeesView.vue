<template>
  <div>
    <employees-main-grid></employees-main-grid>
    <the-copy-grid :data="[]"></the-copy-grid>
  </div>
</template>

<script>
import EmployeesMainGrid from './EmployeesMainGrid.vue';
import TheCopyGrid from '@/components/Employees/TheCopyGrid.vue';
export default {
  components: {
    EmployeesMainGrid,
    TheCopyGrid,
  },
};
</script>

<style></style>

<template>
  <div>
    <liabilities-main-grid></liabilities-main-grid>
    <!-- <liability-copy-grid :data="[]"></liability-copy-grid> -->
  </div>
</template>

<script>
import LiabilitiesMainGrid from './LiabilitiesMainGrid.vue';
import LiabilityCopyGrid from '@/components/Liabilities/TheCopyGrid.vue';

export default {
  components: { LiabilitiesMainGrid, LiabilityCopyGrid },
};
</script>

<style></style>

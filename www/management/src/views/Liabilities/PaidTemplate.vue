<template>
  <div>
    <b-badge v-if="data.is_fully_paid" class="bg-success" pill>{{
      $store.state.completed
    }}</b-badge>
    <b-badge v-else class="bg-danger" pill>{{
      $store.state.uncompleted
    }}</b-badge>
  </div>
</template>

<script>
export default {};
</script>

<style></style>

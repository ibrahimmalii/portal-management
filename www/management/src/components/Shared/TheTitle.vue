<template>
  <div class="title">
    <h1>{{ title }}</h1>
  </div>
</template>

<script>
export default {
  name: 'the-title',
  props: ['title', 'type'],
};
</script>

<style scoped>
.title {
  font-size: 2rem;
  font-weight: bold;
  margin-top: 2rem;
}
</style>

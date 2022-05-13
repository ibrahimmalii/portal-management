<template>
  <b-link v-if="name && uri" :href="uri" target="_blank">{{ name }}</b-link>
  <span v-else-if="name">{{ name }}</span>
  <b-badge v-else variant="light">{{ $store.state.na }}</b-badge>
</template>

<script>
export default {
  props: {
    nameFields: Array,
    uriFields: Array,
  },
  data() {
    return {
      data: {},
    };
  },
  mounted() {
    this.$i18n.locale = document.documentElement.lang;
  },
  computed: {
    name() {
      let value = this.data;
      this.nameFields.forEach((fieldName) => {
        value = value?.[fieldName] ?? null;
      });
      return value;
    },
    uri() {
      let value = this.data;
      this.uriFields.forEach((fieldName) => {
        value = value?.[fieldName] ?? null;
      });
      return value;
    },
  },
};
</script>

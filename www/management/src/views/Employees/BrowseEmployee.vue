<template>
  <div>
    <section v-if="isLoaded">
      <the-employee-details-vue :userData="data"></the-employee-details-vue>
    </section>
    <b-card class="text-center" v-else>
      <b-spinner variant="primary" label="Spinning"></b-spinner>
    </b-card>
  </div>
</template>

<script>
import TheEmployeeDetailsVue from '@/components/Employees/TheEmployeeDetails.vue';
export default {
  components: {
    TheEmployeeDetailsVue,
  },
  mounted() {
    const id = this.$route.params.id;
    this.loadEmployeeData(id);
  },
  data() {
    return {
      isLoaded: false,
      data: {},
    };
  },
  methods: {
    loadEmployeeData(id) {
      this.isLoaded = false;
      this.$axios
        .get(`users/${id}`)
        .then((res) => {
          this.data = res.data;
        })
        .catch(console.error)
        .finally(() => {
          this.isLoaded = true;
        });
    },
  },
};
</script>

<style></style>

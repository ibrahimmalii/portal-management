<template>
  <div>
    <section v-if="isLoaded">
      <the-liability-details-vue
        :liabilityData="data"
      ></the-liability-details-vue>
    </section>
    <b-card class="text-center" v-else>
      <b-spinner variant="primary" label="Spinning"></b-spinner>
    </b-card>
  </div>
</template>

<script>
import TheLiabilityDetailsVue from '@/components/Liabilities/TheLiabilityDetails.vue';
export default {
  components: {
    TheLiabilityDetailsVue,
  },
  mounted() {
    const id = this.$route.params.id;
    this.loadLiabilityData(id);
  },
  data() {
    return {
      isLoaded: false,
      data: {},
    };
  },
  methods: {
    loadLiabilityData(id) {
      this.isLoaded = false;
      this.$axios
        .get(`liabilities/${id}`)
        .then((res) => {
          console.log(res.data);
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

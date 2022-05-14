<template>
  <div>
    <b-button-group size="sm">
      <router-link
        v-b-tooltip="toolTipOptions"
        :title="$store.state.browse"
        class="btn"
        variant="light"
        @click="viewEmployee"
        :to="{ name: 'browse-employee', params: { id: data.id } }"
      >
        <i class="fa fa-info"> </i>
      </router-link>
      <b-button
        v-b-tooltip="toolTipOptions"
        :title="$store.state.edit"
        variant="light"
        @click="editEmployee"
      >
        <i class="fa fa-edit"></i>
      </b-button>
    </b-button-group>
  </div>
</template>

<script>
import eventBus from '@/eventBus';
import confirmDeleteMixin from '@/mixins/confirmDeleteMixin';

export default {
  mixins: [confirmDeleteMixin],
  data() {
    return {
      data: {},
      deleting: false,
    };
  },
  mounted() {
    // eventBus.$on('company-deleted', this.deleteComplete);
  },
  computed: {
    toolTipOptions() {
      return {
        placement: 'bottom',
        variant: 'light',
        boundary: 'viewport',
        trigger: 'hover',
      };
    },
    spinnerStyle() {
      return { width: '0.8rem', height: '0.8rem' };
    },
  },
  methods: {
    editEmployee() {
      eventBus.$emit('edit-employee', this.data);
      return;
    },
    // deleteClicked() {
    //   this.confirmDelete(() => {
    //     this.deleting = true;
    //     eventBus.$emit('delete-company', this.data);
    //   });
    // },
    // deleteComplete(id) {
    //   if (id === this.data?.id) {
    //     this.deleting = false;
    //   }
    // },
    viewEmployee() {
      eventBus.$emit('view-employee', this.data);
    },
  },
};
</script>

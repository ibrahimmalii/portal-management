<template>
  <div>
    <b-button-group size="sm">
      <b-button
        v-b-tooltip="toolTipOptions"
        :title="$store.state.edit"
        variant="light"
        @click="editCompany"
      >
        <i class="fa fa-edit"></i>
      </b-button>
      <b-button
        v-b-tooltip="toolTipOptions"
        :disabled="deleting"
        :title="$store.state.delete"
        variant="light"
        @click="deleteClicked"
      >
        <i v-if="!deleting" class="fa fa-trash"></i>
        <b-spinner v-else small :style="spinnerStyle"></b-spinner>
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
    eventBus.$on('company-deleted', this.deleteComplete);
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
    editCompany() {
      eventBus.$emit('edit-company', this.data);
    },
    deleteClicked() {
      this.confirmDelete(() => {
        this.deleting = true;
        eventBus.$emit('delete-company', this.data);
      });
    },
    deleteComplete(id) {
      if (id === this.data?.id) {
        this.deleting = false;
      }
    },
  },
};
</script>

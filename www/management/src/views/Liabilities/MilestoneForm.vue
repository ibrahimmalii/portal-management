<template>
  <div>
    <b-row class="my-1 text-end mb-3">
      <b-col class="col-1">
        <div class="delete">
          <b-button
            :disabled="isOnlyStillOneForm"
            :style="deleteBtnStyle"
            class="ml-2"
            variant="danger"
            @click="$emit('deleteMileStone', id)"
          >
            <i class="fa fa-trash"></i>
          </b-button>
        </div>
      </b-col>
      <b-col>
        <label for="input-small">{{ $store.state.is_paid }}</label>
        <validation-provider
          v-slot="validationContext"
          :name="$store.state.is_paid"
          rules="required"
          :vid="'is_paid' + id"
        >
          <v-select
            :id="'is_paid' + id"
            v-model="is_paid"
            size="md"
            dir="rtl"
            :placeholder="$store.state.enterIsPaid"
            :options="booleanDropdown"
            label="name"
            value="id"
          ></v-select>
          <b-form-invalid-feedback
            :state="getValidationState(validationContext)"
          >
            {{ validationContext.errors[0] }}
          </b-form-invalid-feedback>
        </validation-provider>
      </b-col>
      <b-col>
        <label for="input-small">{{ $store.state.required_amount }}</label>
        <validation-provider
          v-slot="validationContext"
          :name="$store.state.required_amount"
          rules="required|integer"
          :vid="'required_amount' + id"
        >
          <b-form-input
            :id="'required_amount' + id"
            v-model="required_amount"
            class="text-end"
            :placeholder="$store.state.required_amount"
          ></b-form-input>
          <b-form-invalid-feedback
            :state="getValidationState(validationContext)"
            >{{ validationContext.errors[0] }}</b-form-invalid-feedback
          >
        </validation-provider>
      </b-col>
      <b-col>
        <label for="input-small">{{ $store.state.date }}</label>
        <validation-provider
          v-slot="validationContext"
          :name="$store.state.date"
          rules="required"
          :vid="'date' + id"
        >
          <b-form-datepicker
            v-model="date"
            class="text-end"
            :placeholder="$store.state.date"
          ></b-form-datepicker>
          <b-form-invalid-feedback
            :state="getValidationState(validationContext)"
            >{{ validationContext.errors[0] }}</b-form-invalid-feedback
          >
        </validation-provider>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import syncMixin from '@/mixins/syncMixin.js';
export default {
  mixins: [syncMixin],
  mounted() {
    console.log(this.required_amount);
  },
  props: {
    isOnlyStillOneForm: {
      type: Boolean,
      default: false,
    },
  },
  sync: ['id', 'date', 'required_amount', 'is_paid'],
  data() {
    return {
      booleanDropdown: [
        { id: 1, name: 'نعم' },
        { id: 0, name: 'لا' },
      ],
    };
  },
  computed: {
    deleteBtnStyle() {
      return { marginTop: '29px' };
    },
  },
  methods: {
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
  },
};
</script>

<style></style>

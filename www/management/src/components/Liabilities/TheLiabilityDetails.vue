<template>
  <div class="my-5" v-if="liabilityData">
    <the-title :title="$store.state.liabilityDetails"></the-title>
    <b-card
      :title="$store.state.liability_status"
      :sub-title="liabilityData.is_fully_paid ? 'مكتمل' : 'غير مكتمل'"
    >
      <b-row class="my-1 text-center mb-3">
        <b-col>
          <b-avatar
            :src="`${$store.state.baseUrl}/${liabilityData.user.avatar}`"
            size="6rem"
          ></b-avatar>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <b-card-text>
            {{ $store.state.main_company }}:
            <router-link
              v-if="liabilityData.company"
              :to="{
                name: 'browse-company',
                params: { id: liabilityData.company.id },
              }"
              target="_blank"
            >
              {{ liabilityData?.company.name }}
            </router-link>
            <span v-else>{{ $store.state.no_company }}</span>
          </b-card-text>
          <b-card-text>
            {{ $store.state.sub_company }}:
            <router-link
              v-if="liabilityData.sub_company"
              :to="{
                name: 'browse-sub-company',
                params: { id: liabilityData.sub_company.id },
              }"
              target="_blank"
            >
              {{ liabilityData.sub_company.name }}
            </router-link>
            <span v-else>{{ $store.state.no_sub_company }}</span>
          </b-card-text>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.emp_name }}</label>
          <b-form-input
            id="product"
            class="text-end"
            size="md"
            :value="liabilityData.user.name_ar"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{ $store.state.civil_id }}</label>
          <b-form-input
            id="civil_id"
            class="text-end"
            size="md"
            :value="liabilityData.civil_id"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.product }}</label>
          <b-form-input
            id="product"
            class="text-end"
            size="md"
            :value="liabilityData.product.name"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{ $store.state.total_amount }}</label>
          <b-form-input
            id="total_amount"
            class="text-end"
            size="md"
            :value="liabilityData.total_amount"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.product_details }}</label>
          <b-form-textarea
            id="product_details"
            class="text-end"
            size="sm"
            :value="liabilityData.product.description"
            disabled
          ></b-form-textarea>
        </b-col>
      </b-row>
      <b-card
        :title="$store.state.milestone_details"
        scrollable
        class="text-end"
      >
        <b-card-boody name="milestone">
          <div class="milestone">
            <b-row
              class="my-1 text-end mb-2"
              v-for="milestone in liabilityData.dates"
              :key="milestone.id"
            >
              <b-col>
                <label for="input-small">{{ $store.state.date }}</label>
                <b-form-input
                  id="product"
                  class="text-end"
                  size="md"
                  :value="milestone.date"
                  disabled
                ></b-form-input>
              </b-col>
              <b-col>
                <label for="input-small">{{
                  $store.state.required_amount
                }}</label>
                <b-form-input
                  id="product"
                  class="text-end"
                  size="md"
                  :value="milestone.required_amount"
                  disabled
                ></b-form-input>
              </b-col>
              <b-col>
                <label for="input-small">{{ $store.state.is_paid }}</label>
                <b-form-input
                  id="product"
                  class="text-end"
                  size="md"
                  :value="milestone.is_paid ? 'مدفوع' : 'غير مدفوع'"
                  disabled
                ></b-form-input>
              </b-col>
            </b-row>
          </div>
        </b-card-boody>
      </b-card>
    </b-card>
  </div>
</template>

<script>
export default {
  props: ['liabilityData'],
};
</script>

<style></style>

<template>
  <div class="mt-5" v-if="userData">
    <the-title :title="$store.state.userDetails"></the-title>
    <b-card :title="userData?.name" :sub-title="userData.name_ar">
      <b-row class="my-1 text-center mb-3">
        <b-col>
          <b-avatar
            :src="`${$store.state.baseUrl}/${userData.avatar}`"
            size="6rem"
          ></b-avatar>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <b-card-text>
            {{ $store.state.main_company }}:
            <router-link
              v-if="userData.main_company"
              :to="{
                name: 'browse-company',
                params: { id: userData.company.id },
              }"
              target="_blank"
            >
              {{ userData?.company.name }}
            </router-link>
            <span v-else>{{ $store.state.no_company }}</span>
          </b-card-text>
          <b-card-text>
            {{ $store.state.sub_company }}:
            <router-link
              v-if="userData.sub_company"
              :to="{
                name: 'browse-sub-company',
                params: { id: userData.sub_company.id },
              }"
              target="_blank"
            >
              {{ userData.sub_company.name }}
            </router-link>
            <span v-else>{{ $store.state.no_sub_company }}</span>
          </b-card-text>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.nationality_ar }}</label>
          <b-form-input
            id="nationality_ar"
            class="text-end"
            size="md"
            :value="userData.nationality_ar"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{ $store.state.passport_number }}</label>
          <b-form-input
            id="passport_number"
            class="text-end"
            size="md"
            :value="userData.passport_number"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.address }}</label>
          <b-form-input
            id="address"
            class="text-end"
            size="md"
            :value="userData.address"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.country }}</label>
          <b-form-input
            id="country"
            class="text-end"
            size="md"
            :value="userData.country"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{ $store.state.city }}</label>
          <b-form-input
            id="city"
            class="text-end"
            size="md"
            :value="userData.city"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{ $store.state.postal_code }}</label>
          <b-form-input
            id="postal_code"
            class="text-end"
            size="md"
            :value="userData.postal_code"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
      <b-row class="my-1 text-end mb-3">
        <b-col>
          <label for="input-small">{{ $store.state.civil_id }}</label>
          <b-form-input
            id="civil_id"
            class="text-end"
            size="md"
            :value="userData.civil_id"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{
            $store.state.residence_expiry_date
          }}</label>
          <b-form-input
            id="residence_expiry_date"
            class="text-end"
            size="md"
            :value="userData.residence_expiry_date"
            disabled
          ></b-form-input>
        </b-col>
        <b-col>
          <label for="input-small">{{
            $store.state.passport_expiry_date
          }}</label>
          <b-form-input
            id="passport_expiry_date"
            class="text-end"
            size="md"
            :value="userData.passport_expiry_date"
            disabled
          ></b-form-input>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
export default {
  props: ['userData'],
};
</script>

<style></style>

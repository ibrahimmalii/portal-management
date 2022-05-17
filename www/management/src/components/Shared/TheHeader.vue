<template>
  <div class="bg-primary" style="height: 60px">
    <b-navbar
      class="navbar-expand-lg"
      toggleable="lg"
      type="dark"
      variant="primary"
      :sticky="true"
    >
      <b-navbar-brand to="/" class="text-black">Liabilities</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item :to="{ name: 'companies' }">{{
            $store.state.main_companies
          }}</b-nav-item>
          <b-nav-item :to="{ name: 'sub-companies' }">{{
            $store.state.sub_companies
          }}</b-nav-item>
          <b-nav-item :to="{ name: 'employees' }">{{
            $store.state.employees
          }}</b-nav-item>
          <b-nav-item :to="{ name: 'liabilities' }">{{
            $store.state.liabilities
          }}</b-nav-item>
        </b-navbar-nav>

        <b-navbar-nav class="me-auto">
          <b-nav-item-dropdown right>
            <template #button-content v-if="getLoggedStatus">
              <!-- <i class="fa fa-user"></i> -->
              <b-avatar
                :src="`${$store.state.baseUrl}/${$store.state.auth.avatar}`"
                size="2rem"
                class="mx-2"
              ></b-avatar>
              <em> {{ userNameGetter }}</em>
            </template>
            <template #button-content v-else>
              <em> {{ $store.state.login }}</em>
            </template>
            <div class="text-end" v-if="getLoggedStatus">
              <small
                ><b-dropdown-item :to="{ name: 'setting' }">{{
                  $store.state.setting
                }}</b-dropdown-item></small
              >
              <small
                ><b-dropdown-item tag="small" @click="logout">{{
                  $store.state.logout
                }}</b-dropdown-item></small
              >
            </div>
            <div class="text-end" v-else>
              <b-dropdown-item tag="small" :to="{ name: 'login' }">{{
                $store.state.login
              }}</b-dropdown-item>
            </div>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'the-header',
  mounted() {},
  computed: {
    ...mapGetters('auth', ['getLoggedStatus', 'userNameGetter']),
  },
  methods: {
    ...mapActions('auth', ['logout']),
  },
};
</script>

<style scoped>
a,
.green {
  text-decoration: none;
  color: hsla(160, 100%, 37%, 1);
  transition: 0.4s;
}

@media (hover: hover) {
  a:hover {
    background-color: hsla(160, 100%, 37%, 0.2);
  }
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}
</style>

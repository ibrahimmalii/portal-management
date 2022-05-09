<template>
  <div>
    <b-navbar class="" toggleable="lg" type="dark" variant="primary">
      <b-navbar-brand to="/">Liabilities</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item :to="{ name: 'companies' }">الشركات الرئيسية</b-nav-item>
          <b-nav-item>الشركات الفرعية</b-nav-item>
          <b-nav-item :to="{ name: 'employees' }">الموظفين</b-nav-item>
        </b-navbar-nav>

        <b-navbar-nav class="me-auto">
          <b-nav-item-dropdown text="اللغة " right>
            <b-dropdown-item>EN</b-dropdown-item>
            <b-dropdown-item>AR</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown right>
            <template #button-content v-if="getLoggedStatus">
              <i class="fa fa-user"></i>
              <em> {{ username }}</em>
            </template>
            <template #button-content v-else>
              <em> تسجيل الدخول</em>
            </template>
            <div class="text-end" v-if="getLoggedStatus">
              <small
                ><b-dropdown-item :to="{ name: 'profile' }"
                  >الملف الشخصى</b-dropdown-item
                ></small
              >
              <small
                ><b-dropdown-item tag="small" @click="logout"
                  >تسجيل الخروج</b-dropdown-item
                ></small
              >
            </div>
            <div class="text-end" v-else>
              <b-dropdown-item tag="small" :to="{ name: 'login' }"
                >تسجيل الدخول</b-dropdown-item
              >
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
  data() {
    return {
      username: '',
    };
  },
  mounted() {
    console.log('st', this.getLoggedStatus);
    this.username = JSON.parse(localStorage.user).name;
  },
  computed: {
    ...mapGetters('auth', ['getLoggedStatus']),
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

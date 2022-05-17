<template>
  <div class="mainWrapper d-flex aligh-items-center justify-content-center">
    <div id="setting" class="bg-primary text-light w-50">
      <b-alert
        v-model="isLoggedError"
        class="mt-3 w-50 m-auto"
        variant="danger"
      >
        خطأ فى عملية تسجيل الدخول!
      </b-alert>
      <!-- <div class="login mt-5 d-flex justify-content-center col p-4"> -->
      <div class="p-4">
        <ValidationObserver class="w-50" v-slot="{ handleSubmit }">
          <b-form @submit.prevent="handleSubmit(onSubmit)">
            <b-form-group
              id="input-group-1"
              label="البريد الإلكتروني"
              label-for="input-1"
            >
              <ValidationProvider
                rules="required|min:3|email"
                v-slot="v"
                name="البريد الإلكتروني"
              >
                <b-form-input
                  id="input-1"
                  v-model="form.email"
                  type="email"
                  placeholder="ادخل بريدك الإلكتروني"
                ></b-form-input>
                <small class="text-danger">{{ v.errors[0] }}</small>
              </ValidationProvider>
            </b-form-group>
            <b-form-group
              id="input-group-2"
              label="كلمة السر"
              label-for="input-2"
              class="mt-3"
            >
              <ValidationProvider
                v-slot="p"
                rules="required|min:3"
                name="الرقم السرى"
              >
                <b-form-input
                  id="input-2"
                  v-model="form.password"
                  type="password"
                  placeholder="ادخل كلمة المرور"
                ></b-form-input>
                <small class="text-danger">{{ p.errors[0] }}</small>
              </ValidationProvider>
            </b-form-group>
            <div class="mt-2">
              <b-button v-if="!isLogged" type="submit" variant="success" block
                >تسجيل الدخول</b-button
              >
              <b-spinner v-else label="Spinning"></b-spinner>
            </div>
          </b-form>
        </ValidationObserver>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import eventBus from '@/eventBus';

export default {
  name: 'login-view',
  data() {
    return {
      isLogged: false,
      isLoggedError: false,
      isLoggedSuccess: false,
      form: {
        email: '',
        password: '',
      },
    };
  },
  methods: {
    ...mapActions('auth', ['login', 'setUserName', 'setAvatar']),
    onSubmit() {
      this.isLogged = true;
      this.isLoggedSuccess = false;
      this.isLoggedError = false;
      this.$axios
        .post('login', this.form)
        .then((res) => {
          console.log(res);
          this.isLoggedSuccess = true;
          this.isLoggedError = false;
          localStorage.token = JSON.stringify(res.data.token);
          localStorage.user = JSON.stringify(res.data.user);
          if (res.data.user.role_id != 2) {
            this.isLoggedError = true;
            localStorage.clear();
          } else {
            this.login();
            this.setUserName();
            this.setAvatar();
            this.eventBus.$emit('close-sidebar');
          }
        })
        .catch((error) => {
          this.isLoggedSuccess = false;
          this.isLoggedError = true;
        })
        .finally(() => {
          this.isLogged = false;
        });
    },
  },
  computed: {
    ...mapGetters('auth', ['getLoggedStatus']),
  },
};
</script>

<style scoped>
#setting {
  margin-top: 10vh;
  border-radius: 20px;
  box-shadow: 4px 5px 16px 5px #0d6efd;
  border: 5px solid #eaeaea;
  /* text-align: center; */
}
</style>

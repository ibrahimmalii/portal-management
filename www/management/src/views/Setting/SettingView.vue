<template>
  <div id="setting" class="bg-primary text-light">
    <section v-if="isLoaded" class="p-4">
      <ValidationObserver ref="observer" class="w-50" v-slot="{ handleSubmit }">
        <b-form @submit.prevent="handleSubmit(onSubmit)">
          <b-row class="my-1 text-end mb-3">
            <b-col>
              <label for="input-small">{{ $store.state.name }}</label>
              <validation-provider
                v-slot="validationContext"
                :name="$store.state.name"
                rules="required|min:3|max:50"
                vid="name"
              >
                <b-form-input
                  id="name"
                  v-model="data.name"
                  class="text-end"
                  size="md"
                  :placeholder="$store.state.enterName"
                ></b-form-input>
                <b-form-invalid-feedback
                  :state="getValidationState(validationContext)"
                >
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </validation-provider>
            </b-col>
            <b-col>
              <label for="input-small">{{ $store.state.arabicName }}</label>
              <validation-provider
                v-slot="validationContext"
                :name="$store.state.arabicName"
                rules="required|min:3|max:50"
                vid="nameAr"
              >
                <b-form-input
                  id="nameAr"
                  v-model="data.name_ar"
                  class="text-end"
                  size="md"
                  :placeholder="$store.state.enterArabicName"
                ></b-form-input>
                <b-form-invalid-feedback
                  :state="getValidationState(validationContext)"
                >
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </validation-provider>
            </b-col>
          </b-row>
          <b-row class="my-1 text-end mb-3">
            <b-col>
              <label for="input-small">{{ $store.state.email }}</label>
              <validation-provider
                v-slot="validationContext"
                :name="$store.state.email"
                rules="email"
                vid="email"
              >
                <b-form-input
                  id="email"
                  v-model="data.email"
                  class="text-end"
                  size="md"
                  disabled
                  :placeholder="$store.state.enterEmail"
                ></b-form-input>
                <b-form-invalid-feedback
                  :state="getValidationState(validationContext)"
                >
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </validation-provider>
            </b-col>
            <b-col>
              <label for="input-small">{{ $store.state.oldPassword }}</label>
              <validation-provider
                v-slot="validationContext"
                :name="$store.state.oldPassword"
                rules="required|min:8|max:20"
                vid="oldPassword"
              >
                <b-form-input
                  id="oldPassword"
                  v-model="data.password"
                  class="text-end"
                  type="password"
                  size="md"
                  :placeholder="$store.state.enterOldPassword"
                ></b-form-input>
                <b-form-invalid-feedback
                  :state="getValidationState(validationContext)"
                >
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </validation-provider>
            </b-col>
          </b-row>
          <b-row class="my-1 text-end mb-3">
            <b-col>
              <label for="input-small">{{ $store.state.newPassword }}</label>
              <validation-provider
                v-slot="validationContext"
                :name="$store.state.newPassword"
                rules="required|min:8|max:20"
                vid="newPassword"
              >
                <b-form-input
                  id="newPassword"
                  v-model="data.newPassword"
                  class="text-end"
                  size="md"
                  type="password"
                  :placeholder="$store.state.enterNewPassword"
                ></b-form-input>
                <b-form-invalid-feedback
                  :state="getValidationState(validationContext)"
                >
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </validation-provider>
            </b-col>
            <b-col>
              <label for="input-small">{{
                $store.state.confirmPassword
              }}</label>
              <validation-provider
                v-slot="validationContext"
                :name="$store.state.confirmPassword"
                rules="required|min:8|max:20"
                vid="confirmPassword"
              >
                <b-form-input
                  id="confirmPassword"
                  v-model="data.confirmPassword"
                  class="text-end"
                  size="md"
                  type="password"
                  :placeholder="$store.state.enterConfirmPassword"
                ></b-form-input>
                <b-form-invalid-feedback
                  :state="getValidationState(validationContext)"
                >
                  {{ validationContext.errors[0] }}
                </b-form-invalid-feedback>
              </validation-provider>
            </b-col>
          </b-row>
          <b-row class="my-1 text-end mb-3">
            <b-col>
              <div class="d-flex justify-content-center">
                <b-button type="submit" variant="dark" size="md" class="w-50">
                  <span v-if="!isSubmitted">
                    {{ $store.state.save }}
                  </span>
                  <span v-else>
                    <b-spinner small variant="light"></b-spinner>
                  </span>
                </b-button>
              </div>
            </b-col>
          </b-row>
        </b-form>
      </ValidationObserver>
    </section>
    <b-card class="text-center" v-else>
      <b-spinner variant="primary" label="Spinning"></b-spinner>
    </b-card>
    <ejs-toast
      ref="successToast"
      cssClass="e-toast-success"
      :position="toastPosition"
      :content="$store.state.successAdd"
      :showProgressBar="true"
      timeOut="1500"
      :showCloseButton="true"
      progressDirection="rtl"
      :enableRtl="true"
      :beforeOpen="beforeSuccessToastOpen"
    ></ejs-toast>

    <ejs-toast
      ref="errorToast"
      cssClass="e-toast-danger"
      :position="toastPosition"
      :content="$store.state.errorAdd"
      :showProgressBar="true"
      timeOut="1500"
      :showCloseButton="true"
      progressDirection="rtl"
      :enableRtl="true"
      :beforeOpen="beforeErrorToastOpen"
    ></ejs-toast>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import toastMixin from '@/mixins/toastMixin';
import gridMixin from '@/mixins/gridMixin';

export default {
  name: 'setting',
  mixins: [toastMixin, gridMixin],
  components: {},
  mounted() {
    const { id } = JSON.parse(localStorage.user);
    this.loadUserData(id);
  },
  data() {
    return {
      isLoaded: false,
      isSubmitted: false,
      data: {
        name: '',
        name_ar: '',
        password: '',
        newPassword: '',
        confirmPassword: '',
      },
    };
  },
  methods: {
    ...mapActions('auth', ['setUserName']),
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    loadUserData(id) {
      this.$axios
        .get(`users/${id}`)
        .then((response) => {
          for (let i in response.data) {
            if (i == 'password') {
              continue;
            }
            this.data[i] = response.data[i];
          }
        })
        .catch(console.error)
        .finally(() => {
          this.isLoaded = true;
        });
    },
    onSubmit() {
      this.isSubmitted = true;
      if (this.data.newPassword != this.data.confirmPassword) {
        this.$refs.errorToast.show({
          template: this.$store.state.passwordNotMatch,
        });
        return;
      }

      this.$axios
        .post('users/change-password', this.data)
        .then((res) => {
          this.$refs.successToast.show({
            template: this.$store.state.successUpdate,
          });
          localStorage.user = JSON.stringify(res.data.user);
          this.setUserName();
          this.data.password =
            this.data.newPassword =
            this.data.confirmPassword =
              '';
          this.$refs.observer.reset();
        })
        .catch((error) => {
          this.$refs.errorToast.show({
            template: this.$store.state.invalidCredintials,
          });
        })
        .finally(() => {
          this.isSubmitted = false;
        });
    },
  },
};
</script>

<style scoped>
#setting {
  margin-top: 10vh;
  border-radius: 20px;
  box-shadow: 4px 5px 16px 5px #313fff;
  border: 5px solid #eaeaea;
}
</style>

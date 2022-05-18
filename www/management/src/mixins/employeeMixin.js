import { mapGetters } from 'vuex';

export default {
  computed: {
    ...mapGetters('companies', [
      'companiesDropdownGetter',
      'subCompaniesDropdownGetter',
      'superVisorsDropdownGetter',
    ]),
    checkAttachments() {
      return !this.form.attachments;
    },
  },
  methods: {
    clearForm() {
      this.form = {
        name: '',
        name_ar: '',
        email: '',
        password: 'password',
        nationality: '',
        nationality_ar: '',
        passport_number: '',
        address: '',
        city: '',
        country: '',
        postal_code: '',
        civil_id: '',
        passport_expiry_date: '',
        residence_expiry_date: '',
        expired_at: '',
        avatar: null,
        company_id: '',
        sub_company_id: '',
        role_id: 3,
        supervisor: '',
        attachments: null,
        phone1: '',
        phone2: '',
        phone3: '',
        original_attachment: null,
      };
      requestAnimationFrame(() => {
        this.$refs.observer.reset();
      });
    },
    clearAttachments() {
      this.form.attachments = null;
      this.form.original_attachment = null;
    },
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    onNationalityChange(value) {
      console.log('input');
      if (value) {
        this.form.nationality = this.form.nationality_ar = value;
        return;
      }
      this.form.nationality = this.form.nationality_ar = null;
    },
  },
};

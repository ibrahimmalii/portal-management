import { ToastUtility } from '@syncfusion/ej2-vue-notifications';

export default {
  data() {
    return {
      deletionToast: null,
      callbackFunction: null,
    };
  },
  methods: {
    confirmDelete(callback) {
      const isRTL = true;
      this.callbackFunction = callback;
      this.deletionToast?.hide('All');
      this.deletionToast = ToastUtility.show({
        title: this.$store.state.delete_confirmation,
        content: this.$store.state.confirmDelete,
        showCloseButton: true,
        position: { X: isRTL ? 'Left' : 'Right', Y: 'Bottom' },
        buttons: [
          {
            model: {
              content: this.$store.state.confirm,
              cssClass: `e-success`,
            },
            click: this.confirmed,
          },
          {
            model: { content: this.$store.state.cancel, cssClass: `e-danger` },
            click: this.cancelled,
          },
        ],
      });
    },
    confirmed() {
      this.deletionToast.hide();
      this.callbackFunction();
    },
    cancelled() {
      this.deletionToast.hide();
      this.callbackFunction = null;
    },
  },
};

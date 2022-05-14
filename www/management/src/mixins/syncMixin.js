export default {
    beforeCreate() {
      const sync = this.$options.sync;
      if (sync) {
        if (!this.$options.computed) {
          this.$options.computed = {};
        }
        sync.forEach((key) => {
          this.$options.computed[key] = {
            get() {
              return this.$attrs[key];
            },
            set(val) {
              this.$emit('update:' + key, val);
            },
          };
        });
      }
    },
  };
  
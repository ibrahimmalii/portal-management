<template>
  <div class="hello mb-4">
    <picture-input
      ref="PictureInput"
      width="150"
      height="150"
      margin="16"
      :crop="true"
      radius="50"
      :removable="false"
      :hideChangeButton="true"
      removeButtonClass="btn btn-primary"
      accept="image/jpeg,image/png"
      size="10"
      button-class="btn"
      :prefill="`${$store.state.baseUrl}/${avatarGetter}`"
      :custom-strings="{
        upload: '<h1>Bummer!</h1>',
        drag: 'Drag a file here or click to upload',
      }"
      @change="onChange"
    >
    </picture-input>
  </div>
</template>

<script>
import PictureInput from 'vue-picture-input';
import { mapGetters } from 'vuex';

export default {
  components: {
    PictureInput,
  },
  computed: {
    ...mapGetters('auth', ['avatarGetter']),
  },
  methods: {
    onChange(image) {
      if (image) {
        this.image = image;
        this.$emit('imageLoaded', this.$refs.PictureInput.image);
      } else {
        console.log('FileReader API not supported: use the <form>, Luke!');
      }
    },
  },
};
</script>

<style scoped>
.picture-preview {
  border-radius: 50% !important;
}
</style>

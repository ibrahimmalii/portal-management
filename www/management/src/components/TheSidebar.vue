<template>
  <div class="text-end">
    <div
      class="w3-sidebar w3-bar-block w3-card w3-animate-right w3-blue w3-border"
      style="display: none"
      id="mySidebar"
    >
      <button class="w3-bar-item w3-button w3-large" @click="w3_close">
        اغلاق &times;
      </button>
      <router-link :to="{name: 'profile'}" custom v-slot="{ navigate }">
        <span
          class="w3-bar-item w3-button"
          @click="navigate"
          @keypress.enter="navigate"
          role="link"
          >الملف الشخصى <i class="fa fa-user"></i
        ></span>
      </router-link>
      <button class="w3-button w3-block w3-left-align" v-b-toggle.accordion-1>
        الشركات الرئيسية <i class="fa fa-caret-down"></i>
      </button>
      <b-collapse id="accordion-1" accordion="my-accordion" role="tabpanel">
        <b-card-body>
          <router-link :to="{name: 'companies'}" custom v-slot="{ navigate }">
            <span
              class="w3-bar-item w3-button"
              @click="navigate"
              @keypress.enter="navigate"
              role="link"
              >الشركات <i class="fa fa-home"></i></span
            >
          </router-link>
        </b-card-body>
      </b-collapse>

      <button class="w3-button w3-block w3-left-align" v-b-toggle.accordion-2>
        الشركات الفرعية <i class="fa fa-caret-down"></i>
      </button>
      <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
        <b-card-body>
          <router-link to="/about" custom v-slot="{ navigate }">
            <span
              class="w3-bar-item w3-button"
              @click="navigate"
              @keypress.enter="navigate"
              role="link"
              >About Us</span
            >
          </router-link>
        </b-card-body>
      </b-collapse>

      <button class="w3-button w3-block w3-left-align" v-b-toggle.accordion-3>
        خصومات الموظفين <i class="fa fa-caret-down"></i>
      </button>
      <b-collapse
        id="accordion-3"
        visible
        accordion="my-accordion"
        role="tabpanel"
      >
        <b-card-body>
          <router-link to="/about" custom v-slot="{ navigate }">
            <span
              class="w3-bar-item w3-button"
              @click="navigate"
              @keypress.enter="navigate"
              role="link"
              >About Us</span
            >
          </router-link>
        </b-card-body>
      </b-collapse>

      <a href="#" class="w3-bar-item w3-button">المنتجات</a>
    </div>

    <div id="main">
      <div class="open-btn">
        <button
          id="openNav"
          class="w3-button w3-teal w3-xlarge"
          @click="w3_open"
        >
          &#9776;
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'the-sidebar',
  methods: {
    w3_open() {
      document.getElementById('main').style.marginRight = '25%';
      document.getElementById('mySidebar').style.width = '25%';
      document.getElementById('mySidebar').style.display = 'block';
      document.getElementById('openNav').style.display = 'none';
    },
    w3_close() {
      document.getElementById('main').style.marginRight = '0%';
      document.getElementById('mySidebar').style.display = 'none';
      document.getElementById('openNav').style.display = 'inline-block';
    },
  },
};
</script>

<style scoped></style>

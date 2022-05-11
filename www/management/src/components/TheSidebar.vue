<template>
  <div class="text-end pt-5">
    <ejs-sidebar
      class="bg-primary"
      id="dockSidebar"
      :enableDock="enableDock"
      :width="width"
      :dockSize="dockSize"
      ref="dockSidebar"
      :position="position"
    >
      <div class="dock">
        <ul>
          <li class="sidebar-item" id="toggle" v-on:click="toggleClick">
            <span class="e-icons expand"></span>
            <span class="e-text" title="menu">{{ $store.state.menu }}</span>
          </li>
          <li class="sidebar-item">
            <span class="e-icons profile"></span>
            <span class="e-text" title="profile">{{
              $store.state.profile
            }}</span>
          </li>
          <li class="sidebar-item">
            <span class="e-icons home"></span>
            <span class="e-text" title="home">{{
              $store.state.main_companies
            }}</span>
          </li>
          <li class="sidebar-item">
            <span class="e-icons e-table-insert-row"></span>
            <span class="e-text" title="sub_companies">{{
              $store.state.sub_companies
            }}</span>
          </li>
          <li class="sidebar-item">
            <span class="e-icons e-people"></span>
            <span class="e-text" title="employees">{{
              $store.state.employees
            }}</span>
          </li>
          <li class="sidebar-item">
            <span class="e-icons info"></span>
            <span class="e-text" title="liabilities">{{
              $store.state.liabilities
            }}</span>
          </li>
          <li class="sidebar-item">
            <span class="e-icons settings"></span>
            <span class="e-text" title="settings">{{
              $store.state.setting
            }}</span>
          </li>
        </ul>
      </div>
    </ejs-sidebar>

    <!-- <div
      class="w3-sidebar w3-bar-block w3-card w3-animate-right w3-blue w3-border"
      style="display: none"
      id="mySidebar"
    >
      <button class="w3-bar-item w3-button w3-large" @click="w3_close">
        اغلاق &times;
      </button>
      <router-link :to="{ name: 'profile' }" custom v-slot="{ navigate }">
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
          <router-link :to="{ name: 'companies' }" custom v-slot="{ navigate }">
            <span
              class="w3-bar-item w3-button"
              @click="navigate"
              @keypress.enter="navigate"
              role="link"
              >الشركات <i class="fa fa-home"></i
            ></span>
          </router-link>
        </b-card-body>
      </b-collapse>

      <button class="w3-button w3-block w3-left-align" v-b-toggle.accordion-2>
        الشركات الفرعية <i class="fa fa-caret-down"></i>
      </button>
      <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
        <b-card-body>
          <router-link
            :to="{ name: 'sub-companies' }"
            custom
            v-slot="{ navigate }"
          >
            <span
              class="w3-bar-item w3-button"
              @click="navigate"
              @keypress.enter="navigate"
              role="link"
              >الشركات <i class="fa fa-home"></i
            ></span>
          </router-link>
        </b-card-body>
      </b-collapse>

      <button class="w3-button w3-block w3-left-align" v-b-toggle.accordion-3>
        {{ $store.state.employees }} <i class="fa fa-caret-down"></i>
      </button>
      <b-collapse id="accordion-3" accordion="my-accordion" role="tabpanel">
        <b-card-body>
          <router-link :to="{ name: 'employees' }" custom v-slot="{ navigate }">
            <span
              class="w3-bar-item w3-button"
              @click="navigate"
              @keypress.enter="navigate"
              role="link"
              >{{ $store.state.employees }} <i class="fa fa-user"></i
            ></span>
          </router-link>
        </b-card-body>
      </b-collapse>

      <button class="w3-button w3-block w3-left-align" v-b-toggle.accordion-4>
        خصومات الموظفين <i class="fa fa-caret-down"></i>
      </button>
      <b-collapse
        id="accordion-4"
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
    </div> -->

    <!-- <div id="main">
      <div class="open-btn">
        <button
          id="openNav"
          class="w3-button w3-teal w3-xlarge"
          @click="w3_open"
        >
          &#9776;
        </button>
      </div>
    </div> -->
  </div>
</template>

<script>
import { enableRipple } from '@syncfusion/ej2-base';

export default {
  name: 'the-sidebar',
  data() {
    return {
      enableDock: true,
      dockSize: '72px',
      width: '260px',
      position: 'Right',
      type: 'Push',
      target: '.content',
    };
  },
  methods: {
    toggleClick: function () {
      this.$refs.dockSidebar.toggle();
    },
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

<style scoped>
@import '../../node_modules/@syncfusion/ej2-base/styles/material.css';
@import '../../node_modules/@syncfusion/ej2-buttons/styles/material.css';
@import '../../node_modules/@syncfusion/ej2-vue-navigations/styles/material.css';
.title {
  text-align: center;
  font-size: 20px;
  padding: 15px;
}

.sub-title {
  text-align: center;
  font-size: 16px;
  padding: 10px;
}

#wrapper .column {
  display: inline-block;
  padding: 10px;
}

.center {
  text-align: center;
  display: none;
  font-size: 13px;
  font-weight: 400;
  margin-top: 20px;
}

.sb-content-tab .center {
  display: block;
}
/* end of content area styles */
/* Sidebar styles */

#dockSidebar.e-sidebar.e-right.e-close {
  visibility: visible;
  transform: translateX(0%);
}

#dockSidebar .e-icons::before {
  font-size: 25px;
}
/* dockbar icon Style */

#dockSidebar .home::before {
  content: '\e102';
}

#dockSidebar .profile::before {
  content: '\e10c';
}

#dockSidebar .info::before {
  content: '\e11b';
}

#dockSidebar .settings::before {
  content: '\e10b';
}

.e-sidebar .expand::before {
  content: '\e10f';
}

.e-sidebar.e-open .expand::before {
  /* csslint allow: adjoining-classes*/
  content: '\e10e';
}
/* end of dockbar icon Style */

#dockSidebar.e-close .sidebar-item {
  padding: 5px 20px;
}

#dockSidebar.e-dock.e-close span.e-text {
  display: none;
}

#dockSidebar.e-dock.e-open span.e-text {
  display: inline-block;
}

#dockSidebar li {
  list-style-type: none;
  cursor: pointer;
}

#dockSidebar ul {
  padding: 0px;
}

#dockSidebar.e-sidebar ul li:hover span {
  color: white;
}

#dockSidebar.e-sidebar.e-open .e-text {
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 23px;
  font-size: 15px;
}

#dockSidebar.e-sidebar.e-open .e-icons {
  margin-right: 16px;
}

#dockSidebar.e-sidebar span.e-icons {
  color: #c0c2c5;
  line-height: 2;
}

#dockSidebar.e-sidebar .e-open .e-icons {
  margin-right: 16px;
}

#dockSidebar.e-sidebar .e-open .e-text {
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 23px;
  font-size: 15px;
}

.sidebar-item {
  text-align: center;
  border-bottom: 1px #75719f8a solid;
}

#dockSidebar.e-sidebar.e-open .sidebar-item {
  text-align: right;
  padding-left: 15px;
  color: #c0c2c5;
}

#dockSidebar.e-sidebar {
  background: #2d323e;
  overflow: hidden;
}

@font-face {
  font-family: 'e-icons';
  src: url(data:application/x-font-ttf;charset=utf-8;base64,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)
    format('truetype');
  font-weight: normal;
  font-style: normal;
}
</style>

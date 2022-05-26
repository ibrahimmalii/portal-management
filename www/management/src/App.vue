<script setup></script>

<template>
  <div id="app" dir="rtl">
    <header>
      <the-header></the-header>
    </header>
    <section class="container">
      <router-view />
    </section>
    <section>
      <the-sidebar></the-sidebar>
    </section>
  </div>
</template>

<style>
/* @import '@/assets/base.css'; */

#app {
  /* font-family: 'Noto Sans Display', 'Almarai', sans-serif !important; */
  /* font-weight: normal; */
  background-color: #f6f6f6;
  /* height: auto; */
  min-height: 100vh;
}
header {
  line-height: 1.5;
  max-height: 100vh;
}

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

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}
</style>

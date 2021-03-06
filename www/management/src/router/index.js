import Vue from 'vue';
import VueRouter from 'vue-router';
import HomeView from '../views/HomeView.vue';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  base: import.meta.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/MainCompanies/CompaniesView.vue'),
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Auth/LoginView.vue'),
    },
    {
      path: '/accountant-profile',
      name: 'profile',
      component: () => import('../views/Accountant/ProfileView.vue'),
    },
    {
      path: '/accountant/company',
      name: 'company',
      component: () => import('../views/Accountant/Company.vue'),
    },
    {
      path: '/employees',
      name: 'employees',
      component: () => import('../views/Employees/EmployeesView.vue'),
    },
    {
      path: '/employee/:id',
      name: 'browse-employee',
      component: () => import('../views/Employees/BrowseEmployee.vue'),
    },
    {
      path: '/companies',
      name: 'companies',
      component: () => import('../views/MainCompanies/CompaniesView.vue'),
    },
    {
      path: '/companies/:id',
      name: 'browse-company',
      component: () => import('../views/MainCompanies/BrowseCompany.vue'),
    },
    {
      path: '/sub-companies',
      name: 'sub-companies',
      component: () => import('../views/SubCompanies/SubCompaniesView.vue'),
    },
    {
      path: '/sub-companies/:id',
      name: 'browse-sub-company',
      component: () => import('../views/SubCompanies/BrowseSubCompany.vue'),
    },
    {
      path: '/liabilities',
      name: 'liabilities',
      component: () => import('../views/Liabilities/LiabilitiesView.vue'),
    },
    {
      path: '/liabilities/:id',
      name: 'browse-liabilities',
      component: () => import('../views/Liabilities/BrowseLiability.vue'),
    },
    {
      path: '/setting',
      name: 'setting',
      component: () => import('../views/Setting/SettingView.vue'),
    },
    {
      path: '/statistics',
      name: 'statistics',
      component: () => import('../views/Statistics/StatisticsView.vue'),
    }
  ],
});

router.beforeEach((to, from, next) => {
  if (to.name !== 'login' && !localStorage.token) next({ name: 'login' });
  if (to.name === 'login' && localStorage.token) next({ name: 'companies' });
  else next();
});

export default router;

import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: import.meta.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Auth/LoginView.vue')
    },
    {
      path: '/accountant-profile',
      name: 'profile',
      component: () => import('../views/Accountant/ProfileView.vue')
    },
    {
      path: '/accountant/company',
      name: 'company',
      component: () => import('../views/Accountant/Company.vue')
    },
    {
      path: '/employees',
      name: 'employees',
      component: () => import('../views/Employees/EmployeesView.vue')
    },
    {
      path: '/companies',
      component: () => import('../views/MainCompanies/CompaniesView.vue'),
      children: [
        {
          path: '',
          name: 'companies',
          component: () => import('../views/MainCompanies/CompaniesView.vue')
        },
        {
          path: '/:id',
          name: 'main-company',
          component: () => import('../views/MainCompanies/CompanyView.vue')
        }
      ]
    }
  ]
})


export default router

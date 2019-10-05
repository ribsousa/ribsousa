import Vue from 'vue'
import VueRouter from 'vue-router'

import BackendComponent from '../components/backend/layouts/BackendComponent'
import SkillsComponent from '../components/backend/pages/skills/SkillsComponent'
import DashboardComponent from '../components/backend/pages/dashboard/DashboardComponent'
import CreateSkillComponent from '../components/backend/pages/skills/CreateSkillComponent'

Vue.use(VueRouter)

const routes = [
   {
      path: '/backend',
      component: BackendComponent,
      children: [
         {path: '/', component: DashboardComponent, name: 'backend.dashboard'},
         {path: '/skills', component: SkillsComponent, name: 'backend.skills'},
         {path: '/skills/create', component: CreateSkillComponent, name: 'backend.skills.create'}
      ]
   },
]

const router = new VueRouter({
   mode: 'history',
   routes
})

export default router
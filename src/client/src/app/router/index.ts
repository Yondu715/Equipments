import { createRouter, createWebHistory } from 'vue-router';
import { routes } from '~/shared/routing';

export const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: routes.root,
      name: 'root',
      redirect: routes.equipments.root
    },
    {
      path: routes.equipments.root,
      name: 'home',
      component: () => import('~/pages/home')
    },
    {
      path: routes.equipments.equipment,
      name: 'full-equipment',
      component: () => import('~/pages/equipment')
    },
    {
      path: routes.equipments.addEquipment,
      name: 'add-equipment',
      component: () => import('~/pages/add-equipment')
    },
    {
      path: routes.equipments.editEquipment,
      name: 'edit-equipment',
      component: () => import('~/pages/edit-equipment')
    },
  ]
});

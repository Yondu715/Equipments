import type { RouterOptions } from '@nuxt/schema';
import { routes } from '~/shared/routing';

export default <RouterOptions>{
    routes: (_routes) => [
        {
            name: 'home',
            path: routes.root,
            redirect: routes.equipments.root
        },
        {
            name: 'equipments',
            path: routes.equipments.root,
            component: () => import("~/pages/home")
        },
        {
            name: 'fullEquipment',
            path: routes.equipments.equipment,
            component: () => import("~/pages/equipment")
        }
    ],
};

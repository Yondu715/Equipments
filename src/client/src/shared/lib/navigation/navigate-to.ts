import { createEffect } from 'effector';
import type { RouteLocationRaw } from 'vue-router';

export const navigateToFx = createEffect(async (to?: RouteLocationRaw) => {
    navigateTo(to);
});
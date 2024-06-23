import { attach, createEvent, createStore, sample } from 'effector';
import type { RouteLocationRaw, Router } from 'vue-router';

const $router = createStore<Router | null>(null);

export const setRouter = createEvent<Router>();

export const navigateFx = attach({
    source: $router,
    effect: async (router, to: RouteLocationRaw) => {
        router?.push(to);
    }
});

export const navigateToBackFx = attach({
    source: $router,
    effect: async (router) => {
        router?.go(-1);
    }
});

sample({
    clock: setRouter,
    target: $router
});
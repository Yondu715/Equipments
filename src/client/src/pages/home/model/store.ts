import { attach, createEvent, createStore, sample } from 'effector';
import { pending } from 'patronum';
import { equipmentModel } from '~/entities/equipment';
import { navigateToFx } from '~/shared/lib/navigation';
import { routes } from '~/shared/routing';

export const getEquipmentsFx = attach({
    effect: equipmentModel.getEquipmentsFx
});

export const pageMounted = createEvent();
export const onItemClicked = createEvent<number>();

export const $isEquipmentsLoading = pending([getEquipmentsFx, equipmentModel.getEquipmentsFx]);

export const $currentPage = createStore<number>(1);


sample({
    clock: pageMounted,
    target: getEquipmentsFx
});

sample({
    clock: onItemClicked,
    fn: (id) => ({
        path: `${routes.equipments.root}/${id}`
    }),
    target: navigateToFx
})

sample({
    clock: equipmentModel.$paginationInfo,
    fn: (clck) => clck?.currentPage ?? 1,
    target: $currentPage
});

sample({
    clock: $currentPage,
    fn: (clock) => ({
        page: clock
    }),
    target: getEquipmentsFx
});
import { attach, createEvent, createStore, sample } from 'effector';
import { pending, reset } from 'patronum';
import { equipmentModel } from '~/entities/equipment';
import { navigateFx, routes } from '~/shared/routing';

const getEquipmentsFx = attach({
    effect: equipmentModel.getEquipmentsFx
});

export const pageMounted = createEvent();
export const pageUnmounted = createEvent();
export const onAddItemClicked = createEvent();
export const onItemClicked = createEvent<number>();

export const $isEquipmentsLoading = pending([equipmentModel.getEquipmentsFx]);

export const $currentPage = createStore<number>(1);


sample({
    clock: pageMounted,
    target: getEquipmentsFx
});

reset({
    clock: pageUnmounted,
    target: [equipmentModel.$equipments, equipmentModel.$paginationInfo]
});

sample({
    clock: onAddItemClicked,
    fn: () => routes.equipments.addEquipment,
    target: navigateFx
});

sample({
    clock: onItemClicked,
    fn: (id) => `${routes.equipments.root}/${id}`,
    target: navigateFx
});

sample({
    clock: equipmentModel.$paginationInfo,
    filter: Boolean,
    fn: (clock) => clock.currentPage,
    target: $currentPage
});

sample({
    clock: $currentPage,
    fn: (clock) => ({
        page: clock
    }),
    target: getEquipmentsFx
});
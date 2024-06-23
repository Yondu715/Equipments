import { attach, createEvent, sample } from 'effector';
import { pending, reset } from 'patronum';
import { equipmentModel } from '~/entities/equipment';
import { navigateFx, routes } from '~/shared/routing';

const getEquipmentFx = attach({
    effect: equipmentModel.getEquipmentFx
});

export const pageMounted = createEvent<number>();
export const pageUnmounted = createEvent();
export const onEditClicked = createEvent<number>();

export const $isEquipmentLoading = pending([getEquipmentFx]);

sample({
    clock: pageMounted,
    target: getEquipmentFx
});


reset({
    clock: pageUnmounted,
    target: [equipmentModel.$equipment]
});

sample({
    clock: getEquipmentFx.fail,
    fn: () => routes.equipments.root,
    target: navigateFx
});

sample({
    clock: onEditClicked,
    fn: (id) => `${routes.equipments.root}/${id}/edit`,
    target: navigateFx
});


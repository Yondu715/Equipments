import { attach, createEvent, sample } from 'effector';
import { pending, reset } from 'patronum';
import { equipmentModel } from '~/entities/equipment';

const getEquipmentFx = attach({
    effect: equipmentModel.getEquipmentFx
});

export const pageMounted = createEvent<number>();
export const pageUnmounted = createEvent();

export const $isEquipmentLoading = pending([getEquipmentFx]);

sample({
    clock: pageMounted,
    target: getEquipmentFx
});


reset({
    clock: pageUnmounted,
    target: [equipmentModel.$equipment]
});


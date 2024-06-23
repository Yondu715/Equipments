import { attach, sample, createEvent } from 'effector';
import { pending, reset } from 'patronum';
import { equipmentModel } from '~/entities/equipment';
import { showNotificationFx, type INotificationOption } from '~/shared/lib/notification';
import { navigateFx, routes } from '~/shared/routing';

export const deleteEquipmentFx = attach({
    effect: equipmentModel.deleteEquipmentFx
});

export const $isDeleteEquipmentLoading = pending([deleteEquipmentFx]);
export const onItemClicked = createEvent<number>();

sample({
    clock: deleteEquipmentFx.doneData,
    fn: () => routes.equipments.root,
    target: navigateFx
});

sample({
    clock: onItemClicked,
    target: deleteEquipmentFx
});

reset({
    clock: deleteEquipmentFx.done,
    target: [equipmentModel.$equipment]
});


sample({
    clock: deleteEquipmentFx.done,
    fn: (clock) => {
        return {
            message: 'Удаление успешно выполнено',
            title: `Equipment ${clock.params}`,
            type: "success",
            duration: 3000
        } as INotificationOption
    },
    target: showNotificationFx
});

sample({
    clock: deleteEquipmentFx.fail,
    fn: (effectError) => ({
        title: "Ошибка",
        message: effectError.error.message,
        type: "error"
    }) as INotificationOption,
    target: showNotificationFx
});
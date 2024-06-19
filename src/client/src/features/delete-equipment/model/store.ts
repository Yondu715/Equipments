import { attach, createEffect, sample, createEvent } from 'effector';
import { reset } from 'patronum';
import { equipmentModel } from '~/entities/equipment';
import { navigateToFx } from '~/shared/lib/navigation';
import { showNotificationFx, type INotificationOption } from '~/shared/lib/notification';
import { routes } from '~/shared/routing';

const deleteEquipmentFx = attach({
    effect: equipmentModel.deleteEquipmentFx
});

export const onItemClicked = createEvent<number>();

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
    fn: () => ({
        path: routes.equipments.root
    }),
    target: navigateToFx
})

sample({
    clock: deleteEquipmentFx.done,
    fn: (clck) => {
        return {
            message: 'Удаление успешно выполнено',
            title: `Equipment ${clck.params}`,
            type: "success",
            duration: 3000
        } as INotificationOption
    },
    target: showNotificationFx
});

sample({
    clock: deleteEquipmentFx.fail,
    fn: (clck) => {
        return {
            message: 'Что-то пошло не так(',
            title: `Equipment ${clck.params}`,
            type: "error",
            duration: 3000
        } as INotificationOption
    },
    target: showNotificationFx
});
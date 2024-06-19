import { attach, createStore, sample, createEvent } from 'effector';
import { pending } from 'patronum';
import { equipmentModel } from '~/entities/equipment';

const getEquipmentsFx = attach({
    effect: equipmentModel.getEquipmentsFx
});

export const searchPressed = createEvent();

export const $search = createStore<string>('');
export const $isSearchLoading = pending([getEquipmentsFx]);


sample({
    clock: searchPressed,
    source: $search,
    filter: (source, _) => source.length > 0,
    fn: (source) => ({
        filters: {
            serial_number: source
        }
    }),
    target: getEquipmentsFx
});

sample({
    clock: searchPressed,
    source: $search,
    filter: (source, _) => source.length === 0,
    fn: () => {},
    target: getEquipmentsFx
});



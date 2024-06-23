import { attach, createEvent, createStore, sample } from 'effector';
import { and, every, not, pending, reset } from 'patronum';
import { equipmentModel, equipmentTypeModel } from '~/entities/equipment';
import { isEmpty, isEquipmentTypeIdValid } from './validation';
import { showNotificationFx, type INotificationOption } from '~/shared/lib/notification';

const getEquipmentTypesFx = attach({
    effect: equipmentTypeModel.getEquipmentTypesFx
});

const createEquipmentFx = attach({
    effect: equipmentModel.createEquipmentFx
});

export const formMounted = createEvent();
export const formUnmounted = createEvent();
export const onGetMoreClicked = createEvent();
export const addEquipmentFormReset = createEvent();
export const addEquipmentFormSubmitted = createEvent();

export const $isEquipmentTypesLoading = pending([getEquipmentTypesFx]);
export const $isCreateEquipmentLoading = pending([createEquipmentFx]);
export const $totalEquipmentTypes = equipmentTypeModel.$paginationInfo.map((state) => state?.total ?? null);

export const $desc = createStore('');
export const $equipmentTypeId = createStore<number | undefined>(undefined, {
    skipVoid: false
});
export const $serialNumbers = createStore('');

export const $equipmentTypeIdError = createStore<string | null>(null);
export const $descError = createStore<string | null>(null);
export const $serialNumbersError = createStore<string | null>(null);
const $addEquipmentFormValid = every({
    stores: [$equipmentTypeIdError, $descError, $serialNumbersError],
    predicate: null,
});


sample({
    clock: formMounted,
    target: getEquipmentTypesFx
});

reset({
    clock: formMounted,
    target: [$desc, $serialNumbers, $equipmentTypeId]
});


sample({
    clock: onGetMoreClicked,
    source: equipmentTypeModel.$paginationInfo,
    fn: (source) => ({
        limit: source?.total
    }),
    target: getEquipmentTypesFx
});

reset({
    clock: addEquipmentFormReset,
    target: [$desc, $equipmentTypeId, $serialNumbers]
});


sample({
    clock: addEquipmentFormSubmitted,
    source: $equipmentTypeId,
    fn: (equipmentTypeId) => {
        if (isEmpty(equipmentTypeId?.toString() ?? '')) {
            return "Поле пустое";
        }
        if (!isEquipmentTypeIdValid(equipmentTypeId?.toString() ?? '')) {
            return "Неверное значение поля";
        }
        return null;
    },
    target: $equipmentTypeIdError
});

sample({
    clock: addEquipmentFormSubmitted,
    source: $serialNumbers,
    fn: (serialNumbers) => {
        if (isEmpty(serialNumbers)) {
            return "Поле пустое";
        }
        return null;
    },
    target: $serialNumbersError
});


sample({
    clock: addEquipmentFormSubmitted,
    source: $desc,
    fn: (desc) => {
        if (isEmpty(desc)) {
            return "Поле пустое";
        }
        return null;
    },
    target: $descError
});

sample({
    clock: addEquipmentFormSubmitted,
    source: $equipmentTypeIdError,
    filter: Boolean,
    fn: (source) => ({
        title: "Тип оборудования",
        type: "error",
        message: source
    }) as INotificationOption,
    target: showNotificationFx
});

sample({
    clock: addEquipmentFormSubmitted,
    source: $descError,
    filter: Boolean,
    fn: (source) => ({
        title: "Примечание",
        type: "error",
        message: source
    }) as INotificationOption,
    target: showNotificationFx
});

sample({
    clock: addEquipmentFormSubmitted,
    source: $serialNumbersError,
    filter: Boolean,
    fn: (source) => ({
        title: "Серийные номера",
        type: "error",
        message: source
    }) as INotificationOption,
    target: showNotificationFx
});


sample({
    clock: addEquipmentFormSubmitted,
    source: { 
        equipmentTypeId: $equipmentTypeId,
        serialNumbers: $serialNumbers,
        desc: $desc,
    },
    filter: and(not($isCreateEquipmentLoading), $addEquipmentFormValid),
    fn: (source) => {
        const serialNumbers = source.serialNumbers.split(' ');
        return serialNumbers.map((serialNumber) => {
            return {
                serial_number: serialNumber,
                equipment_type_id: source.equipmentTypeId ?? -1,
                desc: source.desc
            }
        });
    },
    target: createEquipmentFx,
});


sample({
    clock: createEquipmentFx.doneData,
    filter: (data) => Object.keys(data.errors).length > 0,
    fn: (data) => {
        const keys = Object.keys(data.errors);
        const errors = keys.map((key) => `${key}. ${data.errors[key]}\n`).join(' ');
        return {
            title: "Ошибки",
            type: "error",
            message: errors
        } as INotificationOption
    },
    target: showNotificationFx
});







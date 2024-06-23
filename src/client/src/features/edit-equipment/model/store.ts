import { attach, createEvent, createStore, sample } from 'effector';
import { equipmentModel, equipmentTypeModel } from '~/entities/equipment';
import type { EquipmentFields } from './types';
import { and, every, not, pending, reset } from 'patronum';
import { isEmpty, isEquipmentTypeIdValid } from './validation';
import { showNotificationFx, type INotificationOption } from '~/shared/lib/notification';

const getEquipmentFx = attach({
    effect: equipmentModel.getEquipmentFx
});

const updateEquipmentFx = attach({
    effect: equipmentModel.updateEquipmentFx
});

const getEquipmentTypesFx = attach({
    effect: equipmentTypeModel.getEquipmentTypesFx
});


export const formMounted = createEvent<number>();
export const formUnmounted = createEvent();
export const equipmentReseted = createEvent();
export const updateEquipmentFormSubmitted = createEvent();

export const $equipmentFields = createStore<EquipmentFields | null>(null);
const $equipmentFieldsReset = createStore<EquipmentFields | null>(null);

const $equipmentTypeId = $equipmentFields.map((state) => state?.equipmentTypeId ?? null);
const $desc = $equipmentFields.map((state) => state?.desc ?? '');
const $serialNumber = $equipmentFields.map((state) => state?.serialNumber ?? '');

const $equipmentTypeIdError = createStore<string | null>(null);
const $descError = createStore<string | null>(null);
const $serialNumberError = createStore<string | null>(null);

const $isUpdateEquipmentLoading = pending([updateEquipmentFx]);
const $updateEquipmentFormValid = every({
    stores: [$equipmentTypeIdError, $descError, $serialNumberError],
    predicate: null,
});


sample({
    clock: formMounted,
    target: [getEquipmentFx, getEquipmentTypesFx]
});

reset({
    clock: formUnmounted,
    target: [$equipmentFields, $equipmentFieldsReset]
});

sample({
    clock: getEquipmentTypesFx.doneData,
    source: {
        equipmentTypes: equipmentTypeModel.$equipmentTypes,
        paginationInfo: equipmentTypeModel.$paginationInfo
    },
    filter: (source) => {
        if (!source.equipmentTypes || !source.paginationInfo) {
            return false;
        }
        if (source.equipmentTypes.length >= source.paginationInfo.total) {
            return false;
        }
        return true
    },
    fn: (source) => ({
        limit: source.paginationInfo?.total
    }),
    target: getEquipmentTypesFx
});


sample({
    clock: getEquipmentFx.doneData,
    fn: (clock) => ({
        id: clock.id,
        equipmentTypeId: clock.equipmentType.id,
        desc: clock.desc,
        serialNumber: clock.serialNumber
    }),
    target: [$equipmentFields, $equipmentFieldsReset]
});

sample({
    clock: equipmentReseted,
    source: $equipmentFieldsReset,
    target: $equipmentFields
});

sample({
    clock: updateEquipmentFormSubmitted,
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
    clock: updateEquipmentFormSubmitted,
    source: $serialNumber,
    fn: (serialNumber) => {
        if (isEmpty(serialNumber)) {
            return "Поле пустое";
        }
        return null;
    },
    target: $serialNumberError
});


sample({
    clock: updateEquipmentFormSubmitted,
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
    clock: updateEquipmentFormSubmitted,
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
    clock: updateEquipmentFormSubmitted,
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
    clock: updateEquipmentFormSubmitted,
    source: $serialNumberError,
    filter: Boolean,
    fn: (source) => ({
        title: "Серийный номер",
        type: "error",
        message: source
    }) as INotificationOption,
    target: showNotificationFx
});

sample({
    clock: updateEquipmentFormSubmitted,
    source: $equipmentFields,
    filter: and(not($isUpdateEquipmentLoading), $updateEquipmentFormValid),
    fn: (source) => {
        return {
            id: source?.id ?? -1,
            serial_number: source?.serialNumber ?? '',
            equipment_type_id: source?.equipmentTypeId ?? -1,
            desc: source?.desc ?? ''
        }
    },
    target: updateEquipmentFx,
});


sample({
    clock: updateEquipmentFx.done,
    fn: () => ({
        title: "Обновление оборудования",
        type: "success",
        message: "Обновление прошло успешно"
    }) as INotificationOption,
    target: showNotificationFx
});

sample({
    clock: updateEquipmentFx.fail,
    fn: (effectError) => ({
        title: "Ошибка",
        message: effectError.error.message,
        type: "error"
    }) as INotificationOption,
    target: showNotificationFx
});
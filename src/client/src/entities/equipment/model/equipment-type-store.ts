import { createEffect, createStore, sample } from 'effector';
import type { EquipmentType, GetEquipmentTypesParams, Pagination } from './types';
import { getEquipmentTypesQuery } from '~/shared/api/equipments';
import { spread } from 'patronum';
import { mapEquipmentTypes } from '../lib/map-equipment';
import { mapPagination } from '../lib/map-pagination';
import { CURRENT_PAGE, LIMIT_EQUIPMENT_TYPES } from '../config/default-pagination';

export const getEquipmentTypesFx = createEffect(async (params?: GetEquipmentTypesParams | null) => {
    const response = await getEquipmentTypesQuery(
        params?.page ?? CURRENT_PAGE,
        params?.limit ?? LIMIT_EQUIPMENT_TYPES,
        params?.filters
    );

    return {
        data: mapEquipmentTypes(response.data),
        meta: mapPagination(response.meta!)
    }
});


export const $equipmentTypes = createStore<EquipmentType[] | null>(null);

export const $paginationInfo = createStore<Pagination | null>(null);

const equipmentTypeSpread = spread({
    data: $equipmentTypes,
    pagination: $paginationInfo
});


sample({
    clock: getEquipmentTypesFx.doneData,
    fn: (response) => ({
        data: response.data,
        pagination: response.meta
    }),
    target: equipmentTypeSpread
});
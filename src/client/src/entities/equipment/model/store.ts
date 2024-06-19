import { createEffect, createStore, sample } from 'effector';
import type { Equipment, GetEquipmentsParams, Pagination } from './types';
import { deleteEquipmentQuery, getEquipmentQuery, getEquipmentsQuery } from '~/shared/api/equipments/queries';
import { spread } from 'patronum';
import { mapEquipment, mapEquipments } from '../lib/map-equipment';
import { mapPagination } from '../lib/map-pagination';
import { CURRENT_PAGE, LIMIT } from '../config/default-pagination';

export const getEquipmentsFx = createEffect(async (params?: GetEquipmentsParams | null) => {
    const response = await getEquipmentsQuery(
        params?.page ?? CURRENT_PAGE,
        params?.limit ?? LIMIT,
        params?.filters
    );
    
    return {
        data: mapEquipments(response.data),
        meta: mapPagination(response.meta!)
    }
});

export const getEquipmentFx = createEffect(async (id: number) => {
    const response = await getEquipmentQuery(id);
    return mapEquipment(response.data);
});

export const deleteEquipmentFx = createEffect(async (id: number) => {
    deleteEquipmentQuery(id);
});

export const $equipments = createStore<Equipment[] | null>(null);
export const $equipment = createStore<Equipment | null>(null);


export const $paginationInfo = createStore<Pagination | null>(null);


const equipmentSpread = spread({
    data: $equipments,
    pagination: $paginationInfo
});

sample({
    clock: getEquipmentsFx.doneData,
    fn: (response) => ({
        data: response.data,
        pagination: response.meta
    }),
    target: equipmentSpread
});

sample({
    clock: getEquipmentFx.doneData,
    target: $equipment
});

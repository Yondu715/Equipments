import { createEffect, createStore, sample } from 'effector';
import type { Equipment, GetEquipmentsParams, Pagination, UpdateEquipmentParams } from './types';
import { createEquipmentQuery, deleteEquipmentQuery, getEquipmentQuery, getEquipmentsQuery, updateEquipmentQuery, type CreateEquipmentParams } from '~/shared/api/equipments';
import { spread } from 'patronum';
import { mapEquipment, mapEquipments } from '../lib/map-equipment';
import { mapPagination } from '../lib/map-pagination';
import { CURRENT_PAGE, LIMIT_EQUIPMENTS } from '../config/default-pagination';

export const getEquipmentsFx = createEffect(async (params?: GetEquipmentsParams | null) => {
    const response = await getEquipmentsQuery(
        params?.page ?? CURRENT_PAGE,
        params?.limit ?? LIMIT_EQUIPMENTS,
        params?.filters
    );

    return {
        data: mapEquipments(response.data),
        meta: mapPagination(response.meta!)
    }
});

const sleep = (ms: number) => new Promise(resolve => setTimeout(resolve, ms));

export const getEquipmentFx = createEffect(async (id: number) => {
    const response = await getEquipmentQuery(id);
    return mapEquipment(response.data);
});

export const deleteEquipmentFx = createEffect(async (id: number) => {
    const response = await deleteEquipmentQuery(id);
    await sleep(1000);
    return response;
});

export const updateEquipmentFx = createEffect(async (params: UpdateEquipmentParams) => {
    const { id, ...fields } = params;
    await updateEquipmentQuery(id, fields);
});


export const createEquipmentFx = createEffect(async (equipment: CreateEquipmentParams[]) => {
    const { data } = await createEquipmentQuery(equipment);
    return data;
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


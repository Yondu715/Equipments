import { equipmentClient } from '../equipment-client';
import type { ResponseWrap } from '../types';
import type { EquipmentDto, EquipmentFilters, EquipmentTypeDto, EquipmentTypeFilters, UpdateEquipment } from './types';

export const getEquipmentsQuery = async (page?: number, limit?: number, filters?: EquipmentFilters) => {
    const { data } = await equipmentClient.get<ResponseWrap<EquipmentDto[]>>('/equipments', {
        params: {
            page,
            limit,
            ...filters
        }
    });
    return data;
};

export const getEquipmentQuery = async (id: number) => {
    const { data } = await equipmentClient.get<ResponseWrap<EquipmentDto>>(`/equipments/${id}`);
    return data;
};

export const getEquipmentTypesQuery = async (page?: number, limit?: number, filters?: EquipmentTypeFilters) => {
    const { data } = await equipmentClient.get<ResponseWrap<EquipmentTypeDto[]>>('/equipments', {
        params: {
            page,
            limit,
            ...filters
        }
    });
    return data;
};


export const updateEquipmentQuery = async (id: number, fields: UpdateEquipment) => {
    const { data } = await equipmentClient.put<ResponseWrap<EquipmentDto>>(`/equipments/${id}`, fields);
    return data;
};

export const deleteEquipmentQuery = async (id: number) => {
    equipmentClient.delete(`/equipments/${id}`);
};
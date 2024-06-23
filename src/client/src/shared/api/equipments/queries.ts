import type { AxiosError } from 'axios';
import { equipmentClient } from '../equipment-client';
import type { ApiException, ResponseWrap } from '../types';
import type { EquipmentDto, EquipmentFilters, EquipmentTypeDto, EquipmentTypeFilters, UpdateEquipmentParams, CreateEquipmentParams, CreateEquipmentsResponse } from './types';

export const getEquipmentsQuery = async (page?: number, limit?: number, filters?: EquipmentFilters) => {
    try {
        const { data } = await equipmentClient.get<ResponseWrap<EquipmentDto[]>>('/equipments', {
            params: {
                page,
                limit,
                ...filters
            }
        });
        return data;
    } catch (error) {
        const err = error as AxiosError<ApiException>;
        throw err.response?.data
    }
};

export const getEquipmentQuery = async (id: number) => {
    try {
        const { data } = await equipmentClient.get<ResponseWrap<EquipmentDto>>(`/equipments/${id}`);
        return data;
    } catch (error) {
        const err = error as AxiosError<ApiException>;
        throw err.response?.data
    }
};

export const getEquipmentTypesQuery = async (page?: number, limit?: number, filters?: EquipmentTypeFilters) => {
    try {
        const { data } = await equipmentClient.get<ResponseWrap<EquipmentTypeDto[]>>('/equipment-types', {
            params: {
                page,
                limit,
                ...filters
            }
        });
        return data;
    } catch (error) {
        const err = error as AxiosError<ApiException>;
        throw err.response?.data
    }
};


export const updateEquipmentQuery = async (id: number, fields: UpdateEquipmentParams) => {
    try {
        const { data } = await equipmentClient.put<ResponseWrap<EquipmentDto>>(`/equipments/${id}`, fields);
        return data;
    } catch (error) {
        const err = error as AxiosError<ApiException>;
        throw err.response?.data
    }
};


export const createEquipmentQuery = async (equipment: CreateEquipmentParams[]) => {
    try {
        const { data } = await equipmentClient.post<ResponseWrap<CreateEquipmentsResponse>>('/equipments', equipment);
        return data;
    } catch (error) {
        const err = error as AxiosError<ApiException>;
        throw err.response?.data
    }
}

export const deleteEquipmentQuery = async (id: number) => {
    try {
        equipmentClient.delete(`/equipments/${id}`);
    } catch (error) {
        const err = error as AxiosError<ApiException>;
        throw err.response?.data
    }
};
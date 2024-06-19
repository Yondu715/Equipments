import type { EquipmentFilters, EquipmentTypeFilters } from '~/shared/api/equipments/types';

export type EquipmentType = {
    id: number,
    name: string,
    mask: string,
    createdAt: Date,
    updatedAt: Date
};


export type Equipment = {
    id: number,
    serialNumber: string,
    desc: string,
    createdAt: Date,
    updatedAt: Date,
    equipmentType: EquipmentType
};


export type Pagination = {
    currentPage: number;
    from: number;
    lastPage: number,
    perPage: number;
    to: number;
    total: number
};

export interface GetEquipmentsParams {
    page?: number,
    limit?: number,
    filters?: EquipmentFilters
}
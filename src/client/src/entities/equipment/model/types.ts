import type { EquipmentFilters, EquipmentTypeFilters, UpdateEquipmentParams as UpdateEquipment } from '~/shared/api/equipments';

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
    desc: string | null,
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

export interface GetEquipmentTypesParams {
    page?: number,
    limit?: number,
    filters?: EquipmentTypeFilters
}

export interface UpdateEquipmentParams extends UpdateEquipment {
    id: number
}

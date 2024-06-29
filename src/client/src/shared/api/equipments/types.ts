export interface EquipmentTypeDto {
    id: number,
    name: string,
    mask: string,
    created_at: Date,
    updated_at: Date
}

export interface EquipmentDto {
    id: number,
    serial_number: string,
    desc: string | null,
    created_at: Date,
    updated_at: Date,
    equipment_type: EquipmentTypeDto
}

export interface UpdateEquipmentParams {
    serial_number?: string,
    desc?: string | null,
    equipment_type_id?: number
}

export interface CreateEquipmentParams {
    serial_number: string,
    desc: string | null,
    equipment_type_id: number
}

export interface CreateEquipmentsResponse {
    errors: {
        [key: string]: string
    },
    success: {
        [key: string]: EquipmentDto
    }
}

export type EquipmentFilters = Partial<Pick<EquipmentDto, 'serial_number' | 'desc'>>;
export type EquipmentTypeFilters = Partial<Pick<EquipmentTypeDto, 'name' | 'mask'>>;


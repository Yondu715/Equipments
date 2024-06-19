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
    desc: string,
    created_at: Date,
    updated_at: Date,
    equipment_type: EquipmentTypeDto
}

export interface UpdateEquipment {
    serial_number?: string,
    desc?: string,
    equipment_type_id?: number
}

export type EquipmentFilters = Partial<Pick<EquipmentDto, 'serial_number' | 'desc'>>;
export type EquipmentTypeFilters = Partial<Pick<EquipmentTypeDto, 'name' | 'mask'>>;


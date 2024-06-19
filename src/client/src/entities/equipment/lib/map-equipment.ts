import type { EquipmentDto, EquipmentTypeDto } from '~/shared/api/equipments/types';
import type { Equipment, EquipmentType } from '../model/types';


export const mapEquipmentType = (equipmentTypeDto: EquipmentTypeDto): EquipmentType => {
    return {
        id: equipmentTypeDto.id,
        name: equipmentTypeDto.name,
        mask: equipmentTypeDto.mask,
        createdAt: equipmentTypeDto.created_at,
        updatedAt: equipmentTypeDto.updated_at,
    };
};

export const mapEquipment = (equipmentDto: EquipmentDto): Equipment => {
    return {
        id: equipmentDto.id,
        serialNumber: equipmentDto.serial_number,
        desc: equipmentDto.desc,
        createdAt: equipmentDto.created_at,
        updatedAt: equipmentDto.updated_at,
        equipmentType: mapEquipmentType(equipmentDto.equipment_type)
    };
};

export const mapEquipments = (equipmentsDto: EquipmentDto[]): Equipment[] => {
    return equipmentsDto.map((equipmentDto) => mapEquipment(equipmentDto));
}
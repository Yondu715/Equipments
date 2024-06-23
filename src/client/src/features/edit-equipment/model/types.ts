import type { Equipment } from '~/entities/equipment';

export type EquipmentFields = {
    id: number,
    equipmentTypeId: number,
    desc: string,
    serialNumber: string
};
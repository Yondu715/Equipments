import type { Equipment } from '~/entities/equipment';

export type EquipmentFields = {
    id: number,
    equipmentTypeId: number,
    desc: string | null,
    serialNumber: string
};
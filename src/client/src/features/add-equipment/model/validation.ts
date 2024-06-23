export const isEmpty = (input: string) => {
    return input.trim().length === 0;
}

export const isEquipmentTypeIdValid = (equipmentTypeId: string) => {
    return !isNaN(Number(equipmentTypeId));
}
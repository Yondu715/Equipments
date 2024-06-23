const EQUIPMENTS = '/equipments';

export const routes = {
    root: '/',
    equipments: {
        root: EQUIPMENTS,
        equipment: `${EQUIPMENTS}/:id`,
        addEquipment: `${EQUIPMENTS}/add`,
        editEquipment: `${EQUIPMENTS}/:id/edit`
    },

}
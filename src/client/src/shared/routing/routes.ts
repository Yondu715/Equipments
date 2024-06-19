const EQUIPMENTS = '/equipments';

export const routes = {
    root: '/',
    equipments: {
        root: EQUIPMENTS,
        equipment: `${EQUIPMENTS}/:id`
    },

}
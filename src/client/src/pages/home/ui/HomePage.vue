<script setup lang="ts">
import { EquipmentCard } from '~/entities/equipment';
import { useUnit, useVModel } from 'effector-vue/composition';
import { equipmentModel } from '~/entities/equipment';
import { $currentPage, $isEquipmentsLoading, onItemClicked, pageMounted } from '../model/store';
import { SearchEquipments } from '~/features/search-equipments';
import { DocumentAdd } from '@element-plus/icons-vue';
import styles from './HomePage.module.css';

const {
    equipments,
    pagination,
    isLoading,
    onItemClickAction
} = useUnit({
    equipments: equipmentModel.$equipments,
    pagination: equipmentModel.$paginationInfo,
    isLoading: $isEquipmentsLoading,
    onItemClickAction: onItemClicked
});

const pageMountedAction = useUnit(pageMounted);
const currentPage = useVModel($currentPage);

onMounted(pageMountedAction);
</script>


<template>
    <div :class="styles.page">
        <div :class="styles.searchSection">
            <SearchEquipments />
            <ElButton :class="styles.addButton" :icon="DocumentAdd" type="primary">
                Добавить
            </ElButton>
        </div>
        <div :class="styles.dataSection">
            <div :class="styles.grid" v-loading="isLoading">
                <ElRow>
                    <ElCol :class="styles.col" :span="6" :key="equipment.id" v-for="equipment in equipments">
                        <EquipmentCard @click="onItemClickAction(equipment.id)" :equipment="equipment" />
                    </ElCol>
                </ElRow>
            </div>
            <div :class="styles.pagination">
                <ElPagination background :disabled="isLoading" layout="prev, pager, next"
                    :page-count="pagination?.lastPage" :default-page-size="pagination?.perPage"
                    v-model:current-page="currentPage" />
            </div>
        </div>
    </div>
</template>

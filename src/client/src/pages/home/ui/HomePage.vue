<script setup lang="ts">
import { EquipmentCard } from '~/entities/equipment';
import { useUnit, useVModel } from 'effector-vue/composition';
import { equipmentModel } from '~/entities/equipment';
import { $currentPage, $isEquipmentsLoading, onAddItemClicked, onItemClicked, pageMounted, pageUnmounted } from '../model/store';
import { SearchEquipments } from '~/features/search-equipments';
import { DocumentAdd } from '@element-plus/icons-vue';
import { ElButton, ElRow, ElCol, ElPagination } from 'element-plus';
import { onMounted, onUnmounted } from 'vue';
import styles from './HomePage.module.css';

const {
    equipments,
    pagination,
    isLoading,
    onMountedAction,
    onUnmountedAction,
    onAddItemClickAction,
    onItemClickAction
} = useUnit({
    equipments: equipmentModel.$equipments,
    pagination: equipmentModel.$paginationInfo,
    isLoading: $isEquipmentsLoading,
    onMountedAction: pageMounted,
    onUnmountedAction: pageUnmounted,
    onAddItemClickAction: onAddItemClicked,
    onItemClickAction: onItemClicked
});

const currentPage = useVModel($currentPage);

onMounted(onMountedAction);
onUnmounted(onUnmountedAction);
</script>


<template>
    <div :class="styles.page">
        <div :class="styles.searchSection">
            <SearchEquipments />
            <ElButton :class="styles.addButton" :icon="DocumentAdd" type="primary" @click="onAddItemClickAction">
                Добавить
            </ElButton>
        </div>
        <div :class="styles.dataSection">
            <div :class="styles.grid">
                <ElRow>
                    <ElCol :class="styles.col" :span="6" :key="equipment.id" v-for="equipment in equipments">
                        <EquipmentCard @click="onItemClickAction(equipment.id)" :equipment="equipment" />
                    </ElCol>
                </ElRow>
            </div>
            <div :class="styles.pagination">
                <ElPagination
                    background
                    :disabled="isLoading"
                    layout="prev, pager, next"
                    :page-count="pagination?.lastPage"
                    :default-page-size="pagination?.perPage"
                    v-model:current-page="currentPage"
                />
            </div>
        </div>
    </div>
</template>

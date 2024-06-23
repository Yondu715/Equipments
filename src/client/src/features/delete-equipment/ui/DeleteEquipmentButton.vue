<script setup lang="ts">
import { Delete } from '@element-plus/icons-vue';
import { ElButton } from 'element-plus';
import { $isDeleteEquipmentLoading, onItemClicked } from '../model/store';
import { useUnit } from 'effector-vue/composition';

interface IProps {
    equipmentId: number
};

const {
    isDeleteEquipmentLoading
} = useUnit({
    isDeleteEquipmentLoading: $isDeleteEquipmentLoading
});

const props = defineProps<IProps>();
</script>

<template>
    <ElButton
        type="danger"
        :icon="Delete" 
        @click="onItemClicked(props.equipmentId)"
        :loading="isDeleteEquipmentLoading"
        :disabled="isDeleteEquipmentLoading"
    >
        Удалить
    </ElButton>
</template>
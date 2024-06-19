<script setup lang="ts">
    import { Delete } from '@element-plus/icons-vue';
    import { onItemClicked } from '../model/store.ts';

    interface IProps {
        equipmentId: number
    };

    const props = defineProps<IProps>();
</script>

<template>
    <ElButton
        type="danger"
        :icon="Delete"
        @click="onItemClicked(props.equipmentId)"
    >
        Удалить
    </ElButton>
</template>
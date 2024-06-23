<script setup lang="ts">
import { useUnit, useVModel } from 'effector-vue/composition';
import { $isSearchLoading, $search, searchPressed } from '../model/store';
import { Search } from '@element-plus/icons-vue';
import { ElInput, ElButton } from 'element-plus';
import styles from './SearchEquipments.module.css';

const search = useVModel($search);
const {
    searchAction,
    isLoading
} = useUnit({
    searchAction: searchPressed,
    isLoading: $isSearchLoading
});
</script>

<template>
    <div :class="styles.wrapper">
        <ElInput :class="styles.input" v-model:model-value="search" clearable />
        <ElButton :class="styles.search" :icon="Search" @click="searchAction" :loading="isLoading" />
    </div>
</template>

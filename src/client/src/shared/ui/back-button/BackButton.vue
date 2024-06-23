<script setup lang="ts">
import { ElButton, ElAffix } from 'element-plus';
import { useUnit } from 'effector-vue/composition';
import { onButtonClicked } from './store';
import styles from './BackButton.module.css';

const onButtonClickedAction = useUnit(onButtonClicked);
</script>

<template>
    <ElAffix :offset="20" :class="styles.button">
        <ElButton type="primary" @click="onButtonClickedAction">
            Назад
        </ElButton>
    </ElAffix>
</template>
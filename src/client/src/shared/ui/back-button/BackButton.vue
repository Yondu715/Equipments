<script setup lang="ts">
    import styles from './BackButton.module.css';
    const router = useRouter();

    const onButtonClickAction = () => {
        router.go(-1);
    }
</script>

<template>
    <ElAffix
        :offset="20"
        :class="styles.button"
    >
        <ElButton
            type="primary"
            @click="onButtonClickAction"
        >
            Назад
        </ElButton>
    </ElAffix>
</template>
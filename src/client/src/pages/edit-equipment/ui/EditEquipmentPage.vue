<script setup lang="ts">
import { BackButton } from '~/shared/ui/back-button';
import { EditEquipmentForm } from '~/features/edit-equipment';
import styles from './EditEquipmentPage.module.css';
</script>

<template>
    <div :class="styles.page">
        <BackButton />
        <EditEquipmentForm />
    </div>
</template>
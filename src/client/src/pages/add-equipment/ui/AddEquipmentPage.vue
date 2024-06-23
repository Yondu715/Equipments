<script setup lang="ts">
import { AddEquipmentForm } from '~/features/add-equipment';
import { BackButton } from '~/shared/ui/back-button';
import styles from './AddEquipmentPage.module.css';
</script>

<template>
    <div :class="styles.page">
        <BackButton />
        <AddEquipmentForm />
    </div>
</template>
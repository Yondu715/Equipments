<script setup lang="ts">
import { defineProps } from 'vue';
import type { Equipment } from '../../model/types';
import styles from './EquipmentCard.module.css';

interface IProps {
    equipment: Equipment
}

const { equipment } = defineProps<IProps>();
</script>


<template>
    <div :class="styles.card">
        <div>
            Идентификатор: {{ equipment.id }}
        </div>
        <div>
            Серийный номер: {{ equipment.serialNumber }}
        </div>
    </div>
</template>

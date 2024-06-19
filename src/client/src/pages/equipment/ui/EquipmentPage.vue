<script setup lang="ts">
    import { useUnit } from 'effector-vue/composition';
    import { $isEquipmentLoading, pageMounted, pageUnmounted } from '../model/store';
    import { equipmentModel } from '~/entities/equipment';
    import styles from './EquipmentPage.module.css';
    import { DeleteEquipmentButton } from '~/features/delete-equipment';
import { BackButton } from '~/shared/ui/back-button';

    const route = useRoute();

    const {
        equipment,
        isLoading,
        onMountedAction,
        onUnmountedAction
    } = useUnit({
        isLoading: $isEquipmentLoading,
        equipment: equipmentModel.$equipment,
        onMountedAction: pageMounted,
        onUnmountedAction: pageUnmounted
    });

    onMounted(() => onMountedAction(Number(route.params.id)))
    onUnmounted(onUnmountedAction);

</script>

<template>
    <div
    :class="styles.page"
    v-loading="isLoading"
    >
        <BackButton />
        <ElCard
            v-if="equipment" 
            :class="styles.card"
        >
            <template #header>
                <span :class="styles.title">
                    Карточка оборудования
                </span>
            </template>
            <div :class="styles.body">
                <span>
                    Идентификатор: {{ equipment.id }}
                </span>
                <span>
                    Серийный номер: {{equipment.serialNumber}}
                </span>
                <span>
                    Тип:
                    <div :class="[styles.body, styles.inside]">
                        <span>
                            Идентификатор: {{ equipment.equipmentType.id }}
                        </span>
                        <span>
                            Название: {{ equipment.equipmentType.name }}
                        </span>
                        <span>
                            Маска: {{ equipment.equipmentType.mask }}
                        </span>
                    </div>
                </span>
                <span>
                    Примечание: {{ equipment.desc }}
                </span>
            </div>
            <template #footer>
                <ElButton
                    type="primary"
                >
                    Редактировать
                </ElButton>
                <DeleteEquipmentButton
                    v-if="equipment"
                    :equipment-id="equipment.id"
                />
            </template>
        </ElCard>

    </div>
</template>
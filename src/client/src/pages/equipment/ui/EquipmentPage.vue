<script setup lang="ts">
    import { useUnit } from 'effector-vue/composition';
    import { onEditClicked, pageMounted, pageUnmounted } from '../model/store';
    import { equipmentModel } from '~/entities/equipment';
    import { DeleteEquipmentButton } from '~/features/delete-equipment';
    import { BackButton } from '~/shared/ui/back-button';
    import { ElCard, ElButton } from 'element-plus';
    import { useRoute } from 'vue-router';
    import { onMounted, onUnmounted } from 'vue';
    import styles from './EquipmentPage.module.css';

    const route = useRoute();

    const {
        equipment,
        onMountedAction,
        onUnmountedAction,
        onEditButtonClickAction
    } = useUnit({
        equipment: equipmentModel.$equipment,
        onMountedAction: pageMounted,
        onUnmountedAction: pageUnmounted,
        onEditButtonClickAction: onEditClicked
    });

    onMounted(() => onMountedAction(Number(route.params.id)))
    onUnmounted(onUnmountedAction);
</script>

<template>
    <div
    :class="styles.page"
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
                    @click="() => onEditButtonClickAction(Number(route.params.id))"
                >
                    Редактировать
                </ElButton>
                <DeleteEquipmentButton
                    :equipment-id="equipment.id"
                />
            </template>
        </ElCard>

    </div>
</template>
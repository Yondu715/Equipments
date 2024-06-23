<script setup lang="ts">
import { ElForm, ElFormItem, ElInput, ElSelect, ElOption, ElButton } from 'element-plus';
import { onMounted } from 'vue';
import { useUnit, useVModel } from 'effector-vue/composition';
import { $equipmentFields, equipmentReseted, formMounted, updateEquipmentFormSubmitted } from '../model/store';
import { useRoute } from 'vue-router';
import { equipmentTypeModel } from '~/entities/equipment';
import styles from './EditEquipmentForm.module.css';

const route = useRoute();
const {
    onMountedAction,
    equipmentTypes,
    onResetClickAction,
    onSubmitClickAction
} = useUnit({
    onMountedAction: formMounted,
    onResetClickAction: equipmentReseted,
    equipmentTypes: equipmentTypeModel.$equipmentTypes,
    onSubmitClickAction: updateEquipmentFormSubmitted
});

const equipmentFields = useVModel($equipmentFields);

onMounted(() => onMountedAction(Number(route.params.id)));
</script>

<template>
    <div :class="styles.form" v-if="equipmentFields">
        <span :class="styles.title">
            Форма изменения оборудования
        </span>
        <ElForm label-position="top">
            <ElFormItem label="Тип оборудования:">
                <ElSelect
                    placeholder=""
                    v-model:model-value="equipmentFields.equipmentTypeId"
                >
                    <ElOption
                        v-for="equipmentType in equipmentTypes"
                        :key="equipmentType.id"
                        :label="equipmentType.name"
                        :value="equipmentType.id"
                    />
                </ElSelect>
            </ElFormItem>
            <ElFormItem label="Серийный номер:">
                <ElInput
                    v-model:model-value="equipmentFields.serialNumber"
                />
            </ElFormItem>
            <ElFormItem label="Примечание:">
                <ElInput
                    type="textarea"
                    v-model:model-value="equipmentFields.desc"
                />
            </ElFormItem>
            <ElFormItem>
                <ElButton
                    type="success"
                    @click="onSubmitClickAction"
                >
                    Сохранить
                </ElButton>
                <ElButton
                    @click="onResetClickAction"
                >
                    Сбросить
                </ElButton>
            </ElFormItem>
        </ElForm>
    </div>
</template>
<script setup lang="ts">
import { ElForm, ElFormItem, ElInput, ElSelect, ElOption, ElButton } from 'element-plus';
import { computed, onMounted } from 'vue';
import { useUnit, useVModel } from 'effector-vue/composition';
import {
    $desc, $equipmentTypeId, $isEquipmentTypesLoading,
    $serialNumbers, $totalEquipmentTypes, formMounted,
    onGetMoreClicked, addEquipmentFormReset,
    addEquipmentFormSubmitted,
    $isCreateEquipmentLoading
} from '../model/store';
import { equipmentTypeModel } from '~/entities/equipment';
import type { EquipmentType } from '~/entities/equipment/model/types';
import styles from './AddEquipmentForm.module.css';


const {
    onMountedAction,
    onGetMoreClickedAction,
    onResetFormClickedAction,
    onSubmitFormClickedAction,
    equipmentTypes,
    totalEquipmentTypes,
    isEquipmentTypesLoading,
    isCreateEquipmentLoading
} = useUnit({
    onMountedAction: formMounted,
    equipmentTypes: equipmentTypeModel.$equipmentTypes,
    onGetMoreClickedAction: onGetMoreClicked,
    onResetFormClickedAction: addEquipmentFormReset,
    totalEquipmentTypes: $totalEquipmentTypes,
    isEquipmentTypesLoading: $isEquipmentTypesLoading,
    isCreateEquipmentLoading: $isCreateEquipmentLoading,
    onSubmitFormClickedAction: addEquipmentFormSubmitted
});

const equipmentTypeId = useVModel($equipmentTypeId);
const serialNumbers = useVModel($serialNumbers);
const desc = useVModel($desc);


const isGetMoreButtonShow = computed(() => {
    if (!equipmentTypes.value || !totalEquipmentTypes.value) {
        return false;
    }
    return totalEquipmentTypes.value > equipmentTypes.value.length
});

const getFormattedLabel = computed(() => 
(equipmentType: EquipmentType) => {
    return `${equipmentType.name} - ${equipmentType.mask}`
});

onMounted(onMountedAction);
</script>

<template>
    <div :class="styles.form">
        <span :class="styles.title">
            Форма добавления оборудования
        </span>
        <ElForm label-position="top">
            <ElFormItem label="Тип оборудования:">
                <ElSelect
                    placeholder=""
                    :empty-values="[undefined]"
                    v-model:model-value="equipmentTypeId"
                >
                    <ElOption
                        v-for="equipmentType in equipmentTypes"
                        :key="equipmentType.id" 
                        :label="getFormattedLabel(equipmentType)" 
                        :value="equipmentType.id"
                    />
                    <template #footer v-if="isGetMoreButtonShow">
                        <ElButton
                            :class="styles.moreButton"
                            type="info"
                            @click="onGetMoreClickedAction"
                            :loading="isEquipmentTypesLoading"
                        >
                            Показать больше
                        </ElButton>
                    </template>
                </ElSelect>
            </ElFormItem>
            <ElFormItem label="Серийные номера:">
                <ElInput
                    placeholder="Например: '123123 123123'"
                    v-model:model-value="serialNumbers"    
                />
            </ElFormItem>
            <ElFormItem label="Примечание:">
                <ElInput
                    type="textarea"
                    v-model:model-value="desc"
                />
            </ElFormItem>
            <ElFormItem>
                <ElButton
                    type="success"
                    @click="onSubmitFormClickedAction"
                    :loading="isCreateEquipmentLoading"
                    :disabled="isCreateEquipmentLoading"
                >
                    Добавить
                </ElButton>
                <ElButton
                    @click="onResetFormClickedAction"
                    :disabled="isCreateEquipmentLoading"
                >
                    Очистить
                </ElButton>
            </ElFormItem>
        </ElForm>
    </div>
</template>


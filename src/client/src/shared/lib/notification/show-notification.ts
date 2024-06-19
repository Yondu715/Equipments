import { createEffect } from 'effector';
import { ElNotification } from 'element-plus';

export interface INotificationOption {
    title?: string,
    message?: string,
    type?: "success" | "warning" | "error" | "info",
    duration?: number
}


export const showNotificationFx = createEffect(async (options?: INotificationOption) => {
    ElNotification(options);
});
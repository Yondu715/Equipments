import { createEvent, sample } from 'effector';
import { navigateToBackFx } from '~/shared/routing';

export const onButtonClicked = createEvent();

sample({
    clock: onButtonClicked,
    target: navigateToBackFx
});
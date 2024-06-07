import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {Datepicker, Input, initTE} from "tw-elements";

initTE({Datepicker, Input}, {allowReinits: true});


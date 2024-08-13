import * as Menu from "./menu.js"
import './../scss/style.scss';
import * as F from './_functions.js';


//menu drop down
Menu.dropDownMainMenu();


F.showElement("articl-actions-delete","articl-delete-form");
F.hideElement("articl-delete-form-btn__cancel","articl-delete-form");
F.autoSizingTextArea('#articl-edit-txt');
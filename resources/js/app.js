import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2'
import './TreeMaker/tree_maker';
import TreeMaker from "./TreeMaker/tree_maker";
window.Alpine = Alpine;
window.Swal = Swal

Alpine.start();


let nestedTree = {
    8: '',
    9: {
        10: '',
        11: {
            13: '',
        },
    },
    12: '',
}

let tree = {
    1: {
        2: '',
        3: {
            6: '',
            7: nestedTree,
        },
        4: {
            7: nestedTree,
        },
        5: ''
    },
};

let params = {
    1: {trad: 'adrien / leo'},
    2: {trad: 'Card 2'},
    3: {trad: 'Card 3'},
    4: {trad: 'Card 4'},
    5: {trad: 'Card 5'},
    6: {trad: 'Card 6'},
    7: {trad: 'Card 7'},
};

let tree_Maker =  new TreeMaker(tree, {
    id: 'my_tree',
    card_click: function (element) {
        console.log(element);
    },
    treeParams: params,
    'link_width': '4px',
    'link_color': '#2199e8',
});
window.onresize = function () {
    tree_Maker.connectCard();
};

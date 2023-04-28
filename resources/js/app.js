import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2'
import tippy from 'tippy.js';


import Tower from './chess/Tower';

window.Alpine = Alpine;
window.Swal = Swal;
window.tippy = tippy;

Alpine.start();

// const locate = [[0][0]];
// const whiteTower1 = new Tower("/img/chess/wr.png", "white", locate);

// const imgRook1 = document.createElement("img");
// imgRook1.src = whiteTower1.imageUrl;
// imgRook1.alt = "Tour";
// imgRook1.classList.add(whiteTower1.startPosition, "tower1");

// const position = document.getElementById("0.0");

// position.append(imgRook1);

// const tour = document.querySelector(".tower1");

// tour.addEventListener('click', (e) =>{
//     console.log(locate);
// });

const matrix = [];

for (let x = 0; x < 8; x++) {
    matrix.push([])
    for (let y = 0; y < 8; y++) {
        // matrix[x].push(`${y}.${7-x}`);
        matrix[x].push([y, 7-x]);
    }
}

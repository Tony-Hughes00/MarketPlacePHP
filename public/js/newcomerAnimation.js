/**
 * Animation qui n'apparaît que lors de la première visite
 */

let carAnim = document.querySelector('.car-anim');
// let unblur = document.querySelector('#car-icon');

carAnim.addEventListener('animationstart', () => {
    console.log('Start');
});
carAnim.addEventListener('animationend', () => {
    console.log('End');
});
// unblur.addEventListener('animationstart', () => {
//     console.log('Part 2 Start');
// });
// unblur.addEventListener('animationend', () => {
//     console.log('Part 2 End');
// });

carAnim.onanimationend = () => {
    $('.car-anim').attr('class', 'fas fa-car car-anim');
    $('.blur-switch').attr('class', 'container-fluid blur-switch unblur');
};
// unblur.onanimationend = () => {
//     $('.blur-switch').attr('class', 'container-fluid blur-switch unblur');
// };
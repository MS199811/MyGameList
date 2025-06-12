"use strict";

const menuButtons = document.querySelectorAll('.menuButton');

    menuButtons.forEach(button => {
    button.addEventListener('click', () => {
            // Toggle class 'active' op het ouder <li>-element
            const parentLi = button.closest('.menu-item');
            parentLi.classList.toggle('active');
    });
});
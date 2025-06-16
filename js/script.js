"use strict";

const menuButtons = document.querySelectorAll('.menuButton');

    menuButtons.forEach(button => {
    button.addEventListener('click', () => {
            // Toggle class 'active' op het ouder <li>-element
            const parentLi = button.closest('.menu-item');
            parentLi.classList.toggle('active');
    });
});

const submenuButtons = document.querySelectorAll('.submenuButton');

submenuButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Toggle the 'active' class on the clicked submenu button
        button.classList.toggle('active');
    });
});
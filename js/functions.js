"use strict";

document.querySelector("#more-trending").addEventListener("click", () => {
     // 1. Maak het element leeg
     document.querySelector("main").innerHTML = '';

     // 2. Roep een PHP script aan via fetch
     fetch('includes/script.php')
         .then(response => response.text())
         .then(data => {
             // 3. Vul het element met de response van PHP
             document.querySelector("main").innerHTML = data;
         })
         .catch(error => {
             console.error('Fout bij ophalen:', error);
         });
});

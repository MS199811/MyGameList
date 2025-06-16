"use strict";

document.querySelectorAll('.action-button').forEach(button => {
    button.addEventListener('click', () => {
        const funcName = button.dataset.function;

        fetch('includes/script.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `function=${funcName}`
        })
        .then(response => response.text()) // of response.json() als je JSON terugkrijgt
        .then(data => {
            document.querySelector("main").innerHTML = data;
            const mainStyling = document.querySelector("main").style;
            mainStyling.gridTemplateColumns = "1fr 1fr 1fr 1fr 1fr";
            mainStyling.gridTemplateRows = "1fr 1fr";
        })
        .catch(error => {
            console.error('Fout bij ophalen:', error);
        });
    });
});
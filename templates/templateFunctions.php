<?php


function removeSearch()
{
    echo "window.addEventListener('load', function() {
        var searchForm = document.querySelector(`form[role='search']`);
        if (searchForm) {
            searchForm.parentNode.removeChild(searchForm);
        }
    });";
}

function displayTitle(string $title = "")
{
    echo "div = document.createElement('title');
        div.textContent = '$title';
        head = document.getElementsByTagName('head')[0];
        head.appendChild(div);";
}

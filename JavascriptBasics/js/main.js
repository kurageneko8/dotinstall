'use strict';

{
    const text = document.querySelector('textarea');

    text.addEventListener('focus', () => {
        console.log('focused');
    });

    text.addEventListener('blur', () => {
        console.log('blured');
    });
}
/* // script.js
document.addEventListener('DOMContentLoaded', () => {
    const wordElement = document.querySelector('.word-transition .word');
    const button = document.getElementById('toggleButton');
    let isSell = true;
  
    button.addEventListener('click', () => {
      if (isSell) {
        wordElement.style.transform = 'translateY(-100%)';
        setTimeout(() => {
          wordElement.textContent = 'buy';
          wordElement.style.transform = 'translateY(0)';
        }, 500);
      } else {
        wordElement.style.transform = 'translateY(-100%)';
        setTimeout(() => {
          wordElement.textContent = 'sell';
          wordElement.style.transform = 'translateY(0)';
        }, 500);
      }
      isSell = !isSell;
    });
  });
 */  
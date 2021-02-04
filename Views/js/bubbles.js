function createBubble(){

    const section = document.querySelector('header');
    const createElement = document.createElement('span');
    var size = Math.random() * 60;

    createElement.style.width = 20 + size + 'px';
    createElement.style.height = 20 + size + 'px';
    createElement.style.left = Math.random() * screen.width - 80 + 'px';
    section.appendChild(createElement);

    setTimeout(() => {
        createElement.remove()
    }, 4000)
}

setInterval(createBubble, 50);
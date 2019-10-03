const greetings = [
    'Hola mundo.',
    'Hola món.',
    'Hello world.',
    'Olá Mundo.',
    'Kaixo Mundua.',
    'Bonjour le monde.',
    'Ola mundo.',
    'Saluton mondo.',
    'สวัสดีชาวโลก.',
    '你好，世界.',
    '안녕하세요 세계.',
    'Hej Verden.',
    'Hei maailma.',
    '.سلام دنیا',
    'Witaj świecie',
];

const _el = document.querySelector('#greetings');

changeGreeting = (el) => {
    const index = Math.floor(Math.random() * greetings.length);
    el.innerHTML = greetings[index];
};

changeGreeting(_el);
_el.classList.add('opacity-100');
setInterval(() => {
    _el.classList.remove('opacity-100');
    _el.classList.add('opacity-0');
    setTimeout(()=> {
        changeGreeting(_el);
        _el.classList.remove('opacity-0');
        _el.classList.add('opacity-100');
    }, 500);
}, 5000);
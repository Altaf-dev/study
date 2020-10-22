document.querySelector('.header__menu_btn').onclick = function() {
    document.querySelector('.header__nav').classList.toggle('active');
    document.querySelector('.header__menu_btn').classList.toggle('close');
};
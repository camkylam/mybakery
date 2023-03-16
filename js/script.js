let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () => {
    profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () => {
    profile.classList.toggle('active');
}


window.onscroll = () => {
    nav.classList.remove('active');
    profile.classList.remove('active');
}
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
    
}

window.onscroll = () =>{
    profile.classList.remove('active');
    navbar.classList.remove('active');
}

subImages = document.querySelectorAll('.quick-view .box .image-container .small-images img');
mainImages = document.querySelector('.quick-view .box .image-container .big-image img');

subImages.forEach(images => {
    images.onclick = () =>{
        let src = images.getAttribute('src');
        mainImages.src = src;
    }
});
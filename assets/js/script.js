const likeBtn = document.querySelector('.like-btn');
const profileBtn = document.querySelector('.profile');
const profile = document.querySelector('.profile-info');
// const LogoutBtn = document.querySelector('.logout');

likeBtn.addEventListener('click', function() {
    this.classList.toggle('active');
});

profileBtn.addEventListener('click', function() {
    
    profile.classList.toggle('none');
});

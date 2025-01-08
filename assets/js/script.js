const likeBtn = document.querySelector('.like-btn');

likeBtn.addEventListener('click', function() {
    this.classList.toggle('active');
});
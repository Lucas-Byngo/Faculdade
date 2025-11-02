const toggle = document.getElementById("toggle-theme");

toggle.addEventListener("click", () => {
  document.body.classList.toggle("dark");

  toggle.textContent = document.body.classList.contains("dark") ? "🌙" : "☀️";
});

var userLogged = localStorage.getItem('user_logged');
var userNameSpan = document.getElementById('user_name');

if (userLogged) {
  userLogged = JSON.parse(userLogged);
  userNameSpan.innerText = 'Bem vindo ' + userLogged.nome + '!';

  document.querySelectorAll('.logged').forEach(el => {
    el.style.display = 'block';
  });

  if (userLogged.admin === 1) {
    document.querySelectorAll('.logged-admin').forEach(el => {
      el.style.display = 'block'
    });
  }

  document.querySelectorAll('.not_logged').forEach(el => {
    el.style.display = 'none';
  });
}

// const fileName = new URL(window.location.href).pathname.split('/').pop();

// if (!userLogged && (fileName == 'index.php' || fileName == '')) {
//   window.location.href = "login.php";
// }

document.getElementById('logout').addEventListener('click', (logout) => {
  logout.preventDefault()

  localStorage.removeItem('user_logged');
  window.location.href = "login.php";
})

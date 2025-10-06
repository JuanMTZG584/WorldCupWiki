//Usado en index, profile y worldcup
document.getElementById('deleteItem').addEventListener('click', function () {
    const buttonIcon = document.querySelector('#dropdownButton i');
    buttonIcon.classList.replace('fa-ellipsis-h', 'fa-check');
    setTimeout(() => {
        buttonIcon.classList.replace('fa-check', 'fa-ellipsis-h');
    }, 1000);
});
document.getElementById('deleteItemComment').addEventListener('click', function () {
    const buttonIcon = document.querySelector('#dropdownButtonComment i');
    buttonIcon.classList.replace('fa-ellipsis-h', 'fa-check');
    setTimeout(() => {
        buttonIcon.classList.replace('fa-check', 'fa-ellipsis-h');
    }, 1000);
});
document.getElementById('editItemComment').addEventListener('click', function () {
    const buttonIcon = document.querySelector('#dropdownButtonComment i');
    buttonIcon.classList.replace('fa-ellipsis-h', 'fa-spinner');
    setTimeout(() => {
        buttonIcon.classList.replace('fa-spinner', 'fa-ellipsis-h');
    }, 1000);
}); 

document.getElementById('editarBtn').addEventListener('click', function (event) {
    event.preventDefault();
    var myModal = new bootstrap.Modal(document.getElementById('modalPublicacion'));
    myModal.show();
});

document.getElementById('btnMeGusta').addEventListener('click', function () {
    this.classList.toggle('btn-outline-primary');
    this.classList.toggle('btn-primary');
    const icon = this.querySelector('i');
    if (this.classList.contains('btn-primary')) {
        icon.classList.replace('fa-thumbs-up', 'fa-thumbs-down');
    } else {
        icon.classList.replace('fa-thumbs-down', 'fa-thumbs-up');
    }
});

//tambien lo usa el index y el worldcup
const usuarioBtn = document.getElementById('usuarioBtn');
const usuarioInput = document.getElementById('usuarioInput');
usuarioBtn.addEventListener('click', () => {
    usuarioInput.classList.toggle('active');
});

function filtrarPublicaciones() {
  const categoria = document.getElementById('categoriafilter')?.checked || false;
  const anoElem = document.getElementById('ano');
  const paisElem = document.getElementById('pais');
  const ano = anoElem ? anoElem.checked : false;
  const pais = paisElem ? paisElem.checked : false;
  const usuario = usuarioInput.value.trim();
  
  const publicacionesDiv = document.getElementById('publicaciones');
  publicacionesDiv.innerHTML = `
    <p>Filtrando por:</p>
    <ul>
      ${categoria ? '<li>Categoría: Deportes</li>' : ''}
      ${ano ? '<li>Año Mundial: 2022</li>' : ''}
      ${pais ? '<li>País Sede: Qatar</li>' : ''}
      ${usuario ? `<li>Usuario: ${usuario}</li>` : ''}
    </ul>
  `;
}
document.querySelectorAll('.filter-group input').forEach(input => {
  input.addEventListener('change', filtrarPublicaciones);
});
if (usuarioInput) {
  usuarioInput.addEventListener('input', filtrarPublicaciones);
}


//tambien lo usa el index y el worldcup
const form = document.querySelector('#formPublicacion form');
const btn = document.getElementById('btnPublicar');
const btnText = document.getElementById('btnText');
const btnIcon = document.getElementById('btnIcon');
const mensaje = document.getElementById('mensajePublicacion');

form.addEventListener('submit', function (e) {
    e.preventDefault();

    btn.disabled = true;
    btnIcon.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    setTimeout(() => {
        btnIcon.innerHTML = '<i class="fas fa-check-circle"></i>';
        btnText.textContent = 'Publicado';
        mensaje.style.display = 'block';

        setTimeout(() => {
            btn.disabled = false;
            btnIcon.innerHTML = '';
            btnText.textContent = 'Publicar';
            mensaje.style.display = 'none';
        }, 2000);

    }, 1500);
});
//tambien se usa en profile y el index y el worldcup
document.querySelector('.submit-comment').addEventListener('click', function () {
    const icon = this.querySelector('.icon-send');

    icon.classList.remove('fa-paper-plane');
    icon.classList.add('fa-spinner', 'fa-spin');

    setTimeout(() => {
        icon.classList.remove('fa-spinner', 'fa-spin');
        icon.classList.add('fa-check');
        icon.style.color = 'green';

        setTimeout(() => {
            icon.classList.remove('fa-check');
            icon.classList.add('fa-paper-plane');
            icon.style.color = '';
        }, 1500);
    }, 2000);
});


//usado en index y worldcup
document.getElementById("searchButton").addEventListener("click", function () {
    alert("Búsqueda realizada correctamente.");
});

document.querySelectorAll('.order-by').forEach(item => {
    item.addEventListener('click', function () {
        const selectedText = this.textContent;
        const dropdownButton = document.getElementById('filtroDropdown');
        dropdownButton.innerHTML = `Ordenado por: ${selectedText} <span class="caret"></span>`;
    });
});



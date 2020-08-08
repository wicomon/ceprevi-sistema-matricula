var btn_cargar = document.getElementById('btn_cargar_usuarios'),
	error_box = document.getElementById('error_box'),
	tabla = document.getElementById('tabla'),
	btn_eliminar = document.getElementById('eliminar'),
	loader = document.getElementById('loader');
	

var usuario_naaa,
	usuario_edad,
	usuario_pais,
	usuario_correo;

function cargarUsuarios(){
	tabla.innerHTML = '<tr><th>Nombre</th><th>Número</th><th>Capacidad</th><th>Pabellon</th><th>Turno</th><th>Sede</th><th>Ciclo</th><th>Acciones</th></tr>';

	var peticion = new XMLHttpRequest();
	peticion.open('GET', 'php/leer-datos.php');

	loader.classList.add('active');

	peticion.onload = function(){
		var datos = JSON.parse(peticion.responseText);
		
		if(datos.error){
			error_box.classList.add('active');
		} else {
			for(var i = 0; i < datos.length; i++){
				var elemento = document.createElement('tr');
				elemento.innerHTML += ("<td>" + datos[i].nombre + "</td>");
				elemento.innerHTML += ("<td>" + datos[i].numero + "</td>");
				elemento.innerHTML += ("<td>" + datos[i].capacidad + "</td>");
				elemento.innerHTML += ("<td>" + datos[i].pabellon + "</td>");
				elemento.innerHTML += ("<td>" + datos[i].turno + "</td>");
				elemento.innerHTML += ("<td>" + datos[i].sede + "</td>");
				elemento.innerHTML += ("<td>" + datos[i].ciclo + "</td>");
				elemento.innerHTML += ('<td><a href="php/eliminar.php?cod='+ datos[i].ID + '" class="btn" id="eliminar">Eliminar</a></td>')
				tabla.appendChild(elemento);
			}
		}
		
	}

	peticion.onreadystatechange = function(){
		if(peticion.readyState == 4 && peticion.status == 200){
			loader.classList.remove('active');
		}
	}

	peticion.send();
}

function agregarUsuarios(e){
	e.preventDefault();

	var peticion = new XMLHttpRequest();
	peticion.open('post', 'php/insertar-usuario.php');

	usuario_nombre = formulario.nombre.value.trim();
	usuario_numero = parseInt(formulario.numero.value.trim());
	usuario_capacidad = parseInt(formulario.capacidad.value.trim());
	usuario_pabellon = formulario.pabellon.value.trim();
	usuario_turno = formulario.turno.value.trim();
	usuario_sede = formulario.sede.value.trim();
	usuario_ciclo = formulario.ciclo.value.trim();

		console.log(usuario_nombre);
		error_box.classList.remove('active');
		var parametros = 'numero='+ usuario_numero + '&nombre='+ usuario_nombre +'&capacidad='+ usuario_capacidad +'&pabellon=' + usuario_pabellon +'&turno=' + usuario_turno +'&sede=' + usuario_sede +'&ciclo=' + usuario_ciclo;

		peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		loader.classList.add('active');

		peticion.onload = function(){
			cargarUsuarios();
			formulario.nombre.value = '';
			formulario.numero.value = '';
			formulario.capacidad.value = '';
			formulario.pabellon.value = '';
			formulario.turno.value = '';
			formulario.sede.value = '';
			formulario.ciclo.value = '';
		}

		peticion.onreadystatechange = function(){
			if(peticion.readyState == 4 && peticion.status == 200){
				loader.classList.remove('active');
			}
		}

		peticion.send(parametros);

		
	} 



btn_cargar.addEventListener('click', function(){
	cargarUsuarios();
});

formulario.addEventListener('submit', function(e){
	agregarUsuarios(e);
});


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Pasajeros</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto bg-white shadow-lg p-6 mt-8 rounded-lg">
    <h1 class="text-2xl font-bold text-gray-700 mb-4">✈ Registrar Pasajeros</h1>

    <form action="{{ route('pasajeros.store') }}" method="POST">
        @csrf
        <input type="hidden" name="reserva_id" value="{{ $reserva->id }}">

        <div id="pasajeros-container">
            <div class="grid grid-cols-2 gap-4 pasajero-item mb-6 p-4 border rounded-lg bg-gray-50">
                <h2 class="col-span-2 font-semibold text-lg text-gray-600">🧍 Pasajero 1</h2>

                <input type="text" name="pasajeros[0][nombre]" placeholder="Nombre"
                       class="border p-2 rounded" required>
                <input type="text" name="pasajeros[0][apellido]" placeholder="Apellido"
                       class="border p-2 rounded" required>

                <select name="pasajeros[0][genero]" class="border p-2 rounded" required>
                    <option value="">Género</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option value="O">Otro</option>
                </select>

                <input type="date" name="pasajeros[0][fecha_nacimiento]" class="border p-2 rounded" required>

                <select name="pasajeros[0][tipo_documento]" class="border p-2 rounded" required>
                    <option value="">Tipo de Documento</option>
                    <option value="CC">Cédula</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="PA">Pasaporte</option>
                </select>

                <input type="text" name="pasajeros[0][numero_documento]" placeholder="Número de Documento"
                       class="border p-2 rounded" required>

                <input type="email" name="pasajeros[0][email]" placeholder="Correo Electrónico"
                       class="border p-2 rounded">

                <input type="text" name="pasajeros[0][telefono]" placeholder="Teléfono"
                       class="border p-2 rounded">

                <select name="pasajeros[0][asiento]" class="border p-2 rounded col-span-2" required>
                    <option value="">Seleccionar Asiento</option>
                    @foreach($asientosDisponibles as $asiento)
                        <option value="{{ $asiento->codigo }}">{{ $asiento->codigo }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="button" id="agregarPasajero"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            ➕ Agregar otro pasajero
        </button>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 float-right">
            Guardar Pasajeros
        </button>
    </form>
</div>

<script>
    let pasajeroIndex = 1;
    document.getElementById('agregarPasajero').addEventListener('click', function () {
        const container = document.getElementById('pasajeros-container');
        const nuevo = container.children[0].cloneNode(true);

        nuevo.querySelectorAll('input, select').forEach(input => {
            let name = input.getAttribute('name');
            if (name) {
                input.setAttribute('name', name.replace(/\d+/, pasajeroIndex));
            }
            input.value = '';
        });

        nuevo.querySelector('h2').innerText = `🧍 Pasajero ${pasajeroIndex + 1}`;
        container.appendChild(nuevo);
        pasajeroIndex++;
    });
</script>

</body>
</html>

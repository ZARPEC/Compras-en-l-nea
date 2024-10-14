let carrito = JSON.parse(sessionStorage.getItem("carrito")) || [];

// Función para guardar el carrito en localStorage
function guardarCarrito() {
  sessionStorage.setItem("carrito", JSON.stringify(carrito));
}

// Función para agregar un producto al carrito
function agregarAlCarrito(producto) {
  // Verificar si el producto ya existe en el carrito
  const existeProducto = carrito.find((item) => item.id === producto.id);

  if (existeProducto) {
    // Si el producto ya existe, simplemente incrementamos la cantidad
    existeProducto.cantidad += 1;
  } else {
    // Si el producto no está en el carrito, lo añadimos
    carrito.push({ ...producto });
    alert("Se Agrego al carrito el porducto " + producto.nombre);
  }
  guardarCarrito();
  // Mostrar el carrito en consola (puedes actualizar el HTML también)
  console.log(carrito);
}

function mostrarCarrito() {
  const cartItems = document.getElementById("cart-items");
  cartItems.innerHTML = "";
  let subtotal = 0;

  carrito.forEach((item, index) => {
    const itemSubtotal = item.precio * item.cantidad;
    subtotal += itemSubtotal;

    cartItems.innerHTML += `
                <tr>
                    <td>${item.nombre}</td>
                    <td><input type="number" class="form-control" value="${
                      item.cantidad
                    }" min="1" onchange="actualizarCantidad(${index}, this.value)" style="width: 80px;"></td>
                    <td>Q${item.precio.toFixed(2)}</td>
                    <td>Q${itemSubtotal.toFixed(2)}</td>
                    <td><button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${index})">Eliminar</button></td>
                </tr>
            `;
  });

  const impuestos = subtotal * 0.12;
  const total = subtotal;

  document.getElementById("subtotal").textContent = `Q${subtotal.toFixed(2)}`;
  document.getElementById("total").textContent = `Q${total.toFixed(2)}`;
}

// Función para actualizar la cantidad de un producto
function actualizarCantidad(index, nuevaCantidad) {
  carrito[index].cantidad = parseInt(nuevaCantidad);
  guardarCarrito();
  mostrarCarrito();
}

// Función para eliminar un producto del carrito
function eliminarDelCarrito(index) {
  carrito.splice(index, 1);
  guardarCarrito();
  mostrarCarrito();
}

function vaciarCarrito() {
  sessionStorage.removeItem('carrito'); // Vaciar el carrito en sessionStorage
}
// Cargar el carrito al cargar la página
document.addEventListener("DOMContentLoaded", mostrarCarrito);


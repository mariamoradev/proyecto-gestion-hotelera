CREATE TABLE Reserva_Evento (
    ID_reserva_evento SERIAL PRIMARY KEY,
    Nombre_Completo VARCHAR(255) NOT NULL,
    Correo_Electronico VARCHAR(255) NOT NULL,
    Telefono VARCHAR(50) NOT NULL,
    Cuenta_Bancaria VARCHAR(255) NOT NULL,
    Numero_Cuenta VARCHAR(255) NOT NULL,
    Seleccione_Salon VARCHAR(255) NOT NULL,
    Fecha_evento DATE NOT NULL,
    Tipo_evento VARCHAR(255) NOT NULL,
    Servicios_Adicionales VARCHAR(255),
    ID_salon_eventos INT NOT NULL,
    ID_Cliente INT NOT NULL,
    FOREIGN KEY (ID_Cliente) REFERENCES CLIENTE(ID_Cliente)
);



CREATE TABLE Cliente (
    ID_cliente SERIAL PRIMARY KEY,
    Nombres VARCHAR(255) NOT NULL,
    Apellidos VARCHAR(255) NOT NULL,
    Tipo_documento_identidad VARCHAR(50) NOT NULL,
    Correo VARCHAR(255) NOT NULL,
    Telefono VARCHAR(255) NOT NULL,
    Nacionalidad VARCHAR(255) NOT NULL,
    Fecha_nacimiento DATE NOT NULL,
    
);




CREATE TABLE Reserva_restaurante (
    ID_reserva_restaurante SERIAL PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    Fecha DATE NOT NULL,
    Hora TIME NOT NULL,
    Cantidad_personas INT NOT NULL,
    Tipo_comida VARCHAR(255) NOT NULL,
    
    
);


CREATE TABLE Pedido(
Id_pedido SERIAL PRIMARY KEY,
Pedido_proveedor VARCHAR(255) NOT NULL,
Pedido_lavanderia VARCHAR(255) NOT NULL,
ID_proveedor INT NOT NULL,
FOREIGN KEY (ID_proveedor) REFERENCES Proveedor(ID_proveedor)
);








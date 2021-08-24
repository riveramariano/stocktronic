/*
 DROP TABLE H_ENTREGAS;
 DROP TABLE H_ERRORES;
 DROP TABLE DETALLE_ORDEN;
 DROP TABLE ORDEN;
 DROP TABLE INFO_PAGO;
 DROP TABLE METODO_PAGO;
 DROP TABLE CARRITO;
 DROP TABLE USUARIO;
 DROP TABLE ROL;
 DROP TABLE PRODUCTO;
 DROP TABLE CATEGORIA;
 DROP TABLE PROVEEDOR;
 DROP TABLE SUCURSAL;
*/

-- Estructura de tabla para la tabla CARRITO ---------------------------------------------------------------------------------

CREATE TABLE CARRITO (
  ID_CARRITO NUMBER GENERATED ALWAYS AS IDENTITY,
  CANTIDAD NUMBER NOT NULL,
  ID_USUARIO NUMBER NOT NULL,
  ID_PRODUCTO NUMBER NOT NULL
);

-- Estructura de tabla para la tabla CATEGORIA -------------------------------------------------------------------------------

CREATE TABLE CATEGORIA (
  ID_CATEGORIA NUMBER GENERATED ALWAYS AS IDENTITY,
  TIPO VARCHAR2(25) NOT NULL
);

-- Estructura de tabla para la tabla DETALLE_ORDEN ---------------------------------------------------------------------------

CREATE TABLE DETALLE_ORDEN (
  ID_DETALLEORDEN NUMBER GENERATED ALWAYS AS IDENTITY,
  ID_PRODUCTO NUMBER NOT NULL,
  PRECIO NUMBER NOT NULL, 
  CANTIDAD NUMBER NOT NULL,
  URL_IMAGEN VARCHAR(200) NOT NULL,
  ID_ORDEN NUMBER NOT NULL,
  ID_USUARIO NUMBER NOT NULL
);

-- Estructura de tabla para la tabla H_ENTREGAS ------------------------------------------------------------------------------

CREATE TABLE H_ENTREGAS (
  ID_ENTREGAS NUMBER GENERATED ALWAYS AS IDENTITY,
  FEC_ENTREGA DATE NOT NULL,
  ID_PRODUCTO NUMBER NOT NULL,
  ID_PROVEEDOR NUMBER NOT NULL
);

-- Estructura de tabla para la tabla H_ERRORES -------------------------------------------------------------------------------

CREATE TABLE H_ERRORES (
  ID_ERRORES NUMBER GENERATED ALWAYS AS IDENTITY,
  FEC_ERROR DATE NOT NULL,
  DESCRIPCION VARCHAR2(100) NOT NULL,
  ID_USUARIO NUMBER NOT NULL
);

-- Estructura de tabla para la tabla INFO_PAGO -------------------------------------------------------------------------------

CREATE TABLE INFO_PAGO (
  ID_INFOPAGO NUMBER GENERATED ALWAYS AS IDENTITY,
  NUM_TARJETA VARCHAR2(25) NOT NULL,
  DIR_FACTURACION VARCHAR2(30) NOT NULL,
  DIR_FACTURACION2 VARCHAR2(30) NOT NULL,
  TELEFONO VARCHAR2(16) NOT NULL,
  TOTAL NUMBER NOT NULL,
  ID_USUARIO NUMBER NOT NULL,
  ID_METODOPAGO NUMBER NOT NULL
);

-- Estructura de tabla para la tabla METODO_PAGO -----------------------------------------------------------------------------

CREATE TABLE METODO_PAGO (
  ID_METODOPAGO NUMBER GENERATED ALWAYS AS IDENTITY,
  NOMBRE VARCHAR2(15) NOT NULL
);

-- Estructura de tabla para la tabla ORDEN -----------------------------------------------------------------------------------

CREATE TABLE ORDEN (
  ID_ORDEN NUMBER GENERATED ALWAYS AS IDENTITY,
  FEC_ORDEN DATE NOT NULL,
  MONTO_TOTAL FLOAT(1) NOT NULL,
  ID_INFOPAGO NUMBER NOT NULL,
  ID_USUARIO NUMBER NOT NULL
);

-- Estructura de tabla para la tabla PRODUCTO --------------------------------------------------------------------------------

CREATE TABLE PRODUCTO (
  ID_PRODUCTO NUMBER GENERATED ALWAYS AS IDENTITY,
  NOMBRE VARCHAR2(30) NOT NULL,
  DESCRIPCION VARCHAR2(200) NOT NULL,
  URL_IMAGEN VARCHAR2(200) NOT NULL,
  PRECIO NUMBER NOT NULL,
  CANTIDAD NUMBER NOT NULL,
  ID_PROVEEDOR NUMBER NOT NULL,
  ID_CATEGORIA NUMBER NOT NULL
);

-- Estructura de tabla para la tabla PROVEEDOR -------------------------------------------------------------------------------

CREATE TABLE PROVEEDOR (
  ID_PROVEEDOR NUMBER GENERATED ALWAYS AS IDENTITY,
  NOMBRE VARCHAR2(30) NOT NULL,
  CED_JURIDICA VARCHAR2(20) NOT NULL,
  FEC_AFILIACION DATE NOT NULL,
  ID_SUCURSAL NUMBER NOT NULL
);

-- Estructura de tabla para la tabla ROL -------------------------------------------------------------------------------------

CREATE TABLE ROL (
  ID_ROL NUMBER GENERATED ALWAYS AS IDENTITY,
  TIPO VARCHAR2(20) NOT NULL
);

-- Estructura de tabla para la tabla SUCURSAL --------------------------------------------------------------------------------

CREATE TABLE SUCURSAL (
  ID_SUCURSAL NUMBER GENERATED ALWAYS AS IDENTITY,
  LOCALIZACION VARCHAR2(15) NOT NULL
);

-- Estructura de tabla para la tabla USUARIO -------------------------------------------------------------------------------

CREATE TABLE USUARIO (
  ID_USUARIO NUMBER GENERATED ALWAYS AS IDENTITY,
  NOMBRE VARCHAR2(20) NOT NULL,
  APELLIDO1 VARCHAR2(20) NOT NULL,
  APELLIDO2 VARCHAR2(20) NOT NULL,
  EMAIL VARCHAR2(80) NOT NULL,
  PW VARCHAR2(15) NOT NULL,
  ID_ROL NUMBER NOT NULL
);

COMMIT;

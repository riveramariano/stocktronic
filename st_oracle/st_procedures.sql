---- STORED PROCEDURES PARA CONSEGUIR TODOS ----------------------------------------------------------------------------------         
CREATE OR REPLACE PROCEDURE GET_ALL_USUARIOS (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR SELECT U.*, R.TIPO FROM USUARIO U INNER JOIN ROL R ON U.ID_ROL = R.ID_ROL ORDER BY ID_USUARIO;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 'ERROR AL MOSTRAR LOS USUARIOS', 1);
    COMMIT;
END GET_ALL_USUARIOS;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_ALL_ROLES (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR SELECT * FROM ROL ORDER BY ID_ROL;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL MOSTRAR LOS ROLES DE LA BASE DE DATOS', 1);
    COMMIT;
END GET_ALL_ROLES;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_ALL_PRODUCTOS (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR SELECT * FROM PRODUCTO ORDER BY ID_PRODUCTO;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 'ERROR AL MOSTRAR LOS PRODUCTOS', 1);
    COMMIT;
END;
------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_ALL_PROVEEDORES (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR SELECT * FROM PROVEEDOR ORDER BY ID_PROVEEDOR;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL MOSTRAR LOS PROVEEDORES', 1);
    COMMIT;
END GET_ALL_PROVEEDORES;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_ALL_METODOPAGO (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR SELECT * FROM METODO_PAGO ORDER BY ID_METODOPAGO;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE,
            'ERROR AL MOSTRAR LOS METODOS DE PAGO', 1);
    COMMIT;
END GET_ALL_METODOPAGO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_ALL_ERRORES (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR SELECT H.*, U.NOMBRE FROM H_ERRORES H INNER JOIN USUARIO U ON H.ID_USUARIO = U.ID_USUARIO 
    ORDER BY H.ID_ERRORES;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL MOSTRAR LA INFORMACION DEL HISTORIAL DE ERRORES', 1);
    COMMIT;
END GET_ALL_ERRORES;


------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_ALL_ENTREGAS (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR SELECT H.*, P.NOMBRE, S.CED_JURIDICA FROM H_ENTREGAS H INNER JOIN PRODUCTO P ON H.ID_PRODUCTO = P.ID_PRODUCTO
    INNER JOIN PROVEEDOR S ON P.ID_PROVEEDOR = S.ID_PROVEEDOR ORDER BY H.ID_ENTREGAS;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 'ERROR AL LISTAR LAS ENTREGAS', 1);
    COMMIT;
END GET_ALL_ENTREGAS;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_ALL_CATEGORIAS (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR SELECT * FROM CATEGORIA ORDER BY ID_CATEGORIA;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL MOSTRAR LAS CATEGORIAS DE LOS PRODUCTOS', 1);
    COMMIT;
END GET_ALL_CATEGORIAS;

-- STORED PROCEDURES PARA CONSEGUIR ESPECIFICOS ------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_PRODUCTO (CM OUT SYS_REFCURSOR, NEW_ID IN NUMBER)
AS
BEGIN
    OPEN CM FOR SELECT * FROM PRODUCTO WHERE ID_PRODUCTO = NEW_ID;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE,
            'ERROR AL INTENTAR TRAER EL PRODUCTO PARA MODIFICAR SU INFORMACION', 1);
    COMMIT;
END GET_PRODUCTO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_CATEGORIA (CM OUT SYS_REFCURSOR, NEW_ID IN NUMBER)
AS
BEGIN
    OPEN CM FOR SELECT * FROM CATEGORIA WHERE ID_CATEGORIA = NEW_ID;
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR LA CATEGORIA', 1);
END GET_CATEGORIA;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_PRODUCTS_RANDOM (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR
	SELECT *
    FROM (SELECT * FROM PRODUCTO ORDER BY DBMS_RANDOM.RANDOM)
    WHERE ROWNUM < 7;

EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR 6 PRODUCTOS ALEATORIOS', 1);
    COMMIT;
END GET_PRODUCTS_RANDOM;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_LOWEST_PRICE (CM OUT SYS_REFCURSOR, NEW_ID IN NUMBER)
AS
BEGIN
    OPEN CM FOR SELECT TIPO, MIN(PRECIO) PRECIO FROM PRODUCTO INNER JOIN CATEGORIA 
	ON PRODUCTO.ID_CATEGORIA = CATEGORIA.ID_CATEGORIA WHERE PRODUCTO.ID_CATEGORIA = NEW_ID
	GROUP BY TIPO;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR LOS ARTICULOS DE MENOR PRECIO', 1);
    COMMIT;
END GET_LOWEST_PRICE;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_ORDEN (CM OUT SYS_REFCURSOR)
AS
BEGIN
    OPEN CM FOR SELECT O.*, I.NUM_TARJETA, I.DIR_FACTURACION, I.TOTAL, M.NOMBRE FROM ORDEN O INNER JOIN INFO_PAGO I 
    ON O.ID_INFOPAGO = I.ID_INFOPAGO INNER JOIN METODO_PAGO M ON I.ID_METODOPAGO = M.ID_METODOPAGO
    ORDER BY FEC_ORDEN DESC FETCH  FIRST 1 ROWS ONLY;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR LA ULTIMA ORDEN INSERTADA', 1);
    COMMIT;
END GET_ORDEN;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_PRODUCTOS (CM OUT SYS_REFCURSOR, NEW_ID IN NUMBER)
AS
BEGIN
    OPEN CM FOR SELECT * FROM PRODUCTO WHERE ID_CATEGORIA = NEW_ID;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR TODOS LOS PRODUCTOS SEGUN SU CATEGORIA', 1);
    COMMIT;
END GET_PRODUCTOS;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_USUARIO (CM OUT SYS_REFCURSOR, NEW_ID IN NUMBER)
AS
BEGIN
    OPEN CM FOR SELECT * FROM USUARIO WHERE ID_USUARIO = NEW_ID;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR INFORMACION DEL USUARIO', 1);
    COMMIT;
END GET_USUARIO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE LOGIN (CM OUT SYS_REFCURSOR, NEW_EMAIL IN VARCHAR2, NEW_PW IN VARCHAR2)
AS
BEGIN
    OPEN CM FOR SELECT * FROM USUARIO WHERE EMAIL = NEW_EMAIL AND PW = NEW_PW;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 'ERROR AL INICIAR SESION', 1);
    COMMIT;    
END LOGIN;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_ORDENES (CM OUT SYS_REFCURSOR, NEW_ID IN NUMBER)
AS
BEGIN
    OPEN CM FOR SELECT O.ID_ORDEN, O.FEC_ORDEN, O.MONTO_TOTAL, I.NUM_TARJETA, M.NOMBRE
    FROM ORDEN O INNER JOIN  INFO_PAGO I ON O.ID_INFOPAGO = I.ID_INFOPAGO
    INNER JOIN METODO_PAGO M ON I.ID_METODOPAGO = M.ID_METODOPAGO WHERE O.ID_USUARIO = NEW_ID ORDER BY O.ID_ORDEN;
    
     EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR EL HISTORIAL DE COMPRAS DEL USUARIO', 1);
    COMMIT;
END GET_ORDENES;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_CARRITOS (CM OUT SYS_REFCURSOR, NEW_ID IN NUMBER)
AS
BEGIN
    OPEN CM FOR SELECT C.ID_CARRITO, C.CANTIDAD, C.ID_USUARIO, P.ID_PRODUCTO, P.NOMBRE, P.DESCRIPCION, P.URL_IMAGEN, P.PRECIO
    FROM CARRITO C INNER JOIN PRODUCTO P ON C.ID_PRODUCTO = P.ID_PRODUCTO
    WHERE C.ID_USUARIO = NEW_ID ORDER BY C.ID_CARRITO;  
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR MOSTRAR LOS ARTICULOS DENTRO DEL CARRITO DEL USUARIO', 1);
    COMMIT;
END GET_CARRITOS;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_CARRITO_COUNT (CM OUT SYS_REFCURSOR, NEW_ID IN NUMBER)
AS
BEGIN
    OPEN CM FOR SELECT COUNT(*) FROM CARRITO C WHERE C.ID_USUARIO = NEW_ID;  
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR LA CANTIDAD DE ARTICULOS DENTRO DEL CARRITO', 1);
    COMMIT;
END GET_CARRITO_COUNT;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE GET_DETALLE_ORDENES (CM OUT SYS_REFCURSOR, NEW_ID IN NUMBER)
AS
BEGIN
    OPEN CM FOR SELECT D.ID_DETALLEORDEN, D.PRECIO, D.CANTIDAD, D.URL_IMAGEN, P.NOMBRE
    FROM DETALLE_ORDEN D INNER JOIN PRODUCTO P ON D.ID_PRODUCTO = P.ID_PRODUCTO WHERE D.ID_ORDEN = NEW_ID;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR MOSTRAR MOSTRAR EL DETALLE DE LA ORDEN', 1);
    COMMIT;
END GET_DETALLE_ORDENES;

-- STORED PROCEDURES PARA INSERTAR --------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE INSERT_CARRITO (
       NEW_CANTIDAD IN CARRITO.CANTIDAD%TYPE,
       NEW_ID_USUARIO IN CARRITO.ID_USUARIO%TYPE,
       NEW_ID_PRODUCTO IN CARRITO.ID_PRODUCTO%TYPE)
IS
BEGIN
    INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) 
    VALUES (NEW_CANTIDAD, NEW_ID_USUARIO, NEW_ID_PRODUCTO);
  
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INSERTAR EL PRODUCTO DESEADO', 1);
    COMMIT;  
END INSERT_CARRITO;


------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE INSERT_INFOPAGO (
       NEW_NUM_TARJETA IN INFO_PAGO.NUM_TARJETA%TYPE,
       NEW_DIR_FACTURACION IN INFO_PAGO.DIR_FACTURACION%TYPE,
       NEW_DIR_FACTURACION2 IN INFO_PAGO.DIR_FACTURACION2%TYPE,
       NEW_TELEFONO IN INFO_PAGO.TELEFONO%TYPE,
       NEW_TOTAL IN INFO_PAGO.TOTAL%TYPE,
       NEW_ID_USUARIO IN INFO_PAGO.ID_USUARIO%TYPE,
       NEW_ID_METODOPAGO IN INFO_PAGO.ID_METODOPAGO%TYPE)
IS
BEGIN
    INSERT INTO INFO_PAGO (NUM_TARJETA, DIR_FACTURACION, DIR_FACTURACION2, TELEFONO, TOTAL, ID_USUARIO, ID_METODOPAGO) 
    VALUES (NEW_NUM_TARJETA, NEW_DIR_FACTURACION, NEW_DIR_FACTURACION2, NEW_TELEFONO, NEW_TOTAL, NEW_ID_USUARIO, 
    NEW_ID_METODOPAGO);
  
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INSERTAR LA INFORMACION DE LA COMPRA', 1);
    COMMIT;
END INSERT_INFOPAGO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE INSERT_PRODUCTO(
       NEW_NOMBRE IN PRODUCTO.NOMBRE%TYPE,
       NEW_DESCRIPCION IN PRODUCTO.DESCRIPCION%TYPE,
       NEW_URL_IMAGEN IN PRODUCTO.URL_IMAGEN%TYPE,
       NEW_PRECIO IN PRODUCTO.PRECIO%TYPE,
       NEW_CANTIDAD IN PRODUCTO.CANTIDAD%TYPE,
       NEW_ID_PROVEEDOR IN PRODUCTO.ID_PROVEEDOR%TYPE,
       NEW_ID_CATEGORIA IN PRODUCTO.ID_CATEGORIA%TYPE)
IS
BEGIN
    INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) 
    VALUES (NEW_NOMBRE, NEW_DESCRIPCION, NEW_URL_IMAGEN, NEW_PRECIO, NEW_CANTIDAD, NEW_ID_PROVEEDOR, NEW_ID_CATEGORIA);
  
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 'ERROR AL INSERTAR EL PRODUCTO', 1);
    COMMIT;
END INSERT_PRODUCTO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE INSERT_USUARIO (
       NEW_NOMBRE IN USUARIO.NOMBRE%TYPE,
       NEW_APELLIDO1 IN USUARIO.APELLIDO1%TYPE,
       NEW_APELLIDO2 IN USUARIO.APELLIDO2%TYPE,
       NEW_EMAIL IN USUARIO.EMAIL%TYPE,
       NEW_PW IN USUARIO.PW%TYPE,
       NEW_ID_ROL IN USUARIO.ID_ROL%TYPE)
IS
BEGIN
  INSERT INTO USUARIO (NOMBRE, APELLIDO1, APELLIDO2, EMAIL, PW, ID_ROL) 
  VALUES (NEW_NOMBRE, NEW_APELLIDO1, NEW_APELLIDO2, NEW_EMAIL, NEW_PW, NEW_ID_ROL);
  
  EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 'ERROR AL EL USUARIO', 1);
  COMMIT;
END INSERT_USUARIO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE REGISTRO (
       NEW_NOMBRE IN USUARIO.NOMBRE%TYPE,
       NEW_APELLIDO1 IN USUARIO.APELLIDO1%TYPE,
       NEW_APELLIDO2 IN USUARIO.APELLIDO2%TYPE,
       NEW_EMAIL IN USUARIO.EMAIL%TYPE,
       NEW_PW IN USUARIO.PW%TYPE )
IS
BEGIN
    INSERT INTO USUARIO (NOMBRE, APELLIDO1, APELLIDO2, EMAIL, PW, ID_ROL) 
    VALUES (NEW_NOMBRE, NEW_APELLIDO1, NEW_APELLIDO2, NEW_EMAIL, NEW_PW, 3);
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 'ERROR AL REGISTRARSE', 1);
    COMMIT;
END REGISTRO;


-- STORE PROCEDURES PARA ACTUALIZAR --------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE UPDATE_CARRITO (NEW_ID IN NUMBER, NEW_CANTIDAD IN NUMBER)
AS
BEGIN
    UPDATE  CARRITO
    SET     CANTIDAD = CANTIDAD + NEW_CANTIDAD
    WHERE   ID_CARRITO = NEW_ID;
    COMMIT;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR ACTUALIZAR LA CANTIDAD DE PRODUCTOS DEL CARRITO', 1);
    COMMIT;
END UPDATE_CARRITO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE UPDATE_PRODUCTO (NEW_ID IN NUMBER, NEW_NOMBRE IN VARCHAR2, NEW_DESCRIPCION IN VARCHAR2, 
NEW_URL_IMAGE IN VARCHAR2, NEW_PRECIO IN NUMBER, NEW_CANTIDAD IN NUMBER, NEW_ID_PROVEEDOR IN NUMBER, NEW_ID_CATEGORIA IN NUMBER)
AS
BEGIN
    UPDATE  PRODUCTO
    SET     NOMBRE = NEW_NOMBRE,
            DESCRIPCION = NEW_DESCRIPCION,
            URL_IMAGEN = NEW_URL_IMAGE,
            PRECIO = NEW_PRECIO,
            CANTIDAD = NEW_CANTIDAD,
            ID_PROVEEDOR = NEW_ID_PROVEEDOR,
            ID_CATEGORIA = NEW_ID_CATEGORIA
    WHERE   ID_PRODUCTO = NEW_ID;
    COMMIT;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR ACTUALIZAR LA INFORMACION DEL PRODUCTO SELECCIONADO', 1);
    COMMIT;
END UPDATE_PRODUCTO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE UPDATE_USUARIO (NEW_ID IN NUMBER, NEW_NOMBRE IN VARCHAR2, NEW_APELLIDO1 IN VARCHAR2, 
NEW_APELLIDO2 IN VARCHAR2, NEW_EMAIL IN VARCHAR2, NEW_PW IN VARCHAR2, NEW_ID_ROL IN NUMBER)
AS
BEGIN
    UPDATE USUARIO
    SET    NOMBRE = NEW_NOMBRE,
           APELLIDO1 = NEW_APELLIDO1,
           APELLIDO2 = NEW_APELLIDO2,
           EMAIL = NEW_EMAIL,
           PW = NEW_PW,
           ID_ROL = NEW_ID_ROL
    WHERE  ID_USUARIO = NEW_ID;
    COMMIT;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR ACTUALIZAR LA INFORMACION DEL USUARIO SELECCIONADO', 1);
    COMMIT;
END UPDATE_USUARIO;

-- DELETE STORED PROCEDURES --------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE DELETE_CARRITO (NEW_ID IN NUMBER)
AS
BEGIN
    DELETE CARRITO WHERE ID_CARRITO = NEW_ID;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR ELIMINAR UN PRODUCTO DENTRO DEL CARRITO DE COMPRAS', 1);
    COMMIT;
END DELETE_CARRITO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE DELETE_PRODUCTO (NEW_ID IN NUMBER)
AS
BEGIN
    DELETE H_ENTREGAS WHERE ID_PRODUCTO = NEW_ID;
    DELETE PRODUCTO WHERE ID_PRODUCTO = NEW_ID;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR ELIMINAR EL PRODUCTO DE LA BASE DE DATOS', 1);
    COMMIT;
END DELETE_PRODUCTO;

------------------------------------------------------------------------------------------------------------------------
CREATE OR REPLACE PROCEDURE DELETE_USUARIO (NEW_ID IN NUMBER)
AS
BEGIN
    DELETE USUARIO WHERE ID_USUARIO = NEW_ID;
    COMMIT;
    
    EXCEPTION
		WHEN OTHERS THEN
			INSERT INTO H_ERRORES(FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES (SYSDATE, 
            'ERROR AL INTENTAR ELIMINAR EL USUARIO DE LA BASE DE DATOS', 1);
    COMMIT; 
END DELETE_USUARIO;

-- COMMITS ALL STORED PROCEDURES         
COMMIT;                
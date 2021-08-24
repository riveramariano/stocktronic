ALTER SESSION SET NLS_DATE_FORMAT = 'MM/DD/YY';

-- CATEGORIA -----------------------------------------------------------------------------------------------------------------
INSERT INTO CATEGORIA (TIPO) VALUES ('Componente');
INSERT INTO CATEGORIA (TIPO) VALUES ('Herramienta');
INSERT INTO CATEGORIA (TIPO) VALUES ('Impresora 3D');
INSERT INTO CATEGORIA (TIPO) VALUES ('Laser Cutter');
INSERT INTO CATEGORIA (TIPO) VALUES ('Raspberry Pi');
INSERT INTO CATEGORIA (TIPO) VALUES ('Wireless');

-- METODOS DE PAGO -----------------------------------------------------------------------------------------------------------
INSERT INTO METODO_PAGO (NOMBRE) VALUES ('Visa');
INSERT INTO METODO_PAGO (NOMBRE) VALUES ('Mastercard');
INSERT INTO METODO_PAGO (NOMBRE) VALUES ('Banco Nacional');
INSERT INTO METODO_PAGO (NOMBRE) VALUES ('Banco Popular');

-- SUCURSALES ----------------------------------------------------------------------------------------------------------------
INSERT INTO SUCURSAL (LOCALIZACION) VALUES ('San José');
INSERT INTO SUCURSAL (LOCALIZACION) VALUES ('Alajuela');
INSERT INTO SUCURSAL (LOCALIZACION) VALUES ('Cartago');
INSERT INTO SUCURSAL (LOCALIZACION) VALUES ('Heredia');
INSERT INTO SUCURSAL (LOCALIZACION) VALUES ('Limón');
INSERT INTO SUCURSAL (LOCALIZACION) VALUES ('Puntarenas');
INSERT INTO SUCURSAL (LOCALIZACION) VALUES ('Guanacaste');

-- PROVEEDORES ---------------------------------------------------------------------------------------------------------------
INSERT INTO PROVEEDOR (NOMBRE, CED_JURIDICA, FEC_AFILIACION, ID_SUCURSAL)
VALUES ('BrothersCR', '1-1023-40010', '6/24/21', 1);
INSERT INTO PROVEEDOR (NOMBRE, CED_JURIDICA, FEC_AFILIACION, ID_SUCURSAL) 
VALUES ('Electrónica ACH', '2-2044-67889', '6/25/21', 2);
INSERT INTO PROVEEDOR (NOMBRE, CED_JURIDICA, FEC_AFILIACION, ID_SUCURSAL) 
VALUES ('Steren', '3-9678-24352', '6/26/21', 3);
INSERT INTO PROVEEDOR (NOMBRE, CED_JURIDICA, FEC_AFILIACION, ID_SUCURSAL) 
VALUES ('CELECT CR', '4-4567-66756', '6/27/21', 4);
INSERT INTO PROVEEDOR (NOMBRE, CED_JURIDICA, FEC_AFILIACION, ID_SUCURSAL) 
VALUES ('Electrónica Technihogar', '5-4522-06066', '6/28/21', 5);
INSERT INTO PROVEEDOR (NOMBRE, CED_JURIDICA, FEC_AFILIACION, ID_SUCURSAL) 
VALUES ('Variadores S.A.', '6-6578-67899', '6/29/21', 6);
INSERT INTO PROVEEDOR (NOMBRE, CED_JURIDICA, FEC_AFILIACION, ID_SUCURSAL)
VALUES ('Electrónica XXI', '7-2345-23452', '6/30/21', 7);

-- PRODUCTOS -----------------------------------------------------------------------------------------------------------------
SET DEFINE OFF;
-- COMPONENTES
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Transistor', 'Funciona para manejar el flujo de la corriente eléctrica', 
'https://drive.google.com/uc?export=view&id=1MVrqT5dkuH5gtRpqGJzRjAEDSWd8R31k',2000, 100, 4, 1);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Botón Azul', 'Botón funcional para circuitos eléctricos', 
'https://drive.google.com/uc?export=view&id=1QtshR0mmxWl8_1gygRFOe9-eb_g2LrYP',2500, 30, 1, 1);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Condensador', 'Mini fuente de energía eléctrica reutilizable', 
'https://drive.google.com/uc?export=view&id=1YO8EoI8E9wG10f8Arm2paKJXW1aMYnan',1500, 40, 2, 1);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Pantalla 8 Bits', 'Útil para imprimir mensajes simples de 8 bits',
'https://drive.google.com/uc?export=view&id=1fViGgcnlJd4Pu33J77uLXXtrL11bYjGI',3000, 20, 3, 1);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Regulador de Voltaje', 'Convertidor de voltaje portátil', 
'https://drive.google.com/uc?export=view&id=1jH_7IFMompvuWfL72VBceiXCDRVYFDj3',4000, 15, 7, 1);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('USB Negro', 'USB con lector para tarjetas SD', 
'https://drive.google.com/uc?export=view&id=1jUGKCWM-UKURZyFcemjGM2L4f4S3jO9Y',7000, 18, 6, 1);

-- HERRAMIENTAS
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Lampará de Cabeza', 'Útil para la eficiencia de iluminación', 
'https://drive.google.com/uc?export=view&id=1CFEb8Ay-0zftCBySvn-Q_MW5OFuMLYXN',10000, 50, 4, 2);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Kit Desatornilladores', 'Kit de 15 desatornilladores de diferentes tamaños', 
'https://drive.google.com/uc?export=view&id=1QpUhQ7s2F5Ive76TgxxeGlfscorwnT4Y',40000, 45, 1, 2);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Tester', 'Indispensable para cualquier especialista eléctrico', 
'https://drive.google.com/uc?export=view&id=1cmi7WkW-1yfsfTNvdLf6Li0l4hrUZhLx',15000, 40, 2, 2);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Kit Llaves', 'Kit de 20 llaves de diferentes tamaños', 
'https://drive.google.com/uc?export=view&id=1h91zm1llG7N8V2xiBZJ0JItK62bAgw18',50000, 50, 3, 2);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Pinzas', 'Pinzas de 30mm para cualquier situación', 
'https://drive.google.com/uc?export=view&id=1omiORo5BnjNU0roromNC9zw7JglJusrv',8000, 15, 7, 2);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Soldador de Estaño', 'Soldador de metales portable', 
'https://drive.google.com/uc?export=view&id=1uuBCqN-7_phtsXQ-6Nj_T4ykQwk8kftH',13000, 18, 6, 2);

-- IMPRESORAS
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Wood ST', 'Impresora 3D hecha de madera con materiales reutilizables', 
'https://drive.google.com/uc?export=view&id=16BUWLsdXVUI7SMQTgvvbYbiJOyFOVkSG',30000, 26, 1, 3);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('White Pro', 'Impresora 3D blanca respuestos incluidos', 
'https://drive.google.com/uc?export=view&id=1P5c-Gh4xkeawRHPKV1ylxxQfl1Dkh512',50000, 40, 2, 3);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Black Pro', 'Impresora 3D hecha para grandes empresas', 
'https://drive.google.com/uc?export=view&id=1cxp42GulmyJkJWRhc_A_NLQDNg5KVJFE',100000, 90, 2, 3);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Taz Z', 'Impresora 3D de alta disponibilidad', 
'https://drive.google.com/uc?export=view&id=1j4wgC9N3tpCNiqxWtpT5k_69EffnGEkU',90000, 80, 6, 3);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Blanca Min', 'Impresora 3D pequeña para uso personal', 
'https://drive.google.com/uc?export=view&id=1s9XcUD1Ad8MIwsXqS5uTColbBS_CbOAq',50000, 30, 6, 3);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Fused Form', 'Impresora 3D con materiables de calidad', 
'https://drive.google.com/uc?export=view&id=1tSI40qna0VCwl2jlLZPsYkJYDF_hkBqY',70000, 15, 5, 3);

-- LASER CUTTERS
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Emblaser 2', 'Cortador láser simpre confiable y útil', 
'https://drive.google.com/uc?export=view&id=1Wt53XidBiQf18tJ-THdTDJMn7cZMYT1U',30000, 26, 3, 4);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('ACCTEK', 'Cortador láser de alta disponibilidad', 
'https://drive.google.com/uc?export=view&id=1_kw4DuWx5sH3urifqX1rZuycgVaJHwkE',50000, 40, 3, 4);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Lotus', 'Cortador láser creado con materiales ecológicos', 
'https://drive.google.com/uc?export=view&id=1hgwL27wa9MN_B7qz81vwW5f4Z9EwYUDb',100000, 90, 7, 4);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Muse', 'Cortador láser personal negro', 
'https://drive.google.com/uc?export=view&id=1k708A1EHtefbUx6Yw2TVagy8cPFZCQIf',90000, 80, 6, 4);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('BuyCNC', 'Cortador láser industrial', 
'https://drive.google.com/uc?export=view&id=1lTLkFsbBT5AsP9r72IsJq-2De45v5pzK',50000, 30, 1, 4);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Red Tech', 'Cortador láser rojo de última tecnología', 
'https://drive.google.com/uc?export=view&id=1sN6K-_uRmwQwr25T5lSZhompB3muBGMw',70000, 15, 1, 4);

-- RASPBERRY PI
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Model B V.4', 'Raspeberry serie B cuarto modelo', 
'https://drive.google.com/uc?export=view&id=11E9KkYdEGw52ikXWTHJu48jGRv0M4ETt',20000, 26, 2, 5);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Navio2', 'Raspeberry creada con la última tecnología', 
'https://drive.google.com/uc?export=view&id=1OWXqcSTPAnlJYnMSYqq421Y8aKNoMUUC',25000, 40, 2, 5);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES  
('Model A V.4', 'Raspeberry serie A cuarto modelo', 
'https://drive.google.com/uc?export=view&id=1SyOgERhwZiiS-kfiKNgdnuO76ESLWchT',27000, 90, 1, 5);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('JustBoom', 'Raspeberry roja con materiales de calidad', 
'https://drive.google.com/uc?export=view&id=1_baQ5YBTOiNlKErO4JJhVHqjp98Lls7V',23000, 80, 5, 5);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Design Park', 'Raspeberry azul de alta eficiencia', 
'https://drive.google.com/uc?export=view&id=1j_rrkjInbTxU1p3R1_yinNODqV6aSlYR',22000, 30, 5, 5);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Model A V.7', 'Raspeberry serie A último modelo', 
'https://drive.google.com/uc?export=view&id=1su97xkMFJQcQ6Ou2lUyw9VkcPqOMRlx8',30000, 15, 1, 5);

-- WIRELESS
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Audífonos Negros', 'Audífonos de cuello cargables', 
'https://drive.google.com/uc?export=view&id=10rfRxX8ZqerwLbLlZuCYSLW1mAfnLa-k',9000, 26, 2, 6);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Amazon Alexa', 'Dispositivo de reconocimiento de voz', 
'https://drive.google.com/uc?export=view&id=16iIVixE-Q5d70OiXjVOhtE0GNLQtaXlK',30000, 48, 2, 6);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('ColorBulb', 'Bombillo multicolor programable', 
'https://drive.google.com/uc?export=view&id=1JIlyUa3o9v2NnyIbubTQv1bKf-1le7y1',5000, 92, 3, 6);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Headset GP39', 'Headset gamer negro con azul', 
'https://drive.google.com/uc?export=view&id=1RbxSj9FJ7P_Hx5vsZAkTsnCmjAhZamd3',23000, 84, 1, 6);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Set Teclado Mouse', 'Teclado y mouse wireless', 
'https://drive.google.com/uc?export=view&id=1_E3wZXWhGZrslhhOPPKRU_ZGCKz9Cibi',20000, 35, 1, 6);
INSERT INTO PRODUCTO (NOMBRE, DESCRIPCION, URL_IMAGEN, PRECIO, CANTIDAD, ID_PROVEEDOR, ID_CATEGORIA) VALUES 
('Enchufe Inteligente', 'Enfuche programable', 
'https://drive.google.com/uc?export=view&id=1zF9r5g_EHNgXnCga-qjdtOZ0GwTn2d9o',10000, 50, 7, 6);

SET DEFINE ON;

-- ROLES ---------------------------------------------------------------------------------------------------------------------
INSERT INTO ROL (TIPO) VALUES ('Administrador');
INSERT INTO ROL (TIPO) VALUES ('Empleado');
INSERT INTO ROL (TIPO) VALUES ('Cliente');

-- USUARIOS ------------------------------------------------------------------------------------------------------------------
INSERT INTO USUARIO (NOMBRE, APELLIDO1, APELLIDO2, EMAIL, PW, ID_ROL)
VALUES ('Admin', 'Ad', 'Min', 'admin@admin.com', '123', 1);
INSERT INTO USUARIO (NOMBRE, APELLIDO1, APELLIDO2, EMAIL, PW, ID_ROL) 
VALUES ('Empleado', 'Em', 'Pleado', 'empleado@empleado.com', '123', 2);
INSERT INTO USUARIO (NOMBRE, APELLIDO1, APELLIDO2, EMAIL, PW, ID_ROL) 
VALUES ('Cliente', 'Cli', 'Ente', 'cliente@cliente.com', '123', 3);

-- CARRITO -------------------------------------------------------------------------------------------------------------------
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (1, 1, 15);
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (1, 1, 18);
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (1, 1, 16);
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (1, 1, 19);

INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (1, 2, 4);
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (2, 2, 8);
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (3, 2, 12);
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (4, 2, 16);

INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (1, 3, 7);
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (2, 3, 14);
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (3, 3, 21);
INSERT INTO CARRITO (CANTIDAD, ID_USUARIO, ID_PRODUCTO) VALUES (4, 3, 35);

-- H_ERRORES -----------------------------------------------------------------------------------------------------------------
INSERT INTO H_ERRORES (FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES ('6/27/21', 'Error insertando un producto', 1);
INSERT INTO H_ERRORES (FEC_ERROR, DESCRIPCION, ID_USUARIO) VALUES ('6/27/21', 'Error eliminando un producto del carrito', 3);

COMMIT;

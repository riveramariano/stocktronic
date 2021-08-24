ALTER SESSION SET NLS_LANGUAGE=American;
ALTER SESSION SET NLS_TERRITORY=America;

ALTER SESSION SET "_ORACLE_SCRIPT" = TRUE;
CREATE USER st identified by st;
GRANT CONNECT,DBA, RESOURCE TO st;
ALTER USER st QUOTA UNLIMITED  ON USERS;
CONN st/st;

-- CREACION DE TABLAS --------------------------------------------------------------------------------------------------------

@@st_cre

-- CREACION DE LLAVES --------------------------------------------------------------------------------------------------------

@@st_keys

-- CREACION DE PROCEDIMIENTOS ALMACENADOS ------------------------------------------------------------------------------------

@@st_procedures

-- CREACION DE DISPARADORES --------------------------------------------------------------------------------------------------

@@st_triggers

-- LLENADO DE LAS TABLAS -----------------------------------------------------------------------------------------------------

@@st_popul

COMMIT;




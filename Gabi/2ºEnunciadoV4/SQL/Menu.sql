-- Logs de queries externas.
show variables like '%general%';
SELECT * FROM mysql.general_log_file;
SET global general_log_file='./GIGACHADPC.log';
SET global general_log = ON;
-- Log de errores.
show variables like '%datadir%';
SET global log_error='C:/Users/Gabriel/Desktop/mysql_error.log';

CREATE TABLE menu (
    idMenu INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(30),
    idPadre INT,
    privado BOOLEAN,
    orden INT,
    accion VARCHAR(255)
);

VALUES ('Home', NULL, FALSE, 1, ''),
       ('Link', NULL, FALSE, 2, ''),
       ("CRUD's", NULL, TRUE, 3, ''),
       ('Usuarios', 3, TRUE, 4, ''),
       ('Pedidos', 3, TRUE, 5, '');
       
SELECT * FROM menu ORDER BY orden;

SELECT * FROM usuarios WHERE nombre = "Rol";

-- -- PERMISOS_USUARIOS -- --
INSERT INTO permisos_usuarios VALUES (1,498);
SELECT * FROM permisos_usuarios;
DELETE FROM permisos_usuarios WHERE idPermiso=89;

-- -- -- PERMISOS -- -- --
INSERT INTO `di23`.`permisos` (idPermiso, permiso) VALUES (1,'Gestionar Usuarios');
INSERT INTO `di23`.`permisos` (idPermiso, permiso) VALUES (2,'Gestionar Pedidos');
SELECT * FROM permisos;
DELETE FROM permisos WHERE idPermiso=4;

-- -- PERMISOS_ROLES -- --
INSERT INTO permisos_roles VALUES (2,2);
SELECT * FROM permisos_roles;
DELETE FROM permisos_roles WHERE idRol=2;

-- -- -- ROLES -- -- --
INSERT INTO `di23`.`roles` (`rol`) VALUES ('Gestor CRUDs');
SELECT * FROM roles;

-- -- ROLES_USUARIOS -- --
INSERT INTO roles_usuarios (idRol, id_Usuario) VALUES (1,498);
DELETE FROM roles_usuarios WHERE id_Usuario = 498;
SELECT * FROM roles_usuarios;

-- -- PERMISOS_MENÚS -- --
INSERT INTO permisos_menu VALUES (1,3);
INSERT INTO permisos_menu VALUES (1,4);
INSERT INTO permisos_menu VALUES (2,3);
INSERT INTO permisos_menu VALUES (2,5);
INSERT INTO permisos_menu VALUES (5,6);
INSERT INTO permisos_menu VALUES (2,7);
SELECT * FROM permisos_menu;

-- -- MENÚS -- --
SELECT * FROM menu order by orden;
UPDATE menu SET orden=orden+1 WHERE orden>=2;
-- -- ACCESO DE USUARIOS A MENÚS -- --
SELECT id_Usuario FROM usuarios where login = "gest_cruds";
SELECT * FROM usuarios;

SELECT * FROM menu WHERE privado = 0;

-- Sentencia parao obtener los permisos de un usuario.
SELECT P.idPermiso, P.permiso
FROM usuarios U, permisos_usuarios PU, permisos P, roles R, permisos_roles PR, roles_usuarios RU
WHERE (U.login = "gest_cruds"
		AND U.id_Usuario = RU.id_Usuario
		AND RU.idRol = R.idRol
		AND R.idRol = PR.idRol
        AND PR.idPermiso = P.idPermiso)
	OR (U.login = "gest_cruds"
		AND U.id_Usuario = PU.id_Usuario
		AND PU.idPermiso = P.idPermiso)
GROUP BY P.idPermiso
ORDER BY P.idPermiso;

-- Consulta para cargar el menú según los permisos y roles del usuario.
SELECT M.idMenu, M.titulo, M.idPadre, M.privado, M.orden, M.accion
FROM usuarios U, permisos_usuarios PU, permisos P, menu M, permisos_menu PM, roles R, permisos_roles PR, roles_usuarios RU
WHERE (U.login = "gest_cruds"
		AND U.id_Usuario = RU.id_Usuario
		AND RU.idRol = R.idRol
		AND R.idRol = PR.idRol
        AND PR.idPermiso = P.idPermiso
        AND P.idPermiso = PM.idPermiso
        AND PM.idMenu = M.idMenu)
	OR (U.login = "gest_cruds"
		AND U.id_Usuario = PU.id_Usuario
		AND PU.idPermiso = P.idPermiso
		AND P.idPermiso = PM.idPermiso
        AND PM.idMenu = M.idMenu)
	OR M.privado = 0
GROUP BY M.idMenu
ORDER BY M.orden;





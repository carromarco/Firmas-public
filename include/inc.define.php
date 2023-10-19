<?php 

$user = 'bnUw';
$pass = 'YzBudQ==';

$usuario = base64_decode($user);
$clave = base64_decode($pass);

# Nombre de la base de datos a la cual me conecto

$db10 = "PM10PROD";

# Error de conexion a oracle

$msg_error01 = "ORA-01017: Nombre de usuario/contraseña no válidos. Conexión denegada.";

# Tabla de datos de contratistas de Prowatch

$ra2_V550 = "ra2.V550_cred_contrat_pw";

$meta4 = "META4.M4VH_VPERSONAL";


?>
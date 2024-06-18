<?php
// Supongamos que esta es la contraseña que ingresó el usuario
$inputPassword = 'Biblioteca2023#';

// Este es el hash almacenado en tu base de datos
$storedHash = '$2y$10$IHdu2/83qR8G183lR4yw9O71Bv05M3jCyd39k8KxtsjJVElkb7nZO';

// Verificar si la contraseña ingresada coincide con el hash almacenado
if (password_verify($inputPassword, $storedHash)) {
    echo "La contraseña es correcta.";
} else {
    echo "La contraseña es incorrecta.";
}
// Supongamos que esta es la nueva contraseña que deseas encriptar
$newPassword = 'Bibunimo2024';

// Generar el hash de la contraseña utilizando bcrypt
$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

// Mostrar el hash generado
echo "Contraseña encriptada: " . $hashedPassword;

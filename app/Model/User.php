<?php

require_once __DIR__ . '/../../config/database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = getConnection();
    }

    // Método para guardar un nuevo usuario
    public function save($data)
    {
        try {
            $query = "INSERT INTO usuarios 
                      (nombres, apellidos, tipo_documento, numero_cedula, ciudad, direccion, correo, celular, imagen_persona, imagen_cedula_frontal, imagen_cedula_posterior, fecha_creacion) 
                      VALUES 
                      (:nombres, :apellidos, :tipo_documento, :numero_cedula, :ciudad, :direccion, :correo, :celular, :imagen_persona, :imagen_cedula_frontal, :imagen_cedula_posterior, NOW())";

            $stmt = $this->conn->prepare($query);

            // Guardar las imágenes (base64 o archivos)
            $data['imagen_persona'] = $this->saveImage($data['imagen_persona'] ?? $_FILES['foto_persona'], 'persona');
            $data['imagen_cedula_frontal'] = $this->saveImage($data['imagen_cedula_frontal'] ?? $_FILES['cedula_frontal'], 'cedula_frontal');
            $data['imagen_cedula_posterior'] = $this->saveImage($data['imagen_cedula_posterior'] ?? $_FILES['cedula_posterior'], 'cedula_posterior');

            // Asignar valores a los parámetros
            $stmt->bindParam(':nombres', $data['nombres']);
            $stmt->bindParam(':apellidos', $data['apellidos']);
            $stmt->bindParam(':tipo_documento', $data['tipo_documento']);
            $stmt->bindParam(':numero_cedula', $data['numero_cedula']);
            $stmt->bindParam(':ciudad', $data['ciudad']);
            $stmt->bindParam(':direccion', $data['direccion']);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':celular', $data['celular']);
            $stmt->bindParam(':imagen_persona', $data['imagen_persona']);
            $stmt->bindParam(':imagen_cedula_frontal', $data['imagen_cedula_frontal']);
            $stmt->bindParam(':imagen_cedula_posterior', $data['imagen_cedula_posterior']);

            return $stmt->execute();
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                throw new Exception("El correo o número de cédula ya está registrado.");
            } else {
                throw $e;
            }
        }
    }

    // Método para guardar una imagen base64 o archivo subido
    private function saveImage($image, $prefix)
    {
        // Verificar si es una cadena base64
        if (is_string($image) && preg_match('#^data:image/\w+;base64,#i', $image)) {
            // Procesar imagen base64
            $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $image);
            $decodedImage = base64_decode($imageData);
    
            if ($decodedImage === false) {
                throw new Exception("Error al decodificar la imagen base64.");
            }
    
            // Crear un nombre único para la imagen
            $imageName = $prefix . '_' . uniqid() . '.png';
    
            // Ruta para guardar la imagen
            $imagePath = __DIR__ . '/../../public/uploads/' . $imageName;
    
            // Asegurarse de que la carpeta de destino exista
            if (!file_exists(__DIR__ . '/../../public/uploads')) {
                mkdir(__DIR__ . '/../../public/uploads', 0777, true);
            }
    
            // Guardar la imagen en el servidor
            if (!file_put_contents($imagePath, $decodedImage)) {
                throw new Exception("Error al guardar la imagen en el servidor.");
            }
    
            return 'public/uploads/' . $imageName;
        }
    
        // Verificar si es un archivo subido
        if (is_array($image) && isset($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
            $imageName = $prefix . '_' . uniqid() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
            $imagePath = __DIR__ . '/../../public/uploads/' . $imageName;
    
            if (!file_exists(__DIR__ . '/../../public/uploads')) {
                mkdir(__DIR__ . '/../../public/uploads', 0777, true);
            }
    
            if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
                throw new Exception("Error al guardar el archivo subido en el servidor.");
            }
    
            return 'public/uploads/' . $imageName;
        }
    
        // Si no es ni base64 ni archivo válido
        return null;
    }
    

    // Método para verificar si un correo está registrado
    public function isEmailRegistered($email)
    {
        $query = "SELECT COUNT(*) AS count FROM usuarios WHERE correo = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result['count'] > 0; // Devuelve true si el correo está registrado
    }
}

-- Insertar un usuario en la tabla users
INSERT INTO users (name, email, password)
VALUES ('John Doe', 'john@example.com', '$2y$12$x68bziVE1uIi1P6U6uTY4OKSo/dMFoSQbIe6KiBSMHibcLQ1Rh95O');
INSERT INTO users (name, email, password)
VALUES ('Jony', 'johny@example.com', '$2y$12$x68bziVE1uIi1P6U6uTY4OKSo/dMFoSQbIe6KiBSMHibcLQ1Rh95O');
-- los Passw son password

-- Insertar un registro en la tabla charging_points con created_by = 1
INSERT INTO charging_points (name, address, latitude, longitude, type, power, created_by, status)
VALUES ('Punto de recarga 1', 'Calle 1, 2, 3', 40.4167, -3.7033, 'coche', 22, 1, 'proposed');

-- Insertar datos en la tabla charging_points
INSERT INTO charging_points (name, address, latitude, longitude, type, power, created_by, status)
VALUES
    ('Punto de recarga 1', 'Calle 1, 2, 3', 40.4167, -3.7033, 'coche', 22, 1, 'proposed'),
    ('Punto de recarga 2', 'Calle 2, 4, 5', 40.4167, -3.7033, 'mobil', 11, 2, 'proposed'),
    ('Punto de recarga 3', 'Calle 3, 6, 7', 40.4167, -3.7033, 'coche', 33, 3, 'proposed');

-- Insertar datos en la tabla proposals
INSERT INTO proposals (user_id, charging_point_id, evidence)
VALUES
    (1, 1, 'Imagen de la propuesta 1'),
    (2, 2, 'Imagen de la propuesta 2'),
    (3, 3, 'Imagen de la propuesta 3');

-- Insertar datos en la tabla ratings
INSERT INTO ratings (user_id, charging_point_id, rating, review)
VALUES
    (1, 1, 4, 'Buena experiencia'),
    (2, 2, 3, 'Regular'),
    (3, 3, 5, 'Excelente servicio');
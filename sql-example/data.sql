
INSERT INTO `category` (`id_category`, `name`, `description`) VALUES
(1, 'Articles', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation '),
(2, 'Anniversaires', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation '),
(3, 'Compétition', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation '),
(4, 'Evènements', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ');


INSERT INTO `city` (`id_city`, `name_city`, `zip_code`) VALUES
(1, 'caen', '14000'),
(2, '\r\nhérouville-Saint-Clair\r\n', '14200'),
(3, '\r\nmondeville\r\n', '14120');
INSERT INTO `adresses` (`id_adresses`, `name_adresse`, `id_city`) VALUES
(1, '4 Bd du Grand Parc', 2),
(2, 'Les Carandes', 3);
INSERT INTO `gym` (`id_gym`, `name_gym`, `capacity`, `id_adresses`) VALUES
(1, 'La salle escalade aventure', 20, 1),
(2, 'La salle escalade aventure 2', 15, 2);

INSERT INTO `role_admin` (`id_role_admin`, `role`) VALUES
(2, 'admin'),
(0, 'client'),
(1, 'editor');
INSERT INTO `vacation` (`id_vacation`, `date_start_vacation`, `date_end_vacation`, `id_gym`) VALUES
(1, '2024-07-14 12:12:12', '2024-07-15 12:12:12', 1),
(2, '2024-07-14 12:12:12', '2024-07-15 12:12:12', 2),
(3, '2024-08-15 12:12:12', '2024-08-16 12:12:12', 1),
(4, '2024-08-15 12:12:12', '2024-08-16 12:12:12', 2),
(5, '2024-11-01 12:12:12', '2024-11-02 12:12:12', 1),
(6, '2024-11-01 12:12:12', '2024-11-02 12:12:12', 2),
(7, '2024-11-11 12:12:12', '2024-11-12 12:12:12', 1),
(8, '2024-11-11 12:12:12', '2024-11-12 12:12:12', 2),
(9, '2024-12-25 12:12:12', '2024-12-26 12:12:12', 1),
(10, '2024-12-25 12:12:12', '2024-12-26 12:12:12', 2);

INSERT INTO `activity` (`id_activity`, `duration`, `price`, `id_duration_unit`) VALUES
(1, 30, 8, 1),
(2, 1, 12, 2),
(3, 1, 15, 3),
(4, 1, 45, 4),
(5, 1, 250, 4);

INSERT INTO `days` (`id_days`, `name_days`, `name_days_fr`) VALUES
(5, 'fri', 'vendredi'),
(6, 'sat', 'samedi'),
(0, 'sun', 'dimanche'),
(4, 'thu', 'jeudi'),
(2, 'tue', 'mardi'),
(3, 'wed', 'mercredi');

INSERT INTO `open_days` (`id_gym`, `id_days`, `open_hour`, `close_hour`) VALUES
(1, 0, '11:00:00', '20:00:00'),
(1, 2, '10:00:00', '19:00:00'),
(1, 3, '10:00:00', '19:00:00'),
(1, 4, '10:00:00', '19:00:00'),
(1, 5, '10:00:00', '19:00:00'),
(1, 6, '11:00:00', '20:00:00'),
(2, 0, '11:00:00', '20:00:00'),
(2, 2, '10:00:00', '19:00:00'),
(2, 3, '10:00:00', '19:00:00'),
(2, 4, '10:00:00', '19:00:00'),
(2, 5, '10:00:00', '19:00:00'),
(2, 6, '11:00:00', '20:00:00');


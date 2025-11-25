CREATE TABLE `level` (
    `id` int NOT NULL,
    `name` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 
-- Extraindo dados da tabela 'level'
-- 

INSERT INTO `level` (`id`, `name`) VALUES
(1, 'Administrador'),
(2, 'Utilizador');

CREATE TABLE `user` (
    `id` int NOT NULL,
    `login` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `pass` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `level` int DEFAULT NULL,
    `user` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `login`, `pass`, `level`, `user`, `email`) VALUES
(1, 'inacio', 'ola', 2, 'Inácio Fonseca', 'inacio@isec.pt');

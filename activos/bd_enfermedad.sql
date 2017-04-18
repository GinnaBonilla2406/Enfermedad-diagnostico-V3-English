-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2017 at 10:57 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id1073712_bd_enfermedad`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_enfermedades`
--

CREATE TABLE `tb_enfermedades` (
  `id_enfermedades` int(11) NOT NULL,
  `enfermedad` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_enfermedades`
--

INSERT INTO `tb_enfermedades` (`id_enfermedades`, `enfermedad`) VALUES
(1, 'coronavirus'),
(2, 'urolitiasis'),
(3, 'Carbontoxoplasmosis'),
(4, 'leptospirosis'),
(5, 'epilepsia'),
(6, 'Prvovirosis'),
(7, 'piometra'),
(8, 'pododermetitis'),
(9, 'otitis'),
(10, 'fiebre');

-- --------------------------------------------------------

--
-- Table structure for table `tb_manuales`
--

CREATE TABLE `tb_manuales` (
  `id_manual` int(11) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `definicion` text NOT NULL,
  `url` varchar(50) NOT NULL,
  `palabras` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_manuales`
--

INSERT INTO `tb_manuales` (`id_manual`, `titulo`, `definicion`, `url`, `palabras`) VALUES
(1, 'casos de uso', 'En el Lenguaje de Modelado Unificado, un diagrama de casos de uso es una forma de diagrama de comportamiento UML mejorado. El Lenguaje de Modelado Unificado (UML), define una notación gráfica para representar casos de uso llamada modelo de casos de uso.', 'imagenes/Caso de uso1.png', 'Modelado, diagrama, gráfica, uml'),
(2, 'caso de uso', 'Un caso de uso es una descripción de los pasos o las actividades que deberán realizarse para llevar a cabo algún proceso. Los personajes o entidades que participarán en un caso de uso se denominan actores. En el contexto de ingeniería del software, un caso de uso es una secuencia de interacciones que se desarrollarán entre un sistema y sus actores en respuesta a un evento que inicia un actor principal sobre el propio sistema.', 'imagenes/caso.png', 'descripción, sistema, uso, uml'),
(3, 'clases', 'En ingeniería de software, un diagrama de clases en Lenguaje Unificado de Modelado (UML) es un tipo de diagrama de estructura estática que describe la estructura de un sistema mostrando las clases del sistema, sus atributos, operaciones (o métodos), y las relaciones entre los objetos', 'imagenes/Clases.png', 'estática, estructura, Modelado, uml'),
(4, 'Diagramas de componentes', 'Un diagrama de componentes es un diagrama tipo del Lenguaje Unificado de Modelado. Un diagrama de componentes representa cómo un sistema de software es dividido en componentes y muestra las dependencias entre estos componentes.', 'imagenes/diagrama.png', 'sistema, software, componentes, uml'),
(5, 'Diagrama de distribución', 'En el diagrama de distribución es donde representamos la estructura de hardware donde estará nuestro sistema o software, para ello cada componente lo podemos representar como nodos, el nodo es cualquier elemento que sea un recurso de hardware, es decir, es nuestra denominación genérica para nuestros equipos.', 'imagenes/diagramas.png', 'distribución, denominación, uml'),
(6, 'modelo de relación', 'Un diagrama o modelo entidad-relación (a veces denominado por sus siglas en inglés, E-R \'Entity relationship\', o del español DER \'Diagrama de Entidad Relación\') es una herramienta para el modelado de datos que permite representar las entidades relevantes de un sistema de información así como sus interrelaciones y propiedades uml.', 'imagenes/relacion.jpg', 'modelo, diagrama, relación, uml');

-- --------------------------------------------------------

--
-- Table structure for table `tb_resultados`
--

CREATE TABLE `tb_resultados` (
  `id_resultados` int(11) NOT NULL,
  `id_signos` int(11) NOT NULL,
  `id_enfermedades` int(11) NOT NULL,
  `fecha_resultado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_resultados`
--

INSERT INTO `tb_resultados` (`id_resultados`, `id_signos`, `id_enfermedades`, `fecha_resultado`) VALUES
(1, 1, 1, '2017-03-16'),
(2, 2, 2, '2017-03-21'),
(3, 3, 3, '2017-03-14'),
(4, 5, 4, '2017-03-16'),
(5, 4, 6, '2017-03-20'),
(6, 6, 5, '2017-01-25'),
(7, 7, 1, '2017-03-02'),
(8, 8, 8, '2017-03-07'),
(9, 1, 6, '2017-03-30'),
(10, 10, 10, '2017-04-13'),
(11, 5, 1, '2017-03-27'),
(100, 9, 9, '2017-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `tb_signos_y_sintomas`
--

CREATE TABLE `tb_signos_y_sintomas` (
  `id_signos` int(11) NOT NULL,
  `signos_y_sintomas` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_signos_y_sintomas`
--

INSERT INTO `tb_signos_y_sintomas` (`id_signos`, `signos_y_sintomas`) VALUES
(1, 'Anorexia'),
(2, 'Perdida de apetito'),
(3, 'infeccion mortal'),
(4, 'Problemas respiratorios'),
(5, 'Salivacion'),
(6, 'Diarrea'),
(7, 'Falta de apetito'),
(8, 'Inflamacion articular'),
(9, 'Anemia'),
(10, 'Peladuras');

-- --------------------------------------------------------

--
-- Table structure for table `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `documento` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_resultados` int(11) NOT NULL,
  `id_manual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_enfermedades`
--
ALTER TABLE `tb_enfermedades`
  ADD PRIMARY KEY (`id_enfermedades`);

--
-- Indexes for table `tb_manuales`
--
ALTER TABLE `tb_manuales`
  ADD PRIMARY KEY (`id_manual`);

--
-- Indexes for table `tb_resultados`
--
ALTER TABLE `tb_resultados`
  ADD PRIMARY KEY (`id_resultados`),
  ADD KEY `indice_enfermedades` (`id_enfermedades`),
  ADD KEY `indice_signos` (`id_signos`) USING BTREE;

--
-- Indexes for table `tb_signos_y_sintomas`
--
ALTER TABLE `tb_signos_y_sintomas`
  ADD PRIMARY KEY (`id_signos`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `index_resultado` (`id_resultados`),
  ADD KEY `index_manual` (`id_manual`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_manuales`
--
ALTER TABLE `tb_manuales`
  MODIFY `id_manual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_resultados`
--
ALTER TABLE `tb_resultados`
  MODIFY `id_resultados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_resultados`
--
ALTER TABLE `tb_resultados`
  ADD CONSTRAINT `tb_resultados_ibfk_1` FOREIGN KEY (`id_enfermedades`) REFERENCES `tb_enfermedades` (`id_enfermedades`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_resultados_ibfk_2` FOREIGN KEY (`id_signos`) REFERENCES `tb_signos_y_sintomas` (`id_signos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_manual`) REFERENCES `tb_manuales` (`id_manual`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_usuarios_ibfk_2` FOREIGN KEY (`id_resultados`) REFERENCES `tb_resultados` (`id_resultados`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 18 oct. 2021 à 20:02
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `unikin`
--

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `nom_dep` varchar(255) NOT NULL,
  `faculte` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `nom_dep`, `faculte`) VALUES
(2, 'Electricité', 4),
(3, 'Genie Civil', 4);

-- --------------------------------------------------------

--
-- Structure de la table `faculte`
--

CREATE TABLE `faculte` (
  `id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `faculte`
--

INSERT INTO `faculte` (`id`, `section_name`) VALUES
(1, 'Médecine'),
(2, 'Droit'),
(3, 'Lettres'),
(4, 'Polytechnique'),
(5, 'Psychologie');

-- --------------------------------------------------------

--
-- Structure de la table `table_admin`
--

CREATE TABLE `table_admin` (
  `id_admin` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `table_admin`
--

INSERT INTO `table_admin` (`id_admin`, `user`, `password`) VALUES
(1, 'anonyme', '$2y$10$jZKkrDgg4yMXCIBQyEds3eF8QMPoQ6lwp/.cmdN/oNnZcBe32wewC');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_status` varchar(100) NOT NULL,
  `attendance_date` date NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `matiere_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `student_id`, `attendance_status`, `attendance_date`, `teacher_id`, `matiere_id`) VALUES
(105, 37, 'Present', '2021-10-16', 34, 41),
(106, 39, 'Absent', '2021-10-16', 34, 41),
(107, 37, 'Present', '2021-10-16', 34, 41),
(108, 40, 'Absent', '2021-10-16', 34, 41),
(109, 37, 'Absent', '2021-10-16', 34, 41),
(110, 40, 'Present', '2021-10-16', 34, 41);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_cours`
--

CREATE TABLE `tbl_cours` (
  `id_cours` int(11) NOT NULL,
  `text_cours` varchar(255) NOT NULL,
  `cours_content` varchar(250) NOT NULL,
  `id_section` int(11) NOT NULL,
  `cours_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_cours`
--

INSERT INTO `tbl_cours` (`id_cours`, `text_cours`, `cours_content`, `id_section`, `cours_date`) VALUES
(32, 'les imbeciles', '616aeba071b39.pdf', 28, '2021-10-16 20:01:02');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_grade`
--

CREATE TABLE `tbl_grade` (
  `grade_id` int(11) NOT NULL,
  `grade_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_grade`
--

INSERT INTO `tbl_grade` (`grade_id`, `grade_name`) VALUES
(3, 'G1'),
(5, 'G2'),
(6, 'G3'),
(7, 'L1'),
(8, 'L2');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_matiere`
--

CREATE TABLE `tbl_matiere` (
  `id_matiere` int(11) NOT NULL,
  `nom_matiere` varchar(255) NOT NULL,
  `id_dept` int(10) NOT NULL,
  `id_faculte` int(10) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_matiere`
--

INSERT INTO `tbl_matiere` (`id_matiere`, `nom_matiere`, `id_dept`, `id_faculte`, `id_prof`, `grade_id`) VALUES
(41, 'Histoire', 2, 4, 34, 8);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_section`
--

CREATE TABLE `tbl_section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(250) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_section`
--

INSERT INTO `tbl_section` (`section_id`, `section_name`, `id_prof`, `id_matiere`) VALUES
(28, 'Chap 1: Les iodes', 34, 41);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_mail` varchar(255) NOT NULL,
  `student_addresse` varchar(250) NOT NULL,
  `student_password` varchar(250) NOT NULL,
  `student_roll_number` int(11) NOT NULL,
  `student_dob` date NOT NULL,
  `student_grade_id` int(11) NOT NULL,
  `student_fac` int(11) NOT NULL,
  `student_dep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `student_name`, `student_mail`, `student_addresse`, `student_password`, `student_roll_number`, `student_dob`, `student_grade_id`, `student_fac`, `student_dep`) VALUES
(37, 'Rimao Kayumba', 'Ariana', '6457177', '$2y$10$ZvhNCCOdKaA6QlE/b/JE2.2hA2vt6EK8SnNOSGW3CmcwfdS3hIN.S', 6457177, '2021-03-19', 8, 4, 2),
(39, 'Mokonzi Kalunda', 'kalunda@gmail.com', '1499217', '$2y$10$HZLfnJfcXACpMTM80iZ..O2GyxJnH9waMqH9fKwaAcJLUi4GIcRYu', 1499217, '2021-10-16', 8, 4, 2),
(40, 'Rimao Kayumba', 'Ariana', '7311229', '$2y$10$zshgKHkPHaVh8sX3zhHh6uhQtnI8HpsI5UBviTSUiMQ4bq7px9E0a', 7311229, '2021-04-01', 8, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `teacher_address` varchar(150) NOT NULL,
  `teacher_emailid` varchar(150) NOT NULL,
  `teacher_password` varchar(150) NOT NULL,
  `teacher_qualification` varchar(100) NOT NULL,
  `teacher_doj` date NOT NULL,
  `teacher_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teacher_id`, `teacher_name`, `teacher_address`, `teacher_emailid`, `teacher_password`, `teacher_qualification`, `teacher_doj`, `teacher_image`) VALUES
(34, 'Rimao', 'Ariana', 'omarkayumba12345@gmail.com', '$2y$10$Ju.ionexz7/M2FaHmst.luO/vAsxK1clrRh1N4CN6M11F14DnOmXy', 'divada', '2021-02-12', '61688a5f57bb0.jpg'),
(35, 'Kayumba', 'Suisse n°83', 'dido@gmail.com', '$2y$10$mLTvVl7mh7nVsT9tVd4tlONBepeXwHKtvop.vgDhAaD9jdckMgE9K', 'dsdq', '2021-10-26', '616abcf6c51fc.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_teacher_login`
--

CREATE TABLE `tbl_teacher_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `id_grade` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_teacher_login`
--

INSERT INTO `tbl_teacher_login` (`id`, `username`, `id_teacher`, `id_grade`, `id_matiere`) VALUES
(9, 'Mathomari3@university.com', 5, 3, 16),
(10, 'geiomari6@university.com', 5, 6, 17),
(11, 'Philosophieomari3@university.com', 5, 3, 18);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faculte`
--
ALTER TABLE `faculte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `table_admin`
--
ALTER TABLE `table_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Index pour la table `tbl_cours`
--
ALTER TABLE `tbl_cours`
  ADD PRIMARY KEY (`id_cours`);

--
-- Index pour la table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`grade_id`);

--
-- Index pour la table `tbl_matiere`
--
ALTER TABLE `tbl_matiere`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Index pour la table `tbl_section`
--
ALTER TABLE `tbl_section`
  ADD PRIMARY KEY (`section_id`);

--
-- Index pour la table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Index pour la table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Index pour la table `tbl_teacher_login`
--
ALTER TABLE `tbl_teacher_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `faculte`
--
ALTER TABLE `faculte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `table_admin`
--
ALTER TABLE `table_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT pour la table `tbl_cours`
--
ALTER TABLE `tbl_cours`
  MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `tbl_matiere`
--
ALTER TABLE `tbl_matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `tbl_teacher_login`
--
ALTER TABLE `tbl_teacher_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

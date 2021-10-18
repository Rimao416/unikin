-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 05 avr. 2021 à 20:36
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
-- Base de données : `presence`
--

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
(62, 8, 'Absent', '2021-03-03', 5, 16),
(63, 9, 'Absent', '2021-03-03', 5, 16),
(64, 10, 'Present', '2021-03-03', 5, 16),
(65, 12, 'Absent', '2021-03-03', 5, 16),
(66, 8, 'Present', '2021-03-03', 5, 18),
(67, 9, 'Absent', '2021-03-03', 5, 18),
(68, 10, 'Absent', '2021-03-03', 5, 18),
(69, 12, 'Present', '2021-03-03', 5, 18),
(70, 8, 'Absent', '2021-03-03', 5, 18),
(71, 9, 'Present', '2021-03-03', 5, 18),
(72, 10, 'Present', '2021-03-03', 5, 18),
(73, 12, 'Absent', '2021-03-03', 5, 18),
(74, 8, 'Absent', '2021-03-18', 5, 16),
(75, 9, 'Present', '2021-03-18', 5, 16),
(76, 10, 'Absent', '2021-03-18', 5, 16),
(77, 12, 'Absent', '2021-03-18', 5, 16),
(78, 8, 'Present', '2021-03-19', 5, 16),
(79, 9, 'Absent', '2021-03-19', 5, 16),
(80, 10, 'Present', '2021-03-19', 5, 16),
(81, 12, 'Absent', '2021-03-19', 5, 16),
(82, 15, 'Present', '2021-03-19', 5, 16),
(83, 8, 'Absent', '2021-03-19', 5, 16),
(84, 9, 'Present', '2021-03-19', 5, 16),
(85, 10, 'Absent', '2021-03-19', 5, 16),
(86, 12, 'Present', '2021-03-19', 5, 16),
(87, 15, 'Absent', '2021-03-19', 5, 16),
(88, 8, 'Present', '2021-04-01', 5, 16),
(89, 9, 'Absent', '2021-04-01', 5, 16),
(90, 10, 'Present', '2021-04-01', 5, 16),
(91, 12, 'Absent', '2021-04-01', 5, 16),
(92, 8, 'Present', '2021-04-01', 4, 36),
(93, 9, 'Absent', '2021-04-01', 4, 36),
(94, 10, 'Present', '2021-04-01', 4, 36),
(95, 12, 'Absent', '2021-04-01', 4, 36);

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
(8, 'Sous ce Pdf, vous trouverez tout ce dont vous aurez besoin', '60522e0dd9204.pdf', 7, '2021-03-18 14:27:19'),
(10, 'EXERCICE', '605315debd727.com_wallpaper', 7, '2021-03-18 14:27:19'),
(11, 'Salut les gens', '605315fc10633.png', 7, '2021-03-18 14:27:19'),
(13, 'La cardinalité', '605384917dbd6.sql', 7, '2021-03-18 16:49:21'),
(14, 'Vous trouverez ici toutes l\'histoire de ce peuple interessant', '6065a94b0bed0.pdf', 11, '2021-04-01 11:06:51'),
(15, 'Chapitre: Les réalités que rencontrent notre monde face à l\'IOT', '6065aa2e9a9a2.pptx', 12, '2021-04-01 11:10:38'),
(16, 'Cours 1', '6065ad5e6f7b5.pptx', 13, '2021-04-01 11:24:14'),
(17, 'Cours 2', '6065ad6cbc1f4.pdf', 13, '2021-04-01 11:24:28');

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
(3, 'L2_TI'),
(5, 'L3_TI'),
(6, 'L4_TI');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_matiere`
--

CREATE TABLE `tbl_matiere` (
  `id_matiere` int(11) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_matiere`
--

INSERT INTO `tbl_matiere` (`id_matiere`, `matiere`, `id_prof`, `grade_id`, `avatar`) VALUES
(16, 'Math', 5, 3, ''),
(17, 'gei', 5, 6, ''),
(18, 'histoire', 5, 3, ''),
(19, 'Philosophie', 5, 3, ''),
(36, 'IOT', 4, 3, '');

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
(1, 'Les Hématomes', 5, 17),
(2, 'Epilogue Onvexe', 5, 17),
(3, 'Les Cretaces', 5, 17),
(4, 'Idioties', 5, 17),
(5, 'Les Ermeveillés', 5, 17),
(6, 'Algèbre de Boole', 5, 16),
(7, 'Théorie des Automates', 5, 16),
(8, 'Les cours de Chayma', 5, 16),
(9, 'COURS AVANCE', 5, 16),
(10, 'L\'histoire de la revolution romaine', 5, 18),
(11, 'Les Bantous', 5, 18),
(12, 'Introduction à l\'iot', 4, 36),
(13, 'Mon Cours', 5, 16);

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
  `absence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `student_name`, `student_mail`, `student_addresse`, `student_password`, `student_roll_number`, `student_dob`, `student_grade_id`, `absence`) VALUES
(8, 'omariii', '', 'omari@gmail.com', '$2y$10$Dts9miETaEkSF5R0/ueo8OaThgIedqCSAaGY6AfzbCQIGJKbaSz9C', 12345, '2021-02-28', 3, 0),
(9, 'dido', '', '', '0', 8456, '2021-02-18', 3, 0),
(10, 'rahimfdfds', '', '', '0', 4856355, '2021-02-18', 3, 0),
(12, 'giselee', '', '', '0', 8765597, '2021-02-18', 3, 0),
(13, 'Mon_Etudiant', '', '', '$2y$10$TfY8yp3qOXUDH.oIHTpwEeysNaLFIiO.QanvaFAR5QaOz5zko/Bsq', 2442429, '2021-03-19', 5, 0),
(18, 'Sergee', '', 'Sergee6408239@university.com', '$2y$10$Dts9miETaEkSF5R0/ueo8OaThgIedqCSAaGY6AfzbCQIGJKbaSz9C', 6408239, '2021-03-20', 6, 0),
(20, 'david', 'david@gmail.com', 'david929281@university.com', '$2y$10$752kqvUwJ5nyTHFmQmY9WeyJB9Q5F4IegzIGFvVcPhC7hl5F698yG', 929281, '2021-04-01', 3, 0),
(23, 'yori', 'yori@gmail.com', 'yori8210534@university.com', '$2y$10$pbv2AmcZXr/siL2eHQHr.udQgUwtwgI5HEmDxxWKJ1WoUlK1d.hdS', 8210534, '2021-03-04', 3, 0);

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
  `teacher_image` text NOT NULL,
  `teacher_grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teacher_id`, `teacher_name`, `teacher_address`, `teacher_emailid`, `teacher_password`, `teacher_qualification`, `teacher_doj`, `teacher_image`, `teacher_grade_id`) VALUES
(3, 'dido', 'dido@gmail.com', 'dido@gmail.com', '$2y$10$Dts9miETaEkSF5R0/ueo8OaThgIedqCSAaGY6AfzbCQIGJKbaSz9C', 'meilleur', '2021-01-01', '602518d5a8e19.jpg', 3),
(4, 'Sergee', 'ennasr', 's@gmail.com', '$2y$10$Dts9miETaEkSF5R0/ueo8OaThgIedqCSAaGY6AfzbCQIGJKbaSz9C', 'quotidien', '2021-01-13', '2.jpg', 3),
(5, 'omari', 'ennasr hedi nouira', 'omari@gmail.com', '$2y$10$Dts9miETaEkSF5R0/ueo8OaThgIedqCSAaGY6AfzbCQIGJKbaSz9C', 'meilleur', '2021-02-06', '60241aa5af272.jpg', 3),
(18, 'rimao', 'dfsdfs', 'prof@gmail.com', '$2y$10$Dts9miETaEkSF5R0/ueo8OaThgIedqCSAaGY6AfzbCQIGJKbaSz9C', 'meilleur', '2021-02-12', '602680a30c3f0.jpg', 5),
(29, 'azrr', 'omari', 'omarii@gmail.com', '$2y$10$LUHyJ0/9yRK43ce11gwmkOgPAJjs2vI1n7JwDVqJkUxFGAJX1PwfW', 'm', '2021-02-12', '602698594411a.jpg', 6);

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
-- AUTO_INCREMENT pour la table `table_admin`
--
ALTER TABLE `table_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT pour la table `tbl_cours`
--
ALTER TABLE `tbl_cours`
  MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `tbl_matiere`
--
ALTER TABLE `tbl_matiere`
  MODIFY `id_matiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `tbl_teacher_login`
--
ALTER TABLE `tbl_teacher_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- Table structure for table `authentications`
--

CREATE TABLE `authentications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ipaddr` tinytext,
  `value` tinytext,
  `valid` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT '0',
  `controller` tinytext,
  `function` tinytext,
  `details` tinytext,
  `theid` int(10) unsigned DEFAULT NULL,
  `url` tinytext,
  `data` text,
  `ipaddr` tinytext,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `datetime` datetime DEFAULT NULL,
  `semester_id` int(10) unsigned DEFAULT NULL,
  `center_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `center_id` (`center_id`),
  KEY `semester_id` (`semester_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meetings_students`
--

CREATE TABLE `meetings_students` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned DEFAULT NULL,
  `meeting_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_meetings_students_meetingID` (`meeting_id`),
  KEY `FK_meetings_students_studentID` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned DEFAULT NULL,
  `title` tinytext,
  `scholarship_value` int(10) DEFAULT NULL,
  `award_semester` int(10) unsigned DEFAULT NULL,
  `start_semester` int(10) unsigned DEFAULT NULL,
  `notes` tinytext,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinytext,
  `address` tinytext,
  `city` tinytext,
  `county` tinytext,
  `center_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `center_id` (`center_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `semester` enum('Spring','Summer','Fall','Winter') DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `startingDate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned DEFAULT NULL,
  `description` tinytext,
  `service_value` int(4) DEFAULT '1',
  `type` enum('College','Scholarship','Job','Youth Programs','Other','Family') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting` tinytext,
  `status` tinytext,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` int(10) unsigned DEFAULT NULL,
  `first_name` tinytext,
  `last_name` tinytext,
  `nickname` tinytext,
  `gender` enum('Male','Female') DEFAULT NULL,
  `email` tinytext,
  `facebook_name` tinytext,
  `twitter_name` tinytext,
  `instagram_name` tinytext,
  `home_phone` tinytext,
  `cell_phone` tinytext,
  `country` tinytext,
  `country2` tinytext,
  `immigrant` int(1) DEFAULT NULL,
  `arrived_in_us` tinytext,
  `refugee_asylee` int(1) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `home_address` tinytext,
  `notes` tinytext,
  `semesters_active` tinytext,
  `civics_status` enum('started','member','none') DEFAULT 'none',
  `graduation_year` int(4) DEFAULT NULL,
  `internship_semester_id` int(10) unsigned DEFAULT NULL,
  `internship_location` tinytext,
  `did_not_finish_internship` int(1) DEFAULT NULL,
  `job_skills_completed` tinyint(1) DEFAULT NULL,
  `graduated` tinyint(1) DEFAULT NULL,
  `employed` enum('full','part','no') DEFAULT NULL,
  `where_employed` tinytext,
  `college` tinyint(1) DEFAULT NULL,
  `which_college` tinytext,
  `major` tinytext,
  `graduated_college` tinyint(1) DEFAULT NULL,
  `free_and_reduced_lunches` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` tinytext,
  `college_graduation_year` int(4) DEFAULT NULL,
  `no_response` int(1) DEFAULT NULL,
  `grad_school` tinyint(1) DEFAULT NULL,
  `which_grad_school` tinytext,
  `graduated_grad_school` int(1) DEFAULT NULL,
  `deceased` int(1) DEFAULT '0',
  `number_children` int(2) DEFAULT '0',
  `semester_started` int(10) unsigned DEFAULT NULL,
  `semester_member` int(10) unsigned DEFAULT NULL,
  `grade` int(2) DEFAULT NULL,
  `semester_grade_noted` int(10) unsigned DEFAULT NULL,
  `constant_contact` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school_id` (`school_id`),
  KEY `semester_started` (`semester_started`),
  KEY `semester_member` (`semester_member`),
  KEY `internship_semester_id` (`internship_semester_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students_semesters`
--

CREATE TABLE `students_semesters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned DEFAULT NULL,
  `semester_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id_2` (`student_id`,`semester_id`),
  KEY `student_id` (`student_id`),
  KEY `semester_id` (`semester_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` tinytext,
  `last_name` tinytext,
  `email` tinytext,
  `password` tinytext,
  `birthday` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_centers`
--

CREATE TABLE `users_centers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `center_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `center_id` (`center_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_meetings`
--

CREATE TABLE `users_meetings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `meeting_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_users_meetings_userID` (`user_id`),
  KEY `FK_users_meetings_meetingID` (`meeting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_schools`
--

CREATE TABLE `users_schools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `school_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_users_schools_userID` (`user_id`),
  KEY `FK_users_schools_schoolID` (`school_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authentications`
--
ALTER TABLE `authentications`
  ADD CONSTRAINT `authentications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `meetings_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `meetings_students`
--
ALTER TABLE `meetings_students`
  ADD CONSTRAINT `FK_meetings_students_studentID` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `FK_meetings_students_meetingID` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`);

--
-- Constraints for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD CONSTRAINT `scholarships_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK_students_schoolID` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Constraints for table `students_semesters`
--
ALTER TABLE `students_semesters`
  ADD CONSTRAINT `FK_students_semesters_semesterID` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `FK_students_semesters_studentID` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `users_centers`
--
ALTER TABLE `users_centers`
  ADD CONSTRAINT `users_centers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_centers_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`);

--
-- Constraints for table `users_meetings`
--
ALTER TABLE `users_meetings`
  ADD CONSTRAINT `FK_users_meetings_meetingID` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`),
  ADD CONSTRAINT `FK_users_meetings_userID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_schools`
--
ALTER TABLE `users_schools`
  ADD CONSTRAINT `FK_users_schools_schoolID` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`),
  ADD CONSTRAINT `FK_users_schools_userID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

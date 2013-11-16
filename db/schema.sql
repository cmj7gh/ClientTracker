create table settings (
		id int unsigned auto_increment primary key,
		setting tinytext,
		status tinytext,
		created datetime default null,
		modified datetime default null
) engine=innodb;

create table users (
		id int unsigned auto_increment primary key,
		first_name tinytext,
		last_name tinytext,
		email tinytext,
		password tinytext,
		birthday datetime,
		created datetime,
		modified datetime
) engine=innodb;

create table semesters(
		id int unsigned auto_increment primary key,
		semester enum('Spring','Summer','Fall','Winter'),
		year int(4)
) engine=innodb;

create table students (
		id int unsigned auto_increment primary key,
		school_id int unsigned,
        first_name tinytext,
        last_name tinytext,
		nickname tinytext,
        email tinytext,
		facebook_name tinytext,
		home_phone tinytext,
		cell_phone tinytext,
		country tinytext,
		birthday datetime,
		home_address tinytext,
		notes tinytext,
		no_response int(1),
		semester_member int unsigned,
		semester_started int unsigned,
		semesters_active tinytext,
		civics_status enum('started','member','none') default 'none',
		graduation_year int(4),
		internship_semester_id int unsigned,
		internship_location tinytext,
		job_skills_completed boolean,
		graduated boolean,
		employed enum('full','part','no') default 'no',
		college boolean,
		which_college tinytext,
		college_graduation_year int(4),
		graduated_college boolean,
		grad_schools int(1),
		which_grad_school int(1),
		graduated_grad_school int(1),
		free_and_reduced_lunches int(1),
		created datetime,
		modified datetime,
		modified_by tinytext,
		index(school_id),
        foreign key (school_id) references schools(id),
		index(semester_started),
        foreign key (semester_started) references semesters(id),
		index(semester_member),
        foreign key (semester_member) references semesters(id),
		index(internship_semester_id),
        foreign key (internship_semester_id) references semesters(id)
) engine=innodb;

create table centers (
		id int unsigned auto_increment primary key,
		title tinytext
) engine=innodb;

create table scholarships (
		id int unsigned auto_increment primary key,
		student_id int unsigned,
		title tinytext,
		scholarship_value int(10),
		index(student_id),
		foreign key (student_id) references students(id)
) engine=innodb;

create table services (
		id int unsigned auto_increment primary key,
		student_id int unsigned,
		description tinytext,
		service_value int(4) default 1,
		type enum('College', 'Scholarship', 'Job', 'Youth Programs', 'Other', 'Family'),
		index(student_id),
		foreign key (student_id) references students(id)
) engine=innodb;

create table schools (
		id int unsigned auto_increment primary key,
		name tinytext,
		address tinytext,
		city tinytext,
		county tinytext,
		center_id int unsigned,
		created datetime,
		modified datetime,
		index(center_id),
		foreign key (center_id) references centers(id)
) engine=innodb;

create table meetings (
		id int unsigned auto_increment primary key,
		title tinytext,
		datetime datetime,
		semester_id int unsigned,
		center_id int unsigned,
		created datetime,
		modified datetime,
		index(center_id),
		foreign key (center_id) references centers(id),
		index(semester_id),
		foreign key (semester_id) references semesters(id)
) engine=innodb;

create table logs (
       id int unsigned auto_increment primary key,
       user_id int unsigned default 0,
       controller tinytext,
       function tinytext,
       details tinytext,
       theid int unsigned,
       url tinytext,
       data text,
       ipaddr tinytext,
       created datetime,
       index(user_id),
       foreign key (user_id) references users(id)
) engine=innodb;

create table authentications (
       id int unsigned auto_increment primary key,
       user_id int unsigned,
       ipaddr tinytext,
       value tinytext,
       valid boolean,
       created datetime,
       modified datetime,
       index(user_id),
       foreign key (user_id) references users(id)
) engine=innodb;

create table meetings_students (
       id int unsigned auto_increment primary key,
       student_id int unsigned,
       meeting_id int unsigned,
	   index(student_id),
		foreign key (student_id) references students(id),
				index(meeting_id),
		foreign key (meeting_id) references meetings(id)
) engine=innodb;

create table users_centers (
       id int unsigned auto_increment primary key,
       user_id int unsigned,
       center_id int unsigned,
		index(user_id),
		foreign key (user_id) references users(id),
				index(center_id),
		foreign key (center_id) references centers(id)
) engine=innodb;

create table users_meetings (
		id int unsigned auto_increment primary key,
		user_id int unsigned,
		meeting_id int unsigned,
		index(user_id),
		foreign key (user_id) references users(id),
		index(meeting_id),
		foreign key (meeting_id) references meetings(id)
) engine=innodb;

create table students_semesters (
		id int unsigned auto_increment primary key,
		student_id int unsigned,
		semester_id int unsigned,
		index(student_id),
		foreign key (student_id) references students(id),
		index(semester_id),
		foreign key (semester_id) references semesters(id)
) engine=innodb;
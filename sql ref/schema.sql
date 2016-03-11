drop table if exists cached_logins;
drop table if exists sets;
drop table if exists workouts;
drop table if exists supporting_muscles;
drop table if exists exercise_types;
drop table if exists exercises;
drop table if exists muscles;
drop table if exists user_stats;
drop table if exists users;

create table if not exists users (
  id int auto_increment,
  name varchar(100),
  user_name varchar(100) unique,
  password char(40),
  birthday date,
  current_trend enum('bulking','cutting','inactive'),
  primary key (id)
);

create table if not exists user_stats (
  id int auto_increment,
  type enum('height','weight'),
  amount double,
  user int not null,
  primary key(id),
  foreign key(user) references users(id)
);

create table if not exists muscles (
  name varchar(30),
  muscle_group varchar(30),
  size int,
  primary key(name)
);

create table if not exists exercises (
  id int auto_increment,
  muscle varchar(30),
  type int,
  primary key(id),
  foreign key(muscle) references muscles(name)
);

#needs to be a one to many relationship so that an exercise can be strength, hiit, or both
create table if not exists exercise_types (
  id int auto_increment,
  type enum('strength', 'HIIT', 'powerlifitng', 'endurance'),
  exercise int,
  primary key(id),
  foreign key(exercise) references exercises(id)
);

#Many to many relationship for exercises to supporting muscles
create table if not exists supporting_muscles (
  id int auto_increment,
  exercise int,
  muscle varchar(30),
  foreign key(exercise) references exercises(id),
  foreign key(muscle) references muscles(name),
  primary key(id)
);

create table if not exists workouts (
  id int auto_increment,
  user int not null,
  muscle varchar(30),
  day date,
  category enum('endurance','strength', 'HIIT'),
  primary key(id),
  foreign key(user) references users(id),
  foreign key(muscle) references muscles(name)
);

create table if not exists sets (
  id int auto_increment,
  workout int,
  exercise int,
  num_reps int,
  duration_secs int,
  break_secs int,
  primary key (id),
  foreign key (workout) references workouts(id),
  foreign key (exercise) references exercises(id)
);

create table if not exists cached_logins (
  id char(32),
  user int,
  primary key(id),
  foreign key (user) references users(id)
);

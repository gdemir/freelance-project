use MAIL;
# Mark_States
	insert into Mark_States (name) values('Okunmadı');
	insert into Mark_States (name) values('Okundu');

# Departments
	insert into Departments (name) values('Bilgisayar Mühendisliği');
	insert into Departments (name) values('İnşaat Mühendisliği');

# Genders
	insert into Genders (name) values('Erkek');
	insert into Genders (name) values('Kadın');	

# User_Types
	insert into User_Types (name) values('Yönetici');
	insert into User_Types (name) values('Hoca');
	insert into User_Types (name) values('Öğrenci');

# Users
	insert into Users (user_type_id, department_id, gender_id, email, first_name, last_name, password)
	values(1, 1, 1,  'g1@m', 'Gökhan', 'Demir', '159654');
	insert into Users (user_type_id, department_id, gender_id, email, first_name, last_name, password)
	values(2, 1, 1, 'g2@m', 'Göktuğ', 'Demir', '159654');
	insert into Users (user_type_id, department_id, gender_id, email, first_name, last_name, password)
	values(3, 2, 2, 'g3@m', 'Gökçen', 'Demir', '159654');

# Mails
	insert into Mails (user_id, subject, content)
	values(1, "test mail attım ben 1numara", "Bu bir içeriktir");
	insert into Mails (user_id, subject, content)
	values(1, "1numaradan geldi", "hmm");
	insert into Mails (user_id, subject, content)
	values(3, "3noluyum", "atıyorum");
	insert into Mails (user_id, subject, content)
	values(3, "3nolu adamın 2.maili", "atıyorum glese ");
	insert into Mails (user_id, subject, content)
	values(1, "2 tut", "hmm");


# Recipients
	insert into Recipients (mail_id, user_id, mark_state_id)
	values(1, 2, 1);
	insert into Recipients (mail_id, user_id, mark_state_id)
	values(1, 3, 1);
	insert into Recipients (mail_id, user_id, mark_state_id)
	values(2, 2, 1);
	insert into Recipients (mail_id, user_id, mark_state_id)
	values(3, 1, 1);
	insert into Recipients (mail_id, user_id, mark_state_id)
	values(3, 2, 1);
	insert into Recipients (mail_id, user_id, mark_state_id)
	values(4, 2, 1);
	insert into Recipients (mail_id, user_id, mark_state_id)
	values(5, 2, 1);

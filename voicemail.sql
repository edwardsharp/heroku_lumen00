CREATE TABLE voicemailbox (
vmb_extension varchar(8) primary key not null, 
vmb_description varchar(32) not null, 
vmb_passcode varchar(8) not null,
vmb_last_checked timestamp
);

insert into voicemailbox (
	vmb_extension,
	vmb_description,
	vmb_passcode
)values (
	'1234',
	'Test voicemail',
	'1111'
);

CREATE TABLE messages (
	message_id SERIAL not null primary key, 
	message_frn_vmb_extension varchar(8) not null, 
	message_date timestamp not null, 
	message_from varchar(16),
	message_audio_url varchar(1024),
	message_flag int default 0
);

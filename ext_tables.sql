#
# Table structure for table 'tx_mtmfertighausweltintegration_domain_model_house'
#
CREATE TABLE tx_mtmfertighausweltintegration_domain_model_house (

	house_number varchar(3) DEFAULT '0' NOT NULL,
	house_name varchar(255) DEFAULT '' NOT NULL,
	house_manufacturer int(11) DEFAULT '0' NOT NULL,
	house_description text,
	architectial_style varchar(255) DEFAULT '' NOT NULL,
	number_of_rooms int(11) DEFAULT '0' NOT NULL,
	living_space varchar(255) DEFAULT '' NOT NULL,
	energetic_standard varchar(255) DEFAULT '' NOT NULL,
	slider_images int(11) unsigned DEFAULT '0' NOT NULL,
	layout_basement int(11) unsigned NOT NULL default '0',
	living_space_basement varchar(255) DEFAULT '' NOT NULL,
	layout_ground_floor int(11) unsigned NOT NULL default '0',
	living_space_ground_floor varchar(255) DEFAULT '' NOT NULL,
	layout_upstairs int(11) unsigned NOT NULL default '0',
	living_space_upstairs varchar(255) DEFAULT '' NOT NULL,
	layout_attic int(11) unsigned NOT NULL default '0',
	living_space_attic varchar(255) DEFAULT '' NOT NULL,
	contact_data text,
    youtube_data text
);

#
# Table structure for table 'tx_mtmfertighausweltintegration_domain_model_manufacturer'
#
CREATE TABLE tx_mtmfertighausweltintegration_domain_model_manufacturer (

	manufacturer_name varchar(255) DEFAULT '' NOT NULL,
	manufacturer_slogan varchar(255) DEFAULT '' NOT NULL,
	description text,
	email varchar(255) DEFAULT '' NOT NULL,
    	brochure_email varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,
	fax varchar(255) DEFAULT '' NOT NULL,
	website varchar(255) DEFAULT '' NOT NULL,
	strasse varchar(255) DEFAULT '' NOT NULL,
	plz varchar(255) DEFAULT '' NOT NULL,
	ort varchar(255) DEFAULT '' NOT NULL,
	manufacturer_logo int(11) unsigned NOT NULL default '0'

);

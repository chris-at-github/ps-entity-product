CREATE TABLE tx_entity_domain_model_entity (

	technical_drawings int(11) unsigned DEFAULT '0' NOT NULL,
	applications int(11) unsigned DEFAULT '0' NOT NULL,
	attributes int(11) unsigned DEFAULT '0' NOT NULL,
	variants int(11) unsigned DEFAULT '0' NOT NULL,
	accessories int(11) unsigned DEFAULT '0' NOT NULL

);

CREATE TABLE tx_entityproduct_domain_model_attribute (

	title varchar(255) DEFAULT '' NOT NULL,
	unit varchar(255) DEFAULT '' NOT NULL,
	data_type int(11) DEFAULT '0' NOT NULL


);

CREATE TABLE tx_entityproduct_domain_model_variant (

	product int(11) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	article_number varchar(255) DEFAULT '' NOT NULL,
	files int(11) unsigned NOT NULL default '0',
	attributes int(11) unsigned DEFAULT '0' NOT NULL


);

CREATE TABLE tx_entityproduct_domain_model_attributevalue (

	variant int(11) unsigned DEFAULT '0' NOT NULL,
	value varchar(255) DEFAULT '' NOT NULL,
	attribute int(11) unsigned DEFAULT '0'


);

CREATE TABLE tx_entityproduct_product_attribute_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);


CREATE TABLE tx_entityproduct_product_accessories_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);


CREATE TABLE tx_entityproduct_product_applications_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

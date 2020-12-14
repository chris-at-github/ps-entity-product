CREATE TABLE tx_entity_domain_model_entity (
	technical_drawings int(11) unsigned DEFAULT '0' NOT NULL,
	applications int(11) unsigned DEFAULT '0' NOT NULL,
	show_configurator smallint(5) unsigned DEFAULT '1' NOT NULL,
	attributes int(11) unsigned DEFAULT '0' NOT NULL,
	variants int(11) unsigned DEFAULT '0' NOT NULL,
	accessories int(11) unsigned DEFAULT '0' NOT NULL,
	configurator_filter_attributes int(11) unsigned DEFAULT '0' NOT NULL,
	configurator_result_attributes int(11) unsigned DEFAULT '0' NOT NULL,
	grouped_attributes int(11) unsigned DEFAULT '0' NOT NULL
);

CREATE TABLE tx_entityproduct_domain_model_attribute (
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	alternative_title varchar(255) DEFAULT '' NOT NULL,
	unit varchar(255) DEFAULT '' NOT NULL,
	prefix varchar(10) DEFAULT '' NOT NULL,
	data_type varchar(50) DEFAULT '' NOT NULL,
	group_type varchar(50) DEFAULT '' NOT NULL,
	options int(11) unsigned DEFAULT '0' NOT NULL
);

CREATE TABLE tx_entityproduct_domain_model_variant (
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	product int(11) unsigned DEFAULT '0' NOT NULL,
	model varchar(255) DEFAULT '' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	article_number varchar(255) DEFAULT '' NOT NULL,
	type_code varchar(255) DEFAULT '' NOT NULL,
	file int(11) unsigned NOT NULL default '0',
	attributes int(11) unsigned DEFAULT '0' NOT NULL,
	pi_flexform mediumtext
);

CREATE TABLE tx_entityproduct_domain_model_attributevalue (
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	variant int(11) unsigned DEFAULT '0' NOT NULL,
	value varchar(255) DEFAULT '' NOT NULL,
	attribute int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_entityproduct_domain_model_attributeoption (
	attribute int(11) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL
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

CREATE TABLE tx_entityproduct_product_configuratorfilter_attribute_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_entityproduct_product_configuratorresult_attribute_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_entityproduct_product_grouped_attribute_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

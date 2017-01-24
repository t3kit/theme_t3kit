#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	wrapper int(11) unsigned DEFAULT '0' NOT NULL,
	aligning int(11) unsigned DEFAULT '0' NOT NULL,
	wrapper_margin_top int(11) unsigned DEFAULT '0' NOT NULL,
	wrapper_margin_bottom int(11) unsigned DEFAULT '0' NOT NULL
);

#
# Add show in preview to file reference
#
CREATE TABLE sys_file_reference (
  tx_themet3kit_slide_btn_txt varchar(255) DEFAULT '' NOT NULL,
  tx_themet3kit_slide_appearance int(11) unsigned DEFAULT '0' NOT NULL
);

#
# Add SQL definition of database tables
#
CREATE TABLE tt_content
(
    link       varchar(1024) default '' not null,
    link_title varchar(255)  default '' not null,
);

CREATE TABLE tx_sitepackage_domain_model_event
(
    title        varchar(255)  default ''         not null,
    description  varchar(2000) default ''         not null,
    image        int(11) unsigned default '0' not null,
    start_date   varchar(2000) default ''         not null,
    end_date     varchar(2000) default ''         not null,
    slug         varchar(2048),

    address      varchar(255)  default ''         not null,
    zip          varchar(32)   default ''         not null,
    city         varchar(255)  default ''         not null,
    longitude    decimal(9, 6) default '0.000000' not null,
    latitude     decimal(9, 6) default '0.000000' not null,

    registration int(11) unsigned DEFAULT '0' NOT NULL,
);

CREATE TABLE tx_sitepackage_domain_model_eventregistration
(
    event     int(11) unsigned default '0' not null,
    firstname varchar(255) default '' not null,
    lastname  varchar(255) default '' not null,
    email     varchar(255) default '' not null,
    fe_user   int(11) default '0' not null,
);
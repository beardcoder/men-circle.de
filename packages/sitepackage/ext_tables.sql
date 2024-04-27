#
# Add SQL definition of database tables
#
CREATE TABLE tt_content
(
    link                   varchar(1024) default '' not null,
    link_title             varchar(255)  default '' not null,
    tx_sitepackage_feature int(10) unsigned default '0' not null,
);

CREATE TABLE tx_sitepackage_feature
(
    tt_content int(10) unsigned default '0' not null,
    header     varchar(255) default '' not null,
    bodytext   varchar(255) default '' not null,
);


CREATE TABLE tx_sitepackage_domain_model_event
(
    title        varchar(255)  default ''         not null,
    description  varchar(2000) default ''         not null,
    image        int(11) unsigned default '0' not null,
    start_date   varchar(2000) default ''         not null,
    end_date     varchar(2000) default ''         not null,
    slug         varchar(2048),
    price        decimal(9, 2) default '0.00'     not null,

    place        varchar(255)  default ''         not null,
    address      varchar(255)  default ''         not null,
    zip          varchar(32)   default ''         not null,
    city         varchar(255)  default ''         not null,
    longitude    decimal(9, 6) default '0.000000' not null,
    latitude     decimal(9, 6) default '0.000000' not null,

    registration int(10) unsigned default '0' not null,
);

CREATE TABLE tx_sitepackage_domain_model_eventregistration
(
    event     int(10) unsigned default '0' not null,
    first_name varchar(255) default '' not null,
    last_name  varchar(255) default '' not null,
    email     varchar(255) default '' not null,
    fe_user   int(10) unsigned default '0' not null,
);
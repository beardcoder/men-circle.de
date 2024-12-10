CREATE TABLE `fe_users`
(
    `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`uid`)
);


CREATE TABLE tx_sitepackage_domain_model_participant
(
    fe_user int(10) unsigned default 0 null,
    FOREIGN KEY (fe_user) REFERENCES fe_users (uid) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tx_sitepackage_domain_model_subscription
(
    fe_user int(10) unsigned default 0 null,
    FOREIGN KEY (fe_user) REFERENCES fe_users (uid) ON DELETE CASCADE ON UPDATE CASCADE
);

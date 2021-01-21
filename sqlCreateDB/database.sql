CREATE TABLE users (
    id      int             PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nom     varchar(50)     NOT NULL,
    prenom  varchar(50)     NOT NULL,
    email   varchar(255)    UNIQUE NOT NULL,
    mdp     varchar(255)    NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `mdp`) VALUES
(1, 'Champaloux', 'Loïc', 'a@adm', '$argon2i$v=19$m=65536,t=4,p=1$TU9mVk9EeGx6anFJaDljbw$5UI7jHHGh8m1ATUXX6rV6+ldF8kialZ/8OFY3pgKhHg'),
(2, 'Spannuet', 'Chloé', 'a@pnm', '$argon2i$v=19$m=65536,t=4,p=1$TU9mVk9EeGx6anFJaDljbw$5UI7jHHGh8m1ATUXX6rV6+ldF8kialZ/8OFY3pgKhHg'),
(3, 'Hughes', 'Tony', 'tony@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TU9mVk9EeGx6anFJaDljbw$5UI7jHHGh8m1ATUXX6rV6+ldF8kialZ/8OFY3pgKhHg'),
(4, 'Duchemin', 'Pascal', 'pascal@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TU9mVk9EeGx6anFJaDljbw$5UI7jHHGh8m1ATUXX6rV6+ldF8kialZ/8OFY3pgKhHg'),
(5, 'Dujardin', 'Jean', 'jean@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TU9mVk9EeGx6anFJaDljbw$5UI7jHHGh8m1ATUXX6rV6+ldF8kialZ/8OFY3pgKhHg');

CREATE TABLE techniciens (
    id          int             PRIMARY KEY AUTO_INCREMENT NOT NULL,
    users_id    int             NOT NULL,
    tel         varchar(10)     NOT NULL,
    statut      varchar(20)     NOT NULL COMMENT "admin ou conseiller"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `techniciens` (`id`, `users_id`, `tel`, `statut`) VALUES
(1, 1, '0605040302', 'admin'),
(2, 2, '0607080910', 'conseiller'),
(3, 3, '0604020806', 'conseiller');

CREATE TABLE membres (
    id                  int             PRIMARY KEY AUTO_INCREMENT NOT NULL,
    users_id            int             NOT NULL,
    membre_type         varchar(20)     NOT NULL COMMENT "chauffeur ou passager",
    valide              boolean         NOT NULL DEFAULT 0,
    actif               boolean         NOT NULL DEFAULT 1,
    civilite            varchar(10)     NOT NULL COMMENT "Mme ou M.",
    date_naissance      date            NOT NULL,
    lieu_naissance      varchar(100)    NOT NULL,
    dep_naissance       int             NOT NULL,
    tel                 varchar(10)     DEFAULT NULL,
    mobile              varchar(10)     DEFAULT NULL,
    evaluation          boolean         NOT NULL DEFAULT 0,
    caisse_retraite     varchar(255)    NOT NULL DEFAULT 0,
    conditions          boolean         NOT NULL,
    created_at          timestamp       NOT NULL,
    created_by          int             NOT NULL COMMENT "user id",
    updated_at          timestamp       NOT NULL,
    updated_by          int             NOT NULL COMMENT "user id",
    adresse             int             NOT NULL COMMENT "adresse id"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `membres` (`id`, `users_id`, `membre_type`, `valide`, `actif`, `civilite`, `date_naissance`, `lieu_naissance`, `dep_naissance`, `tel`, `mobile`, `evaluation`, `caisse_retraite`, `conditions`, `created_at`, `created_by`, `updated_at`, `updated_by`, `adresse`) VALUES
(1, 4, 'chauffeur', 0, 1, 'M.', '2020-08-01', 'Angoulême', 16, '0707070707', '0101010101', 0, 0, 1, '2020-07-31 22:00:00', 4, '2020-07-31 22:00:00', 4, 1),
(2, 5, 'passager', 0, 1, 'M.', '2020-08-01', 'Montmoreau', 16, '0102030405', '0504030201', 0, 'Caisse', 1, '2020-07-31 22:00:00', 3, '2020-07-31 22:00:00', 1, 2);

CREATE TABLE adresses (
    id              int             PRIMARY KEY AUTO_INCREMENT NOT NULL,
    adresse         varchar(255)    NOT NULL,
    complement      varchar(255)    DEFAULT NULL,
    code_postal     int             NOT NULL,
    commune         varchar(100)    NOT NULL,
    created_at      timestamp       NOT NULL,
    created_by      int             NOT NULL COMMENT "user id",
    updated_at      timestamp       NOT NULL,
    updated_by      int             NOT NULL COMMENT "user id"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `adresses` (`id`, `adresse`, `complement`, `code_postal`, `commune`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Place de la Mairie', '', 16390, 'Bonnes', '2020-07-31 22:00:00', 4, '2020-07-31 22:00:00', 2),
(2, 'Place de la Poste', '2 Bis', 16390, 'Bonnes', '2020-07-31 22:00:00', 3, '2020-07-31 22:00:00', 5);

CREATE TABLE documents (
    id              int             PRIMARY KEY AUTO_INCREMENT NOT NULL,
    users_id        int             NOT NULL,
    doc_type        varchar(255)    NOT NULL,
    doc_name        varchar(255)    DEFAULT NULL,
    valide          boolean         NOT NULL DEFAULT 0,
    expiration      date            DEFAULT NULL,
    created_at      timestamp       NOT NULL,
    created_by      int             NOT NULL COMMENT "user id",
    updated_at      timestamp       NOT NULL,
    updated_by      int             NOT NULL COMMENT "user id"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tokens (
    id          int             PRIMARY KEY AUTO_INCREMENT NOT NULL,
    email       varchar(255)    NOT NULL,
    token       varchar(255)    NOT NULL,
    expiration  datetime        NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE bons (
    id              int             PRIMARY KEY AUTO_INCREMENT NOT NULL,
    parcours_id     int             NOT NULL,
    kilometres      int             NOT NULL,
    fichier         varchar(255)    NOT NULL COMMENT "nom du fichier"
    paye            boolean         NOT NULL DEFAULT '0',
    date_paye       timestamp       DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE retraites (
    id          int             PRIMARY KEY AUTO_INCREMENT NOT NULL,
    users_id    int             NOT NULL,
    caisse      varchar(255)    NOT NULL,
    gir         int             NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE techniciens ADD CONSTRAINT fk_technicien_users_id
FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE;

ALTER TABLE membres ADD CONSTRAINT fk_membre_users_id
FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE;

ALTER TABLE membres ADD CONSTRAINT fk_membre_created_by
FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE CASCADE;

ALTER TABLE membres ADD CONSTRAINT fk_membre_updated_by
FOREIGN KEY (updated_by) REFERENCES users (id) ON DELETE CASCADE;

ALTER TABLE membres ADD CONSTRAINT fk_membre_adresse
FOREIGN KEY (adresse) REFERENCES adresses (id) ON DELETE CASCADE;

ALTER TABLE adresses ADD CONSTRAINT fk_adresse_created_by
FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE CASCADE;

ALTER TABLE adresses ADD CONSTRAINT fk_adresse_updated_by
FOREIGN KEY (updated_by) REFERENCES users (id) ON DELETE CASCADE;

ALTER TABLE documents ADD CONSTRAINT fk_document_users_id
FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE;

ALTER TABLE documents ADD CONSTRAINT fk_document_created_by
FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE CASCADE;

ALTER TABLE documents ADD CONSTRAINT fk_document_updated_by
FOREIGN KEY (updated_by) REFERENCES users (id) ON DELETE CASCADE;

ALTER TABLE bons ADD CONSTRAINT fk_bon_parcours_id
FOREIGN KEY (parcours_id) REFERENCES parcours (id) ON DELETE CASCADE;



-- CREATE TABLE `trajet` (
--     `id` int  NOT NULL ,
--     `date_debut` datetime  NOT NULL ,
--     `date_fin` datetime  NOT NULL ,
--     `conducteur` int  NOT NULL ,
--     `beneficiaire` int  NOT NULL ,
--     `depart` int  NOT NULL ,
--     `destination` int  NOT NULL ,
--     `aller_retour` int  NOT NULL ,
--     `distance` int  NOT NULL ,
--     `motif` varchar(255)  NOT NULL ,
--     `type` varchar(255)  NOT NULL ,
--     `gare` int  NOT NULL ,
--     `active` boolean  NOT NULL ,
--     `valide` int  NOT NULL ,
--     `created_at` timestamp  NOT NULL ,
--     `created_by` int  NOT NULL ,
--     `updated_at` timestamp  NOT NULL ,
--     `updated_by` int  NOT NULL ,
--     PRIMARY KEY (
--         `id`
--     )
-- );

-- CREATE TABLE `covoiturages` (
--     `id` int  NOT NULL ,
--     `offre` int  NOT NULL ,
--     `demande` int  NOT NULL ,
--     `somme` decimal  NOT NULL ,
--     `km` int  NOT NULL ,
--     `bonTransport` boolean  NOT NULL ,
--     PRIMARY KEY (
--         `id`
--     )
-- );

-- CREATE TABLE `disponibilite` (
--     `id` int  NOT NULL ,
--     `conducteur` int  NOT NULL ,
--     `date_debut` datetime  NOT NULL ,
--     `date_fin` datetime  NOT NULL ,
--     `destination` varchar(255)  NOT NULL ,
--     `distance` int  NOT NULL ,
--     `created_at` timestamp  NOT NULL ,
--     `created_by` int  NOT NULL ,
--     `updated_at` timestamp  NOT NULL ,
--     `updated_by` int  NOT NULL ,
--     PRIMARY KEY (
--         `id`
--     )
-- );

-- CREATE TABLE `territoire` (
--     `id` int  NOT NULL ,
--     `CP` varchar(255)  NOT NULL ,
--     `pnm` int  NOT NULL ,
--     PRIMARY KEY (
--         `id`
--     )
-- );

-- CREATE TABLE `pnm` (
--     `id` int  NOT NULL ,
--     `adresse` int  NOT NULL ,
--     `website` varchar(255)  NOT NULL ,
--     PRIMARY KEY (
--         `id`
--     )
-- );

-- CREATE TABLE `cotisation` (
--     `id` int  NOT NULL ,
--     `user` int  NOT NULL ,
--     `debut` datetime  NOT NULL ,
--     `fin` datetime  NOT NULL ,
--     `payes` int  NOT NULL ,
--     `rappel` datetime  NOT NULL ,
--     `created_at` timestamp  NOT NULL ,
--     `created_by` int  NOT NULL ,
--     `updated_at` timestamp  NOT NULL ,
--     `updated_by` int  NOT NULL ,
--     PRIMARY KEY (
--         `id`
--     )
-- );

-- CREATE TABLE `notifcation` (
--     `id` int  NOT NULL ,
--     `table` varchar(255)  NOT NULL ,
--     `champ` varchar(255)  NOT NULL ,
--     `idfk` int  NOT NULL ,
--     `updated_at` timestamp  NOT NULL ,
--     `message` varchar(255)  NOT NULL ,
--     `active` boolean  NOT NULL ,
--     PRIMARY KEY (
--         `id`
--     )
-- );



-- ALTER TABLE `trajet` ADD CONSTRAINT `fk_trajet_conducteur` FOREIGN KEY(`conducteur`)
-- REFERENCES `user` (`id`);

-- ALTER TABLE `trajet` ADD CONSTRAINT `fk_trajet_beneficiaire` FOREIGN KEY(`beneficiaire`)
-- REFERENCES `user` (`id`);

-- ALTER TABLE `trajet` ADD CONSTRAINT `fk_trajet_depart` FOREIGN KEY(`depart`)
-- REFERENCES `adresse` (`id`);

-- ALTER TABLE `trajet` ADD CONSTRAINT `fk_trajet_destination` FOREIGN KEY(`destination`)
-- REFERENCES `adresse` (`id`);

-- ALTER TABLE `trajet` ADD CONSTRAINT `fk_trajet_created_by` FOREIGN KEY(`created_by`)
-- REFERENCES `user` (`id`);

-- ALTER TABLE `trajet` ADD CONSTRAINT `fk_trajet_updated_by` FOREIGN KEY(`updated_by`)
-- REFERENCES `user` (`id`);

-- ALTER TABLE `covoiturages` ADD CONSTRAINT `fk_covoiturages_offre` FOREIGN KEY(`offre`)
-- REFERENCES `trajet` (`id`);

-- ALTER TABLE `covoiturages` ADD CONSTRAINT `fk_covoiturages_demande` FOREIGN KEY(`demande`)
-- REFERENCES `trajet` (`id`);

-- ALTER TABLE `disponibilite` ADD CONSTRAINT `fk_disponibilite_conducteur` FOREIGN KEY(`conducteur`)
-- REFERENCES `user` (`id`);

-- ALTER TABLE `disponibilite` ADD CONSTRAINT `fk_disponibilite_created_by` FOREIGN KEY(`created_by`)
-- REFERENCES `user` (`id`);

-- ALTER TABLE `disponibilite` ADD CONSTRAINT `fk_disponibilite_updated_by` FOREIGN KEY(`updated_by`)
-- REFERENCES `user` (`id`);

-- ALTER TABLE `territoire` ADD CONSTRAINT `fk_territoire_pnm` FOREIGN KEY(`pnm`)
-- REFERENCES `pnm` (`id`);

-- ALTER TABLE `pnm` ADD CONSTRAINT `fk_pnm_adresse` FOREIGN KEY(`adresse`)
-- REFERENCES `adresse` (`id`);

-- ALTER TABLE `cotisation` ADD CONSTRAINT `fk_cotisation_user` FOREIGN KEY(`user`)
-- REFERENCES `user` (`id`);

-- ALTER TABLE `cotisation` ADD CONSTRAINT `fk_cotisation_created_by` FOREIGN KEY(`created_by`)
-- REFERENCES `user` (`id`);

-- ALTER TABLE `cotisation` ADD CONSTRAINT `fk_cotisation_updated_by` FOREIGN KEY(`updated_by`)
-- REFERENCES `user` (`id`);
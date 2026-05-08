-- =========================================================================
-- 1. TABLE : parametres (Pour satisfaire le CRUD Paramètres exigé par le sujet)
-- =========================================================================
CREATE TABLE parametres (
    cle VARCHAR(100) PRIMARY KEY,
    valeur VARCHAR(255) NOT NULL,
    description TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 2. TABLE : objectifs
-- =========================================================================
CREATE TABLE objectifs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 3. TABLE : utilisateurs
-- =========================================================================
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    genre ENUM('Homme','Femme') NOT NULL,
    role ENUM('user','admin') DEFAULT 'user',
    solde DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 4. TABLE : historique_sante
-- =========================================================================
CREATE TABLE historique_sante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    taille DECIMAL(5,2) NOT NULL,       
    poids DECIMAL(5,2) NOT NULL,        
    imc DECIMAL(5,2),                  
    date_mesure DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 5. TABLE : objectifs_utilisateur
-- =========================================================================
CREATE TABLE objectifs_utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_objectif INT NOT NULL,
    date_debut DATETIME DEFAULT CURRENT_TIMESTAMP,
    actif BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (id_objectif) REFERENCES objectifs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 6. TABLE : regimes (Avec contrainte CHECK sur le total des pourcentages)
-- =========================================================================
CREATE TABLE regimes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    pourcentage_viande DECIMAL(5,2) DEFAULT 0,
    pourcentage_poisson DECIMAL(5,2) DEFAULT 0,
    pourcentage_volaille DECIMAL(5,2) DEFAULT 0,
    CONSTRAINT chk_pourcentages CHECK (
        pourcentage_viande + pourcentage_poisson + pourcentage_volaille <= 100
    )
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 7. TABLE : regime_prix_duree
-- =========================================================================
CREATE TABLE regime_prix_duree (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_regime INT NOT NULL,
    duree_jours INT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    variation_poids DECIMAL(5,2) NOT NULL, 
    FOREIGN KEY (id_regime) REFERENCES regimes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 8. TABLE : activites_sportives
-- =========================================================================
CREATE TABLE activites_sportives (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    calories_brulees INT,                  
    intensite ENUM('Faible','Moyenne','Forte')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 9. TABLE : regime_activites (Table d'association Many-To-Many)
-- =========================================================================
CREATE TABLE regime_activites (
    id_regime INT NOT NULL,
    id_activite INT NOT NULL,
    PRIMARY KEY (id_regime, id_activite),
    FOREIGN KEY (id_regime) REFERENCES regimes(id) ON DELETE CASCADE,
    FOREIGN KEY (id_activite) REFERENCES activites_sportives(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 10. TABLE : codes_recharge
-- =========================================================================
CREATE TABLE codes_recharge (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code_texte VARCHAR(100) UNIQUE NOT NULL,
    valeur DECIMAL(10,2) NOT NULL,
    est_utilise BOOLEAN DEFAULT FALSE,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 11. TABLE : transactions_portefeuille
-- =========================================================================
CREATE TABLE transactions_portefeuille (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_code INT NULL, -- NULL si achat direct (Régime ou Gold)
    montant DECIMAL(10,2) NOT NULL, -- Positif pour Recharge, Négatif pour Achat
    type_transaction ENUM('RECHARGE','ACHAT_REGIME','ACHAT_GOLD') NOT NULL,
    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (id_code) REFERENCES codes_recharge(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 12. TABLE : abonnements_gold
-- =========================================================================
CREATE TABLE abonnements_gold (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    prix_paye DECIMAL(10,2) NOT NULL,
    reduction DECIMAL(5,2) DEFAULT 15.00, -- ex: 15.00%
    date_debut DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_fin DATETIME DEFAULT NULL,        -- NULL si abonnement à vie (payé une fois)
    actif BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =========================================================================
-- 13. TABLE : achats_regimes
-- =========================================================================
CREATE TABLE achats_regimes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_regime_prix_duree INT NOT NULL,
    prix_paye DECIMAL(10,2) NOT NULL, -- Prix après éventuelle réduction Gold
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (id_regime_prix_duree) REFERENCES regime_prix_duree(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ============================================================
-- نظام إدارة التداريب والتكوين – وزارة العدل
-- ============================================================

CREATE DATABASE IF NOT EXISTS gestion_stagiaires
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_stagiaires;

-- ── المصالح ──────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS services (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nom_ar     VARCHAR(200) NOT NULL,
    nom_fr     VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO services (id, nom_ar, nom_fr) VALUES
(1,  'المديرية الإقليمية للعدل بمكناس',                    'Direction Régionale de la Justice de Meknès'),
(2,  'كتابة الضبط بالمحكمة الابتدائية بأزرو',              'Greffe du Tribunal de Première Instance d''Azrou'),
(3,  'كتابة الضبط بالمحكمة الابتدائية بالحاجب',            'Greffe du Tribunal de Première Instance d''El Hajeb'),
(4,  'كتابة الضبط بالمحكمة الابتدائية بمكناس',             'Greffe du Tribunal de Première Instance de Meknès'),
(5,  'كتابة الضبط بمحكمة الاستئناف بمكناس',                'Greffe de la Cour d''Appel de Meknès'),
(6,  'كتابة النيابة العامة بالمحكمة الابتدائية بأزرو',     'Parquet du Tribunal de Première Instance d''Azrou'),
(7,  'كتابة النيابة العامة بالمحكمة الابتدائية بالحاجب',   'Parquet du Tribunal de Première Instance d''El Hajeb'),
(8,  'كتابة النيابة العامة بالمحكمة الابتدائية بمكناس',    'Parquet du Tribunal de Première Instance de Meknès'),
(9,  'كتابة النيابة العامة بمحكمة الاستئناف بمكناس',       'Parquet de la Cour d''Appel de Meknès');

-- ── المتدربون ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS stagiaires (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    nom           VARCHAR(200) NOT NULL,
    service_id    INT,
    specialite    VARCHAR(200),
    date_debut    DATE,
    date_fin      DATE,
    statut        ENUM('actif','termine') DEFAULT 'actif',
    doc_demande   VARCHAR(500),
    doc_assurance VARCHAR(500),
    doc_base      VARCHAR(500),
    doc_rapport   VARCHAR(500),
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

-- ── الموظفون (للتكوين الأساسي) ────────────────────────────
CREATE TABLE IF NOT EXISTS employes (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nom_complet VARCHAR(200) NOT NULL,
    cin         VARCHAR(20),
    telephone   VARCHAR(20),
    specialite  VARCHAR(200),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ── التكوين الأساسي ───────────────────────────────────────
CREATE TABLE IF NOT EXISTS formations_base (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    employe_id  INT NOT NULL,
    service_id  INT,
    date_debut  DATE,
    date_fin    DATE,
    rapport     VARCHAR(500),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employe_id) REFERENCES employes(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

-- ── الندوات ───────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS nadwat (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    sujet      VARCHAR(300) NOT NULL,
    type_nadwa VARCHAR(100),
    date_nadwa DATE,
    lieu       VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ── مشاركو الندوات ────────────────────────────────────────
CREATE TABLE IF NOT EXISTS nadwat_participants (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nadwa_id INT NOT NULL,
    nom      VARCHAR(200) NOT NULL,
    FOREIGN KEY (nadwa_id) REFERENCES nadwat(id) ON DELETE CASCADE
);

-- ── التكوين المستمر ───────────────────────────────────────
CREATE TABLE IF NOT EXISTS formations_continues (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    sujet      VARCHAR(300) NOT NULL,
    lieu       VARCHAR(200),
    date_debut DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ── الدروس ────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS durus (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    formation_id INT NOT NULL,
    nom_dars     VARCHAR(300) NOT NULL,
    date_dars    DATE,
    heure        VARCHAR(20),
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (formation_id) REFERENCES formations_continues(id) ON DELETE CASCADE
);

-- ── تكوين الماستر ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS masters (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nom_master VARCHAR(300) NOT NULL,
    annee      VARCHAR(10),
    universite VARCHAR(200),
    specialite VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ── الطلبة الموظفون ───────────────────────────────────────
CREATE TABLE IF NOT EXISTS talib_muwazzaf (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    master_id     INT NOT NULL,
    nom_complet   VARCHAR(200) NOT NULL,
    num_matricule VARCHAR(50),
    telephone     VARCHAR(20),
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (master_id) REFERENCES masters(id) ON DELETE CASCADE
);

-- ── الفصول الدراسية ───────────────────────────────────────
CREATE TABLE IF NOT EXISTS fusul (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    talib_id     INT NOT NULL,
    numero_fasl  INT NOT NULL,
    FOREIGN KEY (talib_id) REFERENCES talib_muwazzaf(id) ON DELETE CASCADE
);

-- ── الوحدات الدراسية (ديناميكية) ──────────────────────────
CREATE TABLE IF NOT EXISTS wahedat (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    fasl_id   INT NOT NULL,
    nom_wahda VARCHAR(200) NOT NULL,
    nuqta     DECIMAL(4,2),
    FOREIGN KEY (fasl_id) REFERENCES fusul(id) ON DELETE CASCADE
);

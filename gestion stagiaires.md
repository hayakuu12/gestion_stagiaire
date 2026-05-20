# 📋 Application de Gestion des Stagiaires

> Système PHP MVC – Usage local, géré par un responsable administratif

-----

## 📌 Informations Générales

|Champ              |Détail                                    |
|-------------------|------------------------------------------|
|**Technologie**    |PHP (Architecture MVC)                    |
|**Base de données**|MySQL                                     |
|**Environnement**  |Serveur local (XAMPP / WAMP)              |
|**Accès**          |Direct – aucune inscription requise       |
|**Domaine**        |Gestion des stagiaires – Justice Numérique|
|**Référence**      |Ministère de la Justice – Maroc           |


> ⚠️ L’application est utilisée exclusivement en local par un responsable désigné. Il n’y a pas de système d’inscription ni de gestion de comptes utilisateurs.

-----

## 🎯 Objectifs de l’Application

- Gérer les dossiers des stagiaires (إدارة ملفات المتدربين)
- Suivre les formations et les stages (متابعة التكوين والتدارب)
- Générer des relevés et des attestations
- Assurer la liaison entre les établissements de formation et les structures d’accueil

-----

## 👤 Entités Principales

### 1. الحاسب / Stagiaire

|Champ            |Type        |Description                |
|-----------------|------------|---------------------------|
|Nom complet      |Texte       |الاسم الكامل               |
|CNE / MASSAR     |Texte unique|Identifiant académique     |
|Date de naissance|Date        |تاريخ الميلاد              |
|Téléphone        |Texte       |الهاتف                     |
|Adresse          |Texte       |العنوان                    |
|Nationalité      |Texte       |الجنسية                    |
|Cycle            |Enum        |Licence / Master / Doctorat|
|Filière          |Texte       |التخصص                     |

-----

### 2. التدريب / Stage

|Champ                  |Type   |Description                         |
|-----------------------|-------|------------------------------------|
|Établissement d’accueil|Texte  |جهة الاستقبال                       |
|Thème du stage         |Texte  |موضوع التدريب                       |
|Date début             |Date   |بداية                               |
|Date fin               |Date   |نهاية                               |
|Superviseur            |Texte  |المشرف                              |
|Évaluation             |Décimal|التقييم                             |
|Observations           |Texte  |ملاحظات                             |
|Statut                 |Enum   |en_cours / terminé / validé / refusé|

-----

### 3. التكوين / Formation

|Champ               |Type |Description  |
|--------------------|-----|-------------|
|Intitulé            |Texte|اسم المسار   |
|Établissement       |Texte|المؤسسة      |
|Programme           |Texte|البرنامج     |
|Spécialité          |Texte|التخصص       |
|Référence           |Texte|رقم التأشير  |
|Date d’accréditation|Date |تاريخ التأشير|
|Contact             |Texte|الهاتف       |

-----

### 4. المذكرة / Rapport de Stage

|Champ             |Type   |Description                |
|------------------|-------|---------------------------|
|Sujet             |Texte  |الموضوع                    |
|Date de remise    |Date   |تاريخ التسليم              |
|Date de soutenance|Date   |المناقشة                   |
|Participation     |Décimal|المشاركة                   |
|Note totale       |Décimal|نقاط الاشتراك              |
|Statut            |Enum   |brouillon / soumis / validé|

-----

## 🗂️ Modules de l’Application

```
Application Gestion Stagiaires
├── Stagiaires          → CRUD complet des dossiers
├── Stages              → Suivi et affectation des stages
├── Formations          → Gestion des filières et programmes
├── Notes               → Relevés de notes par semestre
└── Rapports            → Mémoires et soutenances
```

### Flux de traitement par le responsable

```
Réception dossier stagiaire
        ↓
Saisie dans l'application (Ajouter stagiaire)
        ↓
Affectation à un stage (Créer stage)
        ↓
Suivi et mise à jour du statut
        ↓
Enregistrement des notes et résultats
        ↓
Validation du rapport / attestation
```

-----

## 🗄️ Structure Base de Données (MySQL)

### Table : `stagiaires`

```sql
CREATE TABLE stagiaires (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nom             VARCHAR(100) NOT NULL,
    prenom          VARCHAR(100) NOT NULL,
    date_naissance  DATE,
    cne_massar      VARCHAR(20) UNIQUE,
    telephone       VARCHAR(20),
    adresse         TEXT,
    nationalite     VARCHAR(50),
    cycle           ENUM('Licence', 'Master', 'Doctorat') NOT NULL,
    filiere         VARCHAR(200),
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Table : `stages`

```sql
CREATE TABLE stages (
    id                   INT AUTO_INCREMENT PRIMARY KEY,
    stagiaire_id         INT NOT NULL,
    etablissement_accueil VARCHAR(200),
    theme                TEXT,
    date_debut           DATE,
    date_fin             DATE,
    superviseur          VARCHAR(100),
    evaluation           DECIMAL(4,2),
    observations         TEXT,
    statut               ENUM('en_cours', 'termine', 'valide', 'refuse') DEFAULT 'en_cours',
    FOREIGN KEY (stagiaire_id) REFERENCES stagiaires(id) ON DELETE CASCADE
);
```

### Table : `formations`

```sql
CREATE TABLE formations (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    intitule            VARCHAR(200) NOT NULL,
    etablissement       VARCHAR(200),
    programme           VARCHAR(200),
    specialite          VARCHAR(200),
    reference           VARCHAR(50),
    date_accreditation  DATE,
    contact             VARCHAR(100)
);
```

### Table : `notes`

```sql
CREATE TABLE notes (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    stagiaire_id        INT NOT NULL,
    annee_universitaire VARCHAR(10),
    semestre            INT,
    module_nom          VARCHAR(200),
    coefficient         DECIMAL(3,2),
    moyenne             DECIMAL(4,2),
    resultat            ENUM('ACQUIS PAR VALIDATION', 'AJOURNE', 'VALIDE', 'NON VALIDE'),
    FOREIGN KEY (stagiaire_id) REFERENCES stagiaires(id) ON DELETE CASCADE
);
```

### Table : `rapports`

```sql
CREATE TABLE rapports (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    stagiaire_id     INT NOT NULL,
    stage_id         INT NOT NULL,
    sujet            VARCHAR(300),
    date_remise      DATE,
    date_soutenance  DATE,
    participation    DECIMAL(4,2),
    note_totale      DECIMAL(4,2),
    statut           ENUM('brouillon', 'soumis', 'valide') DEFAULT 'brouillon',
    FOREIGN KEY (stagiaire_id) REFERENCES stagiaires(id) ON DELETE CASCADE,
    FOREIGN KEY (stage_id)     REFERENCES stages(id)     ON DELETE CASCADE
);
```

-----

## 🏗️ Architecture MVC PHP

```
/gestion_stagiaires
├── index.php               ← Point d'entrée unique (routeur)
├── config/
│   └── database.php        ← Connexion PDO
├── models/
│   ├── Stagiaire.php
│   ├── Stage.php
│   ├── Formation.php
│   ├── Note.php
│   └── Rapport.php
├── controllers/
│   ├── StagiaireController.php
│   ├── StageController.php
│   ├── FormationController.php
│   ├── NoteController.php
│   └── RapportController.php
├── views/
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   ├── stagiaires/
│   │   ├── index.php       ← Liste
│   │   ├── create.php      ← Formulaire ajout
│   │   ├── edit.php        ← Formulaire modification
│   │   └── show.php        ← Détail dossier
│   ├── stages/
│   │   ├── index.php
│   │   ├── create.php
│   │   └── edit.php
│   ├── formations/
│   │   ├── index.php
│   │   └── create.php
│   └── rapports/
│       ├── index.php
│       └── create.php
└── assets/
    ├── css/
    └── js/
```

-----

## 🔧 Code PHP

### `config/database.php`

```php
<?php
class Database {
    private string $host = 'localhost';
    private string $db   = 'gestion_stagiaires';
    private string $user = 'root';
    private string $pass = '';

    public function getConnection(): PDO {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8";
        return new PDO($dsn, $this->user, $this->pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}
```

### `models/Stagiaire.php`

```php
<?php
require_once '../config/database.php';

class Stagiaire {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM stagiaires ORDER BY nom");
        return $stmt->fetchAll();
    }

    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM stagiaires WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO stagiaires (nom, prenom, date_naissance, cne_massar, telephone, adresse, cycle, filiere)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['nom'],
            $data['prenom'],
            $data['date_naissance'],
            $data['cne_massar'],
            $data['telephone'],
            $data['adresse'],
            $data['cycle'],
            $data['filiere']
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare("
            UPDATE stagiaires
            SET nom = ?, prenom = ?, telephone = ?, adresse = ?, cycle = ?, filiere = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['nom'],
            $data['prenom'],
            $data['telephone'],
            $data['adresse'],
            $data['cycle'],
            $data['filiere'],
            $id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM stagiaires WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
```

### `controllers/StagiaireController.php`

```php
<?php
require_once '../models/Stagiaire.php';

class StagiaireController {
    private Stagiaire $model;

    public function __construct() {
        $this->model = new Stagiaire();
    }

    public function index(): void {
        $stagiaires = $this->model->getAll();
        require '../views/stagiaires/index.php';
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header('Location: index.php?action=stagiaires');
            exit;
        }
        require '../views/stagiaires/create.php';
    }

    public function edit(int $id): void {
        $stagiaire = $this->model->getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header('Location: index.php?action=stagiaires');
            exit;
        }
        require '../views/stagiaires/edit.php';
    }

    public function delete(int $id): void {
        $this->model->delete($id);
        header('Location: index.php?action=stagiaires');
        exit;
    }
}
```

### `index.php` – Routeur principal

```php
<?php
require_once 'controllers/StagiaireController.php';
require_once 'controllers/StageController.php';
require_once 'controllers/FormationController.php';
require_once 'controllers/RapportController.php';

$action = $_GET['action'] ?? 'stagiaires';
$id     = isset($_GET['id']) ? (int)$_GET['id'] : null;

match ($action) {
    'stagiaires'        => (new StagiaireController())->index(),
    'create_stagiaire'  => (new StagiaireController())->create(),
    'edit_stagiaire'    => (new StagiaireController())->edit($id),
    'delete_stagiaire'  => (new StagiaireController())->delete($id),

    'stages'            => (new StageController())->index(),
    'create_stage'      => (new StageController())->create(),
    'edit_stage'        => (new StageController())->edit($id),
    'delete_stage'      => (new StageController())->delete($id),

    'formations'        => (new FormationController())->index(),
    'create_formation'  => (new FormationController())->create(),

    'rapports'          => (new RapportController())->index(),
    'create_rapport'    => (new RapportController())->create(),

    default             => (new StagiaireController())->index(),
};
```

-----

## 🔀 Routes CRUD

|Action             |URL                                     |Méthode |
|-------------------|----------------------------------------|--------|
|Liste stagiaires   |`index.php`                             |GET     |
|Ajouter stagiaire  |`index.php?action=create_stagiaire`     |GET/POST|
|Modifier stagiaire |`index.php?action=edit_stagiaire&id=X`  |GET/POST|
|Supprimer stagiaire|`index.php?action=delete_stagiaire&id=X`|GET     |
|Liste stages       |`index.php?action=stages`               |GET     |
|Ajouter stage      |`index.php?action=create_stage`         |GET/POST|
|Modifier stage     |`index.php?action=edit_stage&id=X`      |GET/POST|
|Liste formations   |`index.php?action=formations`           |GET     |
|Ajouter rapport    |`index.php?action=create_rapport`       |GET/POST|

-----

## 📊 Relevé de Notes – Référence (Semestre 7, 2024-2025)

Basé sur le relevé officiel – Université Moulay Ismail, Meknès :

|Module                                     |Coef|Moyenne  |Résultat             |
|-------------------------------------------|----|---------|---------------------|
|Droit Civil Approfondi                     |1,00|13,00    |ACQUIS PAR VALIDATION|
|Droit Commercial Approfondi                |1,00|12,00    |ACQUIS PAR VALIDATION|
|Méthodologie                               |1,00|15,00    |ACQUIS PAR VALIDATION|
|Droit de Travail et Protection des Salariés|1,00|12,00    |ACQUIS PAR VALIDATION|
|Droit Foncier Approfondi                   |1,00|10,00    |ACQUIS PAR VALIDATION|
|Langues Étrangères                         |1,00|17,50    |ACQUIS PAR VALIDATION|
|Soft Skills                                |1,00|19,00    |ACQUIS PAR VALIDATION|
|**Résultat du Semestre**                   |    |**14,07**|**VALIDE**           |

-----

## 📋 Colonnes – Formulaire Ministère de la Justice

|Colonne (AR)  |Colonne (FR)       |
|--------------|-------------------|
|الاسم         |Nom                |
|تاريخ الميلاد |Date de naissance  |
|مدة التدريب 1 |Durée stage 1      |
|مدة التدريب 2 |Durée stage 2      |
|تاريخ الانتهاء|Date de fin        |
|الجهة         |Structure d’accueil|
|النتيجة       |Résultat           |
|الملاحظات     |Observations       |
|التاريخ       |Date               |
|الإمضاء       |Signature          |

-----

## ✅ Conventions Techniques/

- **PDO** avec requêtes préparées (`?`) – pas de concaténation directe dans les requêtes SQL
- Pattern **`(new Database())->getConnection()`** pour l’instanciation
- Séparation stricte **Modèle / Contrôleur / Vue**
- `require` pour l’inclusion des vues dans les contrôleurs
- Tableaux indexés dans `execute([...])` pour les paramètres positionnels
- `ON DELETE CASCADE` sur toutes les clés étrangères
- Routeur unique via `index.php` avec `match`

-----


*Application locale – BTS 2DWFS – Gestion des Stagiaires (PHP MVC)*

/////// UPDATE /////////////
# نظام إدارة التداريب والتكوين

## وصف المشروع

المشروع عبارة عن نظام لإدارة التداريب والتكوين داخل المؤسسة.

النظام يستعمل من طرف مسؤول واحد فقط، لذلك لا يوجد نظام تسجيل الدخول أو إدارة المستخدمين.

يجب أن يكون النظام كاملاً باللغة العربية مع دعم اتجاه RTL.

---

# حذف نظام المصادقة

النظام لا يحتاج:

- Login
- Register
- Users
- Roles
- Permissions
- Authentication
- Session Management

عند تشغيل التطبيق يتم الدخول مباشرة إلى Dashboard.

---

# لوحة التحكم (Dashboard)

يجب عرض إحصائيات:

- عدد المتدربين
- عدد التداريب
- عدد التكوينات الأساسية
- عدد التكوينات المستمرة
- عدد الندوات
- عدد تكوينات الماستر
- عدد الموظفين
- التداريب النشطة
- التداريب المنتهية

---

# القسم الأول: التداريب

قسم خاص بإدارة المتدربين.

## بيانات التدريب

يحتوي على:

- طلب التدريب
- التأمين
- الوثائق الأساسية
- الشعبة / التخصص
- التقرير النهائي

## المصلحة

يجب إضافة اختيار المصلحة التي سيجري فيها التدريب.

مثال:

المصلحة: الموارد البشرية

## مدة التدريب

إضافة فترة التدريب:

- تاريخ البداية
- تاريخ النهاية

مثال:

من 01/06/2026 إلى 31/07/2026

---

# القسم الثاني: التكوين

يوجد نوعان:

## 1. التكوين الأساسي

### بيانات الموظف

يحتوي على:

- الاسم الكامل
- رقم البطاقة الوطنية
- رقم الهاتف
- التخصص
- التقرير

### فترة التكوين

تحتوي على:

- الموظف
- المصلحة
- تاريخ البداية
- تاريخ النهاية

---

## 2. التكوين المستمر

ينقسم إلى قسمين:

### أ. الندوات

تحتوي على:

- موضوع الندوة
- نوع الندوة
- تاريخ الندوة
- مكان الندوة

مع إمكانية إضافة المشاركين.

---

### ب. التكوين المستمر

يحتوي على:

- موضوع التكوين
- مكان التكوين
- تاريخ البداية

## الدروس

كل درس يحتوي على:

- اسم الدرس
- التاريخ
- الساعة

ملاحظة:

إذا تم إدخال درس واحد فقط خلال يوم معين يتم احتسابه كيوم واحد.

---

# القسم الثالث: تكوين الماستر

قسم خاص بموظفي الماستر.

## معلومات الماستر

يحتوي على:

- اسم الماستر
- سنة الماستر
- الجامعة أو الكلية
- الشعبة

---

## معلومات الموظف الطالب

يحتوي على:

- الاسم الكامل
- رقم التأجير
- رقم الهاتف

---

# كشف النقط

يحتوي على أربعة فصول:

- الفصل الأول
- الفصل الثاني
- الفصل الثالث
- الفصل الرابع

داخل كل فصل توجد الوحدات مع النقط.

مثال:

البرمجة : 15

قواعد البيانات : 14

الشبكات : 16

---

# الوحدات الدراسية

الوحدات يجب أن تكون ديناميكية.

الخصائص المطلوبة:

- إضافة وحدة
- حذف وحدة
- تعديل وحدة

ولا يجب أن تكون الوحدات ثابتة.

---

# الوثائق والملفات

يجب دعم رفع الملفات التالية:

PDF

DOC

DOCX

صور

للملفات التالية:

- طلب التدريب
- التأمين
- الوثائق الأساسية
- التقارير
- كشوف النقط

---

# القوائم الجانبية

## التداريب

- إضافة تدريب
- قائمة المتدربين
- الوثائق
- التقارير

## التكوين الأساسي

- الموظفون
- فترات التكوين
- التقارير

## التكوين المستمر

- الندوات
- المشاركون
- التكوينات
- الدروس

## تكوين الماستر

- الماستر
- الطلبة الموظفون
- كشف النقط
- الوحدات

---

# خصائص إضافية

- واجهة عربية بالكامل
- RTL
- Date format: DD/MM/YYYY
- البحث داخل الجداول
- التصفية
- Dashboard حديثة
- تصدير PDF
- تصدير Excel
- إشعارات عند اقتراب انتهاء التدريب أو التكوين
- تصميم حديث ومتجاوب
- استعمال جداول منظمة
- دعم الهواتف والحواسيب

---

# ملاحظات مهمة

النظام مخصص لمسؤول واحد فقط.

لا يجب إنشاء أي نظام Authentication أو Users.

يجب تحديث قاعدة البيانات وإنشاء الجداول والعلاقات اللازمة حسب المتطلبات السابقة.
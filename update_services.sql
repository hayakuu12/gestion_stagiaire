-- تحديث جدول المصالح
USE gestion_stagiaires;

-- حذف المصالح القديمة وإعادة الإدراج
TRUNCATE TABLE services;

INSERT INTO services (id, nom_ar, nom_fr) VALUES
(1,  'المديرية الإقليمية للعدل بمكناس',                    'Direction Régionale de la Justice de Meknès'),
(2,  'كتابة الضبط بالمحكمة الابتدائية بأزرو',              'Greffe du Tribunal de Première Instance d''Azrou'),
(3,  'كتابة الضبط بالمحكمة الابتدائية بالحاجب',            'Greffe du Tribunal de Première Instance d''El Hajeb'),
(4,  'كتابة الضبط بالمحكمة الابتدائية بمكناس',             'Greffe du Tribunal de Première Instance de Meknès'),
(5,  'كتابة الضبط بمحكمة الاستئناف بمكناس',                'Greffe de la Cour d''Appel de Meknès'),
(6,  'كتابة النيابة العامة بالمحكمة الابتدائية بأزرو',     'Parquet du Tribunal de Première Instance d''Azrou'),
(7,  'كتابة النيابة العامة بالمحكمة الابتدائية بالحاجب',   'Parquet du Tribunal de Première Instance d''El Hajeb'),
(8,  'كتابة النيابة العامة بالمحكمة الابتدائية بمكناس',    'Parquet du Tribunal de Première Instance de Meknès'),
(9,  'كتابة النيابة العامة بمحكمة الاستئناف بمكناس',       'Parquet de la Cour d''Appel de Meknès');

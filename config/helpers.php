<?php
function uploadFile(string $inputName, string $subDir): ?string {
    if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    $file    = $_FILES[$inputName];
    $ext     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
    if (!in_array($ext, $allowed, true)) return null;

    $dir = __DIR__ . '/../uploads/' . $subDir . '/';
    if (!is_dir($dir)) mkdir($dir, 0755, true);

    $safe     = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);
    $filename = uniqid() . '_' . $safe;
    if (move_uploaded_file($file['tmp_name'], $dir . $filename)) {
        return 'uploads/' . $subDir . '/' . $filename;
    }
    return null;
}

function formatDate(?string $date): string {
    return $date ? date('d/m/Y', strtotime($date)) : '—';
}

function expiresLabel(?string $dateFin): string {
    if (!$dateFin) return '';
    $diff = (new DateTime($dateFin))->diff(new DateTime())->days;
    $past = (new DateTime($dateFin)) < new DateTime();
    if ($past)     return '<span class="badge bg-danger">منتهي</span>';
    if ($diff <= 7) return '<span class="badge bg-warning text-dark">ينتهي قريباً</span>';
    return '';
}

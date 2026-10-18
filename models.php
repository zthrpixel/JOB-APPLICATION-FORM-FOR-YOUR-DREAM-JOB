<?php
require_once 'dbConfig.php';

// READ ALL
function getAllApplications($pdo) {
    $sql = "SELECT * FROM job_app ORDER BY created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

// READ ONE
function getApplicationByID($pdo, $applicant_id) {
    // Change applicant_id to id in the WHERE clause:
    $sql = "SELECT * FROM job_app WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$applicant_id])) {
        return $stmt->fetch();
    }
}

// CREATE
function insertApplication($pdo, $applicant_name, $email, $preferred_role, $primary_engine, $contact_number, $years_experience) {
    $sql = "INSERT INTO job_app (applicant_name, email, preferred_role, primary_engine, contact_number, years_experience) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$applicant_name, $email, $preferred_role, $primary_engine, $contact_number, $years_experience]);
}

// UPDATE
function updateApplication($pdo, $applicant_name, $email, $preferred_role, $primary_engine, $contact_number, $years_experience, $applicant_id) {
    $sql = "UPDATE job_app 
            SET applicant_name = ?, email = ?, preferred_role = ?, primary_engine = ?, contact_number = ?, years_experience = ? 
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$applicant_name, $email, $preferred_role, $primary_engine, $contact_number, $years_experience, $applicant_id]);
}

// DELETE
function deleteApplication($pdo, $applicant_id) {
    $sql = "DELETE FROM job_app WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$applicant_id]);
}
?>
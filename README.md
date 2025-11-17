# BU-IFT-323
Mockup for group assignment
Student Disciplinary Record Management System (minimal PHP)

Installation:
1. Import sql/schema.sql and sql/seed.sql into MySQL (via phpMyAdmin or CLI).
2. Update DB credentials in config/config.php.
3. Ensure Apache serves c:\xampp\htdocs\BU-IFT-323\public as site root (or use http://localhost/BU-IFT-323/public).
4. Open in browser and use navigation to manage students and incidents.

Notes:
- This is a minimal scaffold: expand controllers, add auth, validation, file uploads, and RBAC for production.
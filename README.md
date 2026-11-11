# CineCast

A PHP + SQLite casting platform connecting talent (actors/models) with filmmakers and casting teams.

## MVP features
- Separate talent and filmmaker accounts with password hashing and session login
- Talent profile: city, age, gender, skills, bio and portfolio link
- Filmmakers can publish casting calls with project type, location, role, age range and deadline
- Public casting-call discovery and search
- Talent applications with duplicate prevention
- Filmmaker applicant review and status updates (submitted, shortlisted, selected, rejected)
- CSRF tokens, escaped output, role checks and SQLite foreign keys

## Run locally
Requirements: PHP 8.1+ with PDO SQLite enabled.

```bash
php -S localhost:8000
```
Open http://localhost:8000. The SQLite database is created automatically in `storage/` on first request. Ensure the PHP process can write to the storage directory.

## Structure
- `index.php` — marketing landing page
- `auth/` — registration, login and logout
- `casting/` — browse, create, view and manage casting calls
- `dashboard.php` — role-based dashboard
- `profile.php` — talent profile updates
- `includes/bootstrap.php` — database, sessions, helpers and schema
- `assets/` — responsive UI styles and interactions

## Production checklist
Configure HTTPS, secure session cookie settings, rate limiting, email verification/password reset, moderation/reporting, privacy/consent and file storage before public launch. Add proper audition media uploads and notifications as a next phase.

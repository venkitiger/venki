<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
define('APP_NAME','CineCast');
define('BASE_URL', rtrim(str_replace('\\\\','/',dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/'));
function url(string $path=''): string { $root = (defined('BASE_URL') && BASE_URL !== '/' ? BASE_URL : ''); return $root . '/' . ltrim($path,'/'); }
function e(?string $value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function db(): PDO {
 static $pdo=null; if ($pdo instanceof PDO) return $pdo;
 $dir=__DIR__.'/../storage'; if(!is_dir($dir)) mkdir($dir,0775,true);
 $pdo=new PDO('sqlite:'.$dir.'/cinecast.sqlite'); $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
 $pdo->exec("PRAGMA foreign_keys=ON;
 CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,email TEXT NOT NULL UNIQUE,password TEXT NOT NULL,role TEXT NOT NULL CHECK(role IN ('talent','filmmaker')),created_at TEXT DEFAULT CURRENT_TIMESTAMP);
 CREATE TABLE IF NOT EXISTS talent_profiles(user_id INTEGER PRIMARY KEY REFERENCES users(id) ON DELETE CASCADE,city TEXT DEFAULT '',age INTEGER,gender TEXT DEFAULT '',bio TEXT DEFAULT '',skills TEXT DEFAULT '',portfolio_url TEXT DEFAULT '',photo_url TEXT DEFAULT '');
 CREATE TABLE IF NOT EXISTS casting_calls(id INTEGER PRIMARY KEY AUTOINCREMENT,user_id INTEGER NOT NULL REFERENCES users(id),title TEXT NOT NULL,project_type TEXT NOT NULL,city TEXT NOT NULL,role_description TEXT NOT NULL,age_min INTEGER,age_max INTEGER,gender TEXT DEFAULT 'Any',deadline TEXT,description TEXT NOT NULL,status TEXT DEFAULT 'open',created_at TEXT DEFAULT CURRENT_TIMESTAMP);
 CREATE TABLE IF NOT EXISTS applications(id INTEGER PRIMARY KEY AUTOINCREMENT,casting_id INTEGER NOT NULL REFERENCES casting_calls(id) ON DELETE CASCADE,talent_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,note TEXT DEFAULT '',status TEXT DEFAULT 'submitted',created_at TEXT DEFAULT CURRENT_TIMESTAMP,UNIQUE(casting_id,talent_id));");
 return $pdo;
}
function current_user(): ?array { if(empty($_SESSION['user_id'])) return null; $s=db()->prepare('SELECT id,name,email,role FROM users WHERE id=?');$s->execute([$_SESSION['user_id']]);return $s->fetch() ?: null; }
function require_login(): array { $u=current_user();if(!$u){header('Location: '.url('auth/login.php'));exit;}return $u; }
function require_role(string $role): array { $u=require_login();if($u['role']!==$role){http_response_code(403);exit('You do not have permission to view this page.');}return $u; }
function csrf_token(): string { if(empty($_SESSION['csrf']))$_SESSION['csrf']=bin2hex(random_bytes(32));return $_SESSION['csrf']; }
function verify_csrf(): void { if(!hash_equals(csrf_token(),$_POST['csrf']??'')){http_response_code(419);exit('Your session expired. Please go back and try again.');} }
db();
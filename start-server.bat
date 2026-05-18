@echo off
REM Start Laravel app for LAN access on Windows.
REM Use Task Scheduler to run this on startup.

cd /d "c:\xampp\htdocs\Foreigner-System"

REM Ensure environment is loaded
if exist .env (
  echo Using existing .env
) else (
  echo .env not found. Check your project setup.
)

REM Start server (listen on all interfaces for LAN)
REM If port 8000 is already used, change the port here.
php artisan serve --host=0.0.0.0 --port=8000


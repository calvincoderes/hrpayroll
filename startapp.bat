@echo off
@title PAYROLL PROGRAM HELPER
echo Starting Program
D:
cd xampp\htdocs\admin-payroll
echo Downloading Software Updates
call git pull origin
echo Installing/Updating Dependencies
REM call composer update
echo Starting Server
call php artisan serve --port=9091

pause
@echo off
cd /d D:\Kuliah\Tugas Akhir\SIM GAJI\simgaji-update\simgaji
php artisan schedule:run >> scheduler_output.txt 2>&1
echo Ran at %date% %time% >> scheduler_output.txt

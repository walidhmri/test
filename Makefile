.PHONY: run queue server stop

run:
	powershell -Command "Start-Process php -ArgumentList 'artisan serve' -NoNewWindow"
	powershell -Command "Start-Process php -ArgumentList 'artisan queue:work --daemon' -NoNewWindow"

stop:
	powershell -Command "if (Get-Process php -ErrorAction SilentlyContinue) { Stop-Process -Name php -Force }"

clear:
	powershell -Command "php artisan cache:clear"
	powershell -Command "php artisan config:clear"
	powershell -Command "php artisan route:clear"
	powershell -Command "php artisan view:clear"

optimize:
	powershell -Command "php artisan optimize"

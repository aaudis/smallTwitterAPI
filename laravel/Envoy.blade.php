@servers (['web' => 'apiserver'])

@task ('deploy', ['on' => 'web'])
	cd /var/www
	git pull origin master
	chgrp -R www-data /var/www/laravel
	chmod -R 775 /var/www/laravel/app/storage
@endtask
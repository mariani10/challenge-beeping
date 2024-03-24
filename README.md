<p align="center"><a href="https://gobeeping.com/" target="_blank"><img src="https://gobeeping.com/wp-content/uploads/2021/01/cropped-beeping-logotipo_4-1.png" width="400" alt="Beeping Logo"></a></p>

## Challenge PHP / Laravel para Beeping

Desarrollo:

- Instalar Nginx & MySQL/MariaDB & PHP 8.2 & Redis
- Instalar Laravel 10
- Instalar Laravel LiveWire
- Instalar Laravel Horizon
- Crear migraciones
- Utilizar Seeders para llenar las tablas.

Backend:

- Crear un endpoint /api/executed/create que guardará en la tabla executed  los datos recibidos desde el comando “execute:total”.
- Hacer un comando de Laravel “execute:total” que encole mediante JOBS (redis) la siguiente tarea:
- Calcular de forma asíncrona el coste total de todos los pedidos de la DB. Para calcular este coste hay que multiplicar cada order_line “qty” por el “product cost” (colocar un nombre a la queue). Una vez sumados todos los pedidos guardar el resultado en la tabla executed pegando al endpoint /api/executed/create
- Crear un cron desde el schedule de Laravel que ejecute el comando “execute:total” cada 2 minutos.

Frontend:

- Para el front con livewire 3 mostrar un listado de todos los pedidos en una tabla: order_ref, customer_name, total qty y mostrar la cantidad de productos por cada pedido.
- Debajo de la tabla mostrar el último registro guardado en la tabla executed. Pedidos: {total_orders} - Total: {total_cost} - (created_at)

## Intrucciones para reproducir este entorno

- Clonar el repositorio
- composer install
- Crear el respectivo .env
- Generar la key (php artisan key:generate)
- Correr migracions (php artisan migrate)
- Correr Seeders (php artisan db:seed --class=ProductSeeder & php artisan db:seed --class=OrderSeeder)

Listo con esto nuestra app deberia estar funcionando. (Recordar que necesitamos redis y horizon corriendo)